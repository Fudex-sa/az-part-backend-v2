<?php

use App\Models\Cart;


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

if (! function_exists('total')) {
    function total() {
                
        $result = Cart::myCart()->with('piece_alt')->with('seller')->sum('price');
        
        return $result;
    }
}
