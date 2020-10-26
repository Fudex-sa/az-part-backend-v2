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

        Order::where('id',$shipping->order_id)->update(['status'=>$request->status]);
        
        if($request->status == 8){
            $shipping->delivery_time = $request->delivery_time;
            $shipping->save();
        }
        else if($request->status == 9){
            OrderShippingRejecte::create([
                'order_shipping_id' => $shipping->id , 'reject_reason' => $request->reject_reason
            ]);
        }

        return back()->with('success' , __('site.success-save') );
    }
     
}
