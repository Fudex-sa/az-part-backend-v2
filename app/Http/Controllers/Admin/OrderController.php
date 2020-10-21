<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    protected $view = "dashboard.orders.";

    public function all()
    {
        $items = Order::with('cart')->orderby('id','desc')->paginate(pagger());

        return view($this->view . 'all',compact('items'));
    }
}
