<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\ShippingRequest;
use App\Models\OrderShipping;
use Session;

class ShippingController extends Controller
{
    protected $view = "site.checkout.";

    public function index()
    {
        return view($this->view.'shipping');
    }

    public function create(ShippingRequest $request)
    {
         
        Session::put('shipping',['country_id' => $request->country_id , 'region_id' => $request->region_id ,
                                'city_id' => $request->city_id , 'notes' => $request->notes , 'rep_id' => $request->rep_id]);

        return redirect()->route('payment');
    }
}
