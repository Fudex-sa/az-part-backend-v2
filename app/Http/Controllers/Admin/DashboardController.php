<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    protected $view = "dashboard.";

    public function index()
    {
        $open_requests = array();
        $closed_requests = array();
        $damaged_cars = array();
        $users = array();
        $requests = array();
        $cars = array();
   
        return view($this->view.'index',compact('users','requests','cars'));
    }

}
