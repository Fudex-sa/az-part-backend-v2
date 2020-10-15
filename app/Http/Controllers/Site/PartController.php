<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\PartSearchRequest;
use App\Models\AvailableModel;
use App\Models\PieceAlt;
use App\Models\Cart;
use App\Models\OrderShipping;
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
        session()->put('has_request',1);
         
        $this->package->stores_limit() > 0 ? $limit = $this->package->stores_limit() : $limit = 1; 
         
        $items = AvailableModel::matchOrder($request->brand,$request->model,$request->year)
                    ->limit($limit)                    
                    ->get();
     
        $piece_alts = PieceAlt::orderby('name_'.my_lang(),'desc')->get();

        return view($this->view.'find_sellers',compact('items','piece_alts'));
    }


    public function contact_seller(OrderRequest $request)
    {
        $data = $request->except('_token');
        
        $data['user_id'] = logged_user()->id;
  
        $item = Cart::create($data);
        
        if($item){
            // Session::forget('search');

            return redirect()->route('cart');
        }
    }
}
