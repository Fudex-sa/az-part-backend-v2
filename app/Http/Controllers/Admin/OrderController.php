<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderShippingRejecte;
use App\Models\OrderStatus;
use App\Models\Rep;

class OrderController extends Controller
{
    protected $view = "dashboard.orders.";

    public function all()
    {        
        $order_status = OrderStatus::orderby('sort','asc')->get();

        $items = Order::with('cart')->with('shipping')->with('user')->with('seller')->with('broker')->with('company')
                        ->orderby('id','desc')->paginate(pagger());

        return view($this->view . 'all',compact('items','order_status'));
    }

    public function deleted()
    {        
        $items = Order::with('cart')->orderby('id','desc')->onlyTrashed()->paginate(pagger());

        $order_status = OrderStatus::orderby('sort','asc')->get();

        return view($this->view . 'all',compact('items','order_status'));
    }
    public function show($id)
    {
        $item = Order::with('order_status')->with('cart')->with('user')
                        ->with('coupon')
                        ->with('package_subscribe')
                        ->withTrashed()
                        ->where('id',$id)->first();

      
        $couponUsedCount = Order::couponUsedCount($item->coupon_id)->count();
          
        $rejected = OrderShippingRejecte::where('order_shipping_id',$item->shipping->id)->first();

        $order_status = OrderStatus::orderby('sort','asc')->get();
        $reps = Rep::where('active',1)->orderby('name','asc')->get();

        return view($this->view . 'show' , compact('item','couponUsedCount','rejected','order_status','reps'));
    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Order::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function update(Request $request,$id)
    {
         
        $order = Order::with('shipping')->where('id',$id)->first();

        $order->status = $request->status;
        $order->shipping->rep_id = $request->rep_id;
        $order->shipping->delivery_time = $request->delivery_time;
        
        if( $order->save())
            return back()->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function search(Request $request)
    {
        $name = $request->name;
 
        $order_status = OrderStatus::orderby('sort','asc')->get();

        if($request->status)
            $items = Order::where('status',$request->status)   
                            ->where('type',$request->type)  
                            ->orderby('id','desc')                       
                            ->paginate(pagger());

        elseif($request->name)
            $items = Order::with('user')->whereHas('user',function($q) use ($name){
                              $q->where('name','like','%'.$name.'%');
                            })                        
                            ->where('type',$request->type)               
                            ->orderby('id','desc')                                     
                            ->paginate(pagger());

        elseif($request->name && $request->status)
            $items = Order::where('status',$request->status)  
                            ->with('user')->whereHas('user',function($q) use ($name){
                                $q->where('name','like','%'.$name.'%');
                            })      
                            ->where('type',$request->type)               
                            ->orderby('id','desc')                                                            
                            ->paginate(pagger());
        else 
            $items = Order::where('type',$request->type)                 
                            ->orderby('id','desc')                                  
                            ->paginate(pagger());
         
        return view($this->view.'all',compact('items','order_status'));
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
