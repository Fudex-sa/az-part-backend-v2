<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $view = "control.";
    
    public function index()
    {
        $profile = true;

        return view($this->view . 'profile', compact('profile'));
    }
}
