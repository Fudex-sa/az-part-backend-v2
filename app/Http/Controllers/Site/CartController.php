<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Session;

class CartController extends Controller
{
    protected $view = "site.checkout.";

    public function index()
    {
        session()->put('payment_type','cart');
        
        return view($this->view . 'cart');
    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Cart::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function use_coupon(Request $request)
    {
        $code = $request->code;
        
        if(valid_coupon($code) == 1){
            session()->put('coupon',$code);

            return back()->with('success' , __('site.coupon_added_successfully') );
        }                
        else
            return back()->with('failed' , __('site.coupon_added_failed'))->withInput();
    }
}
