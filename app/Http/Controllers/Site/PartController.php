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
use App\Helpers\Search;

class PartController extends Controller
{
    protected $view = "site.parts.";
    public $package;
    protected $search;

    public function __construct()
    {     
        $this->package = new PackageHelp();
        $this->search = new Search();
    }

    public function search(PartSearchRequest $request)
    { 
        $search_type =  $request->search_type;
        $city = $request->city;
        $region = $request->region;

        $found_result = 0;
        
        $this->search->save_search($request); //--- save search in session

        $piece_alts = PieceAlt::orderby('name_'.my_lang(),'desc')->get();

        $search_type == 'manual' ? $sys_limit = setting('manual_search_result') : $sys_limit = setting('electronic_search_result');
         
        $this->package->stores_limit($search_type) > 0 ? 

                $limit = $this->package->stores_limit($search_type) : $limit = $sys_limit;
           
        if($search_type == 'manual'){

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
        
        }else{

            if($limit > 0){

                $items = AvailableModel::matchOrder($request->brand,$request->model,$request->year)
                                ->with('seller')
                                ->whereHas('seller',function($q) use ($city){
                                    $q->where('city_id',$city);
                                })                                                
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
                                ->get();
                        
                        if(count($items_region) > 0) {
                            
                            $found_result = 2; // ---- Case found in same region
                            $items = $items_region;

                        }else $found_result = 0; // --- Case not found
                    }


            }else{
                $items = null;
                $found_result = 3; // --- Case not joined any electronic package
                
            }

        }


        

        return view($this->view.'find_sellers',compact('items','piece_alts','found_result'));
    }


    public function contact_seller(OrderRequest $request)
    {
        $data = $request->except('_token');
        
        $data['user_id'] = logged_user()->id;
        $data['user_type'] = user_type();
  
        $item = Cart::create($data);
        
        if($item){
 
            return redirect()->route('cart');
        }
    }
}
