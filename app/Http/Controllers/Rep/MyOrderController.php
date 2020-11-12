<?php

namespace App\Http\Controllers\Rep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderShippingRejecte;
use App\Models\Order;
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

        if($request->status == 8){
        
            $order->shipping->delivery_time = $request->delivery_time;
        
            $order->save();   
        
        }else if($request->status == 9)

            OrderShippingRejecte::create([
                'order_shipping_id' => $shipping->id , 'reject_reason' => $request->reject_reason
            ]);
 
        return back()->with('success' , __('site.success-save') );
    }
     
}
