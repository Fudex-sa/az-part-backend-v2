<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AvliableModelController extends Controller
{
    protected $view = "sellers.";

    public function index()
    {
        
        return view($this->view.'avaliable_models');

    }

}
