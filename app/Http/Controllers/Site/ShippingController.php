<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\ShippingRequest;
use App\Models\OrderShipping;
use App\Models\Rep;
use Session;
use App\Models\RepPrice;

class ShippingController extends Controller
{
    protected $view = "site.checkout.";

    public function index()
    {         
        return view($this->view.'shipping');
    }

    public function reps()
    {
        $shipping = session()->get('shipping');
        
        $country = $shipping ? $shipping['country_id'] : logged_user()->country_id;
        $region = $shipping ? $shipping['region_id'] : logged_user()->region_id;
        $city = $shipping ? $shipping['city_id'] : logged_user()->city_id;

        $rep_prices = RepPrice::with('rep')->whereHas('rep' , function($q){
                            $q->where('active',1)->orderby('lat','asc')->orderby('lng','asc');
                        })                                
                        ->where('city_id',$city)->where('active',1)
                        ->orderby('price','asc')
                        ->get();
        
        $regions = regions($country);
        $cities = cities($region);

        return view($this->view . 'reps' , compact('rep_prices','regions','cities'));
    }

    public function reps_filter(Request $request)
    { 
        $city = $request->city;

        $rep_prices = RepPrice::with('rep')->whereHas('rep' , function($q){
                            $q->where('active',1)->orderby('lat','asc')->orderby('lng','asc');
                        })                                
                        ->where('city_id',$city)->where('active',1)
                        ->orderby('price','asc')
                        ->get();

        $regions = regions($request->country);
        $cities = cities($request->region);

        return view($this->view . 'reps' , compact('rep_prices','regions','cities'));
    }

    public function choose_rep($id)
    {
       
        Session::put('rep_price',$id);
        
        return redirect()->route('payment.method');
    }

    public function store_shipping(ShippingRequest $request)
    {
        Session::put('shipping',['country_id' => $request->country_id , 'region_id' => $request->region_id ,
                                'city_id' => $request->city_id , 'street' => $request->street ,                                 
                                'notes' => $request->notes , 'with_oil' => $request->with_oil ,  
                                'size' => $request->size                             
                                ]);

        return redirect()->route('reps');
    }
}
