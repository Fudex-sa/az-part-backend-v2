<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function register()
    {
        return view('site.register_user');
    }

    public function signup()
    {
        
        

    }
}
