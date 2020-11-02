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
        $search = session()->get('search');
        
        $country = $search ? $search['country'] : logged_user()->country_id;
        $region = $search ? $search['region'] : logged_user()->region_id;
        $city = $search ? $search['city'] : logged_user()->city_id;

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
        $size = $request->size ? $request->size : 'medium';
        
        Session::put('shippment_size',$size);

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
        
        return redirect()->route('shipping');
    }

    public function store_shipping(ShippingRequest $request)
    {
        Session::put('shipping',['country_id' => $request->country_id , 'region_id' => $request->region_id ,
                                'city_id' => $request->city_id , 'street' => $request->street ,                                 
                                'notes' => $request->notes , 'with_oil' => $request->with_oil                                
                                ]);

        return redirect()->route('payment.method');
    }
}
