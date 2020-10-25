<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\ShippingRequest;
use App\Models\OrderShipping;
use Session;
use App\Models\RepPrice;

class ShippingController extends Controller
{
    protected $view = "site.checkout.";

    public function index()
    {
        return view($this->view.'shipping');
    }

    public function create(ShippingRequest $request)
    {
        
        $rep = RepPrice::find($request->rep_price_id);
         
        Session::put('shipping',['country_id' => $request->country_id , 'region_id' => $request->region_id ,
                                'city_id' => $request->city_id , 'street' => $request->street ,
                                'address' => $request->address , 'lat' => $request->lat ,
                                'lng' => $request->lng , 
                                'notes' => $request->notes , 'rep_id' => $rep->id ,
                                'size' => $request->size , 'with_oil' => $request->with_oil                                
                                ]);

        return redirect()->route('payment.method');
    }
}
