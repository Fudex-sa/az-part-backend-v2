<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    protected $view = "control.orders.";

    public function show($id)
    {
        $my_orders = true;

        $item = Order::with('order_status')->with('user')->where('id',$id)->first();

        return view($this->view . 'show',compact('item','my_orders'));
    }
}
