<?php

use App\Models\Cart;
use App\Models\Package;
use Session;

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

        $payment_type = Session::get('payment_type') ? Session::get('payment_type') : 'cart';
 
        return $payment_type;
    }
}


if (! function_exists('total')) {
    function total() {
                
        if(payment_type() == 'package')
            $result = Package::packagePrice(Session::get('package_id'));

        else
            $result = sub_total() + taxs();
        
        return $result;
    }
}

if (! function_exists('update_cart')) {
    function update_cart($order_id) {
                
        Cart::myCart()->update(['order_id' => $order_id , 'bought' => 1]);
        
    }
}
