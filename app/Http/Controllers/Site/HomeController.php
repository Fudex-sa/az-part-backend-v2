<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Stock;
use App\Models\Car;
use DB;

class HomeController extends Controller
{

    
    public function index()
    {
         
        $home = true;
        $brands = Brand::orderby('name_'.my_lang(),'desc')->get();

        $stocks = Stock::select('brand_id','model_id','piece_id','year',DB::raw('max(price) as max_price'),
                        DB::raw('min(price) as min_price'),
                        DB::raw('avg(price) as avg_price'))
                        ->with('piece')->with('brand')->with('model')
                        ->groupBy('brand_id')->groupBy('model_id')->groupBy('year')
                        ->groupBy('piece_id')
                        ->orderby('id','desc')
                        ->limit(30)
                        ->get();

        $cars = Car::with('brand')->with('model')->with('region')->with('city')
                        ->orderby('id','desc')->limit(12)->get();

        return view("site.home",compact('home','brands','stocks','cars'));
    }
}
