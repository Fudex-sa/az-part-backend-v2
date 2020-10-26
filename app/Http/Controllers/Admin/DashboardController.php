<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;
 
class DashboardController extends Controller
{
    
    protected $view = "dashboard.";

    public function index()
    {
        
        $closed_requests = array();
        $damaged_cars = array();
        $users = array();
        $requests = array();
        $cars = array();
   
        $orders_this_month = Order::whereMonth('created_at', date('m'))->count();
        
        return view($this->view.'index',compact('users','requests','cars','orders_this_month'));
    }

}
