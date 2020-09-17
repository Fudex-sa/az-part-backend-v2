<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function logout()
    {
        auth('admin')->logout();
 
        return redirect()->route('admin');
    }

    
}
