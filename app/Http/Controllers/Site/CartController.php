<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    protected $view = "site.checkout.";

    public function index()
    {
        return view($this->view . 'cart');
    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Cart::find($item)->delete()) 
            return 1;

        return 0;
    }
}
