<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $view = "site.checkout.";

    public function index()
    {
        return view($this->view . 'cart');
    }
}
