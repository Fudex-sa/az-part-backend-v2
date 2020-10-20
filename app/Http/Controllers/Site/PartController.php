<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\PartSearchRequest;
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
        
        $this->search->save_search($request); //--- save search in session

        $piece_alts = PieceAlt::orderby('name_'.my_lang(),'desc')->get();

        $search_type == 'manual' ? $sys_limit = setting('manual_search_result') : $sys_limit = setting('electronic_search_result');
         
        $this->package->stores_limit($search_type) > 0 ? 

                $limit = $this->package->stores_limit($search_type) : $limit = $sys_limit;
           
        if($search_type == 'manual'){

           $response = $this->search->manual_search($request,$limit);
        
        }else{

            $response = $this->search->electronic_search($request,$limit);
        }

        $items = $response['items'];
        $found_result = $response['found_result'];
 
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
