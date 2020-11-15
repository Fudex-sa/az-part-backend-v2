<?php

namespace App\Http\Controllers\Control;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarBidding;
use App\Models\Modell;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Lang;

class CarsBiddingController extends Controller
{
    protected $view = "control.auctions.";

    public function index($id)
    {
        $item = Car::with('imgs')->with('brand')->with('model')->with('region')->with('city')
                    ->where('id', $id)->first();

        $tenders = CarBidding::where('car_id', $id)->where('status', 1)->orderby('id', 'desc')->limit(10)->get();

        $cars = Car::with('imgs')->with('brand')->with('model')->with('region')->with('city')
                    ->where('type', $item->type)
                    ->where('id', '!=', $id)
                    ->limit(4)->get();

        return view($this->view .'show', compact('item', 'cars', 'tenders'));
    }


    public function storeBidding(Request $request)
    {
        $car_id = $request->car_id;
        $maxPrice = CarBidding::where('status', 1)->where('car_id', $car_id)->max('price');

        if ($maxPrice > $request->price) {
            return back()->with('failed', __('site.bing-price'));
        }
        //  dd($request->all());
        $item = new CarBidding();
        $item->comment = $request->comment ?? null;
        $item->price	 = $request->price;
        $item->user_id = $request->user_id;
        $item->car_id = $request->car_id;
        $item->status  ='2';
        if ($item->save()) {
            return back()->with('success', __('site.your_bidding_sent_successfully'));
        } else {
            return back()->with('failed', __('site.error-happen'));
        }
    }
}
