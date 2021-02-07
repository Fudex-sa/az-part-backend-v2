<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\PackageSubscribe;

class MyOrderController extends Controller
{
    protected $view = "user.my_orders.";

    public function index()
    {
        $my_orders = true;

        $items = Order::with('order_status')->with('user')->with('seller')->with('broker')->with('company')
                        ->with('shipping')
                        ->where('user_type',user_type())
                        ->where('user_id',logged_user()->id)
                        ->orderby('id','desc')->paginate(pagger());

        $manual_package = PackageSubscribe::with('my_orders')
                    ->myPackagesByType()                                        
                    ->sum('remaining');
 

        $elec_package = PackageSubscribe::with('my_orders')
                        ->myPackagesByType('electronic')                                        
                        ->sum('stores_no');

        return view($this->view . 'all',compact('my_orders','items','manual_package','elec_package'));
    }
}
