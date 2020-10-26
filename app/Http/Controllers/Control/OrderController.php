<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Models\OrderShippingRejecte;
use App\Models\OrderStatus;

class OrderController extends Controller
{
    protected $view = "control.orders.";

    public function show($id)
    {
        $my_orders = true;

        $item = Order::with('order_status')->with('user')->where('id',$id)->first();

        $shipping = OrderShipping::where('order_id',$item->id)->first();

        $order_rejected = OrderShippingRejecte::where('order_shipping_id',$shipping->id)->first();

        $ordr_stat = OrderStatus::all();

        return view($this->view . 'show',compact('item','my_orders','shipping','order_rejected','ordr_stat'));
    }

   
}
