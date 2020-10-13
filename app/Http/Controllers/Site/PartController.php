<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\PartSearchRequest;
use App\Models\AvailableModel;
use App\Models\PieceAlt;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Http\Requests\Site\OrderRequest;
use Session;

class PartController extends Controller
{
    protected $view = "site.parts.";
 
    public function search(PartSearchRequest $request)
    { 

        $items = AvailableModel::matchOrder($request->brand,$request->model,$request->year)->limit(1)                    
                    ->get();
     
        $piece_alts = PieceAlt::orderby('name_'.my_lang(),'desc')->get();

        return view($this->view.'find_sellers',compact('items','piece_alts'));
    }


    public function contact_seller(OrderRequest $request)
    {
        $data = $request->except('_token');
        
        $data['user_id'] = logged_user()->id;
  
        $item = Order::create($data);
        
        if($item){
            Session::forget('search');

            return redirect()->route('cart');
        }
    }
}
