<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Models\OrderShippingRejecte;

class OrderController extends Controller
{
    protected $view = "dashboard.orders.";

    public function all()
    {
        $title = __('site.all_orders');

        $items = Order::with('cart')->orderby('id','desc')->paginate(pagger());

        return view($this->view . 'all',compact('items','title'));
    }

    public function deleted()
    {
        $title = __('site.deleted_orders');

        $items = Order::with('cart')->orderby('id','desc')->onlyTrashed()->paginate(pagger());

        return view($this->view . 'all',compact('items','title'));
    }
    public function show($id)
    {
        $item = Order::with('order_status')->with('cart')->with('user')
                        ->with('coupon')
                        ->with('package_subscribe')
                        ->withTrashed()
                        ->where('id',$id)->first();

      
        $couponUsedCount = Order::couponUsedCount($item->coupon_id)->count();
         
        $shipping = OrderShipping::where('order_id',$id)->first();
        $rejected = OrderShippingRejecte::where('order_shipping_id',$shipping->id)->first();

        return view($this->view . 'show' , compact('item','couponUsedCount','shipping','rejected'));
    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Order::find($item)->delete()) 
            return 1;

        return 0;
    }
}
