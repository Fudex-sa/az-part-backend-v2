<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    
    public function index()
    {
        $home = true;

        return view("site.home",compact('home'));
    }
}
