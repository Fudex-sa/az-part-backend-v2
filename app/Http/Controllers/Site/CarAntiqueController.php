<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarAntiqueController extends Controller
{
    
    public function index()
    {
        $antique_cars = true;

        return view('site.car_antique' ,compact('antique_cars'));
    }

}
