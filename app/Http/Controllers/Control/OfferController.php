<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignSeller;
use App\Models\Cart;
use App\Helpers\Search;
use App\Models\PieceAlt;
use App\Models\Stock;

class OfferController extends Controller
{
    protected $search;

    public function __construct()
    {    
        $this->search = new Search();
    }

    public function add_to_cart(Request $request,$id)
    {
        $assign = AssignSeller::with('request')->where('id',$id)->first();
        
        // $data['type'] = $this->search->search_res('search_type');
        $data['type'] = 'electronic';
        $data['user_id'] = logged_user()->id;
        $data['user_type'] = $assign->request->user_type;
        $data['seller_id'] = $assign->seller_id;
        $data['brand_id'] = $assign->request->brand_id;
        $data['model_id'] = $assign->request->model_id;
        $data['year'] = $assign->request->year;
        $data['country_id'] = $assign->request->country_id;
        $data['region_id'] = $assign->request->region_id;
        $data['city_id'] = $assign->request->city_id;
        $data['piece_alt_id'] = $assign->request->piece_alt_id;
        $data['photo'] = $assign->request->photo;
        $data['qty'] = $assign->request->qty;
        $data['price'] = $assign->price;
        $data['notes'] = $assign->notes;
        $data['color'] = $assign->request->color;
 
        $cart = Cart::create($data);
        
        if($cart){ 
            //----------- Add to Stock ------------
            $piece_id = PieceAlt::where('id',$data['piece_alt_id'])->first()->piece_id;
            if($piece_id){
                $data2 = [
                    'brand_id' => $data['brand_id'] , 'model_id' => $data['model_id'],
                    'year' => $data['year'] , 'piece_id' => $piece_id , 
                    'price' => $data['price'] , 'seller_id' => $data['seller_id']
                ];
                Stock::create($data2);
            }
            return redirect()->route('cart');
        }else
            return back()->with('failed' , __('site.error-happen'))->withInput();

    }
}
