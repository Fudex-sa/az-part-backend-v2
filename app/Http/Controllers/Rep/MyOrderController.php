<?php

namespace App\Http\Controllers\Rep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderShippingRejecte;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Http\Requests\Rep\UpdateOrderRequest;

class MyOrderController extends Controller
{
    protected $view = "rep.orders.";

    public function all()
    {
        $rep_orders = true;

        $items = Order::with('shipping')->with('user')->with('company')->with('seller')->with('broker')
                        ->whereHas('shipping',function($q){
                            $q->where('rep_id',logged_user()->id);
                        })->orderby('id','desc')->paginate(pagger());

        return view($this->view . 'all',compact('items','rep_orders'));
    }

    public function update(UpdateOrderRequest $request,$id)
    {

        Order::where('id',$id)->update(['status'=>$request->status]);
        
        $order = Order::where('id',$id)->first();
        $shipping = OrderShipping::where('id',$order->shipping_id)->first();

        if($request->status == 8){
        
            $shipping->delivery_time = $request->delivery_time;
        
            $shipping->save();   
        
        }else if($request->status == 9)

            OrderShippingRejecte::create([
                'order_shipping_id' => $order->shipping->id , 'reject_reason' => $request->reject_reason
            ]);
 
        return back()->with('success' , __('site.success-save') );
    }

    public function confirm_paid(Request $request)
    {
        $item = $request->input('id');

        $order = Order::find($item);
        $order->remaining_cost != 0 ? $order->remaining_cost = 0 : $order->remaining_cost = $order->total / 2 ;
        
        if($order->save())        
            return 1;

        return 0;
    }
     
}
