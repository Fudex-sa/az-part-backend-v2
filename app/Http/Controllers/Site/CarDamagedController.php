<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarDamagedController extends Controller
{
    
    public function index()
    {
        $cars_yard = true;

        return view('site.car_damaged' , compact('cars_yard'));
    }
}
