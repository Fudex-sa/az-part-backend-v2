<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class HomeController extends Controller
{

    
    public function index()
    {
         
        $home = true;
        $brands = Brand::orderby('name_'.my_lang(),'desc')->get();

        return view("site.home",compact('home','brands'));
    }
}
