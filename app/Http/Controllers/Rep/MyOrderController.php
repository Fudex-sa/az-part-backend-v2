<?php

namespace App\Http\Controllers\Rep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderShipping;
use App\Models\OrderShippingRejecte;
use App\Models\Order;

class MyOrderController extends Controller
{
    protected $view = "rep.orders.";

    public function all()
    {
        $rep_orders = true;

        $items = OrderShipping::repOrders()->with('order')->orderby('id','desc')->paginate(pagger());

        return view($this->view . 'all',compact('items','rep_orders'));
    }

    public function update(Request $request,OrderShipping $shipping)
    {
        $shipping->status = $request->status;
        $shipping->delivery_time = $request->delivery_time;
        $shipping->save();

        if($request->status == 'accepted')
            Order::where('id',$shipping->order_id)->update(['status'=>2]);

        if($request->status == 'rejected')
            OrderShippingRejecte::create([
                'order_shipping_id' => $shipping->id , 'reject_reason' => $request->reject_reason
            ]);

        return back()->with('success' , __('site.success-save') );
    }
     
}
