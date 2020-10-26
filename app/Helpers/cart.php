<?php

use App\Models\Cart;
use App\Models\Package;
use App\Models\Coupon;
use App\Models\Order;
 
if (! function_exists('cart')) {
    function cart() {

        $items = Cart::myCart()->with('piece_alt')->with('seller')->get();
        
        return $items;
    }
}

if (! function_exists('sub_total')) {
    function sub_total() {
                
        $result = Cart::myCart()->with('piece_alt')->with('seller')->sum('price');
        
        return $result;
    }
}

if (! function_exists('taxs')) {
    function taxs() {
                
        $result = setting('pieces_tax') + setting('site_commission');
        
        return $result;
    }
}


if (! function_exists('payment_type')) {
    function payment_type() {

        $payment_type = session()->get('payment_type') ? session()->get('payment_type') : 'cart';
 
        return $payment_type;
    }
}


if (! function_exists('total')) {
    function total() {
                
        if(payment_type() == 'package')
            $result = Package::packagePrice(session()->get('package_id'));

        else{

            $result = sub_total() + taxs();

            if(session()->get('delivery_price'))
                $result = $result + session()->get('delivery_price');            
            
            if(session()->get('with_oil'))
                $result = $result + session()->get('with_oil');            
            
        }
                    
        return $result - coupon_discount();
    }
}


if (! function_exists('update_cart')) {
    function update_cart($order_id) {
                
        Cart::myCart()->update(['order_id' => $order_id , 'bought' => 1]);
        
    }
}

if (! function_exists('valid_coupon')) {
    function valid_coupon($code)
    {         
        $coupon = Coupon::where('code',$code)->first();

        if($coupon){
            $used_times = Order::couponByUser($coupon->id)->get()->count();
            
            if($used_times < $coupon->uses_number)                
                return 1;
                 
            else return 0;
        }
        
        else return 0;
    }
}
 
if (! function_exists('coupon_discount')) {
    function coupon_discount()
    {   
        if(session()->get('coupon')) 
            $discount = Coupon::couponValue(session()->get('coupon'))->first()->value;

        else $discount = 0;

        return $discount;
    }
}

if (! function_exists('coupon_id')) {
    function coupon_id()
    {   
        if(session()->get('coupon')) 
            $id = Coupon::where('code',session()->get('coupon'))->first()->id;

        else $id = 0;

        return $id;
    }
}

 