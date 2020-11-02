<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class MyOrderController extends Controller
{
    protected $view = "user.my_orders.";

    public function index()
    {
        $my_orders = true;

        $items = Order::with('order_status')->with('user')
                        ->where('user_type',user_type())
                        ->where('user_id',logged_user()->id)
                        ->orderby('id','desc')->paginate(pagger());

        return view($this->view . 'all',compact('my_orders','items'));
    }
}
