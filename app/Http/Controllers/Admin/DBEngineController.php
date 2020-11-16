<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignSeller;
use App\Models\Car;
use App\Models\CarComment;
use App\Models\CarImage;
use App\Models\Cart;
use App\Models\Complain;
use App\Models\ContactUs;
use App\Models\ElectronicRequest;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Models\OrderShippingRejecte;
use App\Models\PackageSubscribe;
use App\Models\Report;
use App\Helpers\ElecEngine;

class DBEngineController extends Controller
{
    public function __construct()
    {         
        $this->engine = new ElecEngine();
    }
    
    protected $view = "dashboard.db_engine.";

    public function index()
    {
        return view($this->view . 'index');
    }

    public function empty_tables()
    {
        AssignSeller::query()->truncate();
        Car::query()->truncate();
        CarComment::query()->truncate();
        CarImage::query()->truncate();
        Cart::query()->truncate();        
        ContactUs::query()->truncate();
        ElectronicRequest::query()->truncate();
        Order::query()->truncate();
        OrderShipping::query()->truncate();
        OrderShippingRejecte::query()->truncate();
        PackageSubscribe::query()->truncate();
        Report::query()->truncate();
        
        return 1;
 
    }

    public function next_round()
    {
        $this->engine->run_next_round();

        return 1;
 
    }
}
