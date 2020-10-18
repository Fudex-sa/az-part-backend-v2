<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\PartSearchRequest;
use App\Models\AvailableModel;
use App\Models\PieceAlt;
use App\Models\Cart;
use App\Models\OrderShipping;
use App\Models\Region;
use App\Models\City;
use App\Http\Requests\Site\OrderRequest;
use Session;
use App\Helpers\PackageHelp;

class PartController extends Controller
{
    protected $view = "site.parts.";
    public $package;

    public function __construct()
    {     
        $this->package = new PackageHelp();
    }

    public function search(PartSearchRequest $request)
    { 
        $found_result = 0;
        
        session()->put('has_request',1);
         
        $this->package->stores_limit() > 0 ? $limit = $this->package->stores_limit() : $limit = 1; 
         
        $city = $request->city;
        $region = $request->region;

        $items = AvailableModel::matchOrder($request->brand,$request->model,$request->year)
                    ->with('seller')
                    ->whereHas('seller',function($q) use ($city){
                        $q->where('city_id',$city);
                    })
                    ->limit($limit)                    
                    ->get();
                    
        if(count($items) > 0){
            $found_result = 1; //--- Case found 
            $items = $items;

        }else{

            $items_region = AvailableModel::matchOrder($request->brand,$request->model,$request->year)
                    ->with('seller')
                    ->whereHas('seller',function($q) use ($region){
                        $q->where('region_id',$region);
                    })
                    ->limit($limit)                    
                    ->get();
            
            if(count($items_region) > 0) {
                
                $found_result = 2; // ---- Case found in same region
                $items = $items_region;

            }else $found_result = 0; // --- Case not found
        }
        
        $piece_alts = PieceAlt::orderby('name_'.my_lang(),'desc')->get();

        return view($this->view.'find_sellers',compact('items','piece_alts','found_result'));
    }


    public function contact_seller(OrderRequest $request)
    {
        $data = $request->except('_token');
        
        $data['user_id'] = logged_user()->id;
        $data['user_type'] = user_type();
  
        $item = Cart::create($data);
        
        if($item){
            // Session::forget('search');

            return redirect()->route('cart');
        }
    }
}
