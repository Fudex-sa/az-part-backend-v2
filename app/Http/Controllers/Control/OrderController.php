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

        $item = Order::with('order_status')->with('user')->with('shipping')
                    ->where('id',$id)->first();
 
      
        $order_rejected = OrderShippingRejecte::where('order_shipping_id',$item->shipping->id)->first();
       
        $ordr_stat = OrderStatus::all();

        return view($this->view . 'show',compact('item','my_orders','order_rejected','ordr_stat'));
    }

   
}
