<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Stock;
use App\Models\Car;
use App\Models\Page;
use App\Models\Seller;
use App\Models\Broker;
use App\Models\AvailableModel;
use App\Models\Ad;
use DB;

class HomeController extends Controller
{

    
    public function index()
    {
      
        $home = true;
        $brands = Brand::orderby('name_'.my_lang(),'asc')->get();

        $stocks = Stock::select('brand_id','model_id','piece_id','year',DB::raw('max(price) as max_price'),
                        DB::raw('min(price) as min_price'),
                        DB::raw('avg(price) as avg_price'))
                        ->with('piece')->with('brand')->with('model')
                        // ->whereHas('seller',function($q){
                        //     $q->where('country_id',my_country()->id);
                        // })
                        ->groupBy('brand_id')->groupBy('model_id')->groupBy('year')
                        ->groupBy('piece_id')
                        ->orderby('id','desc')
                        ->limit(100)
                        ->get();

        $cars = Car::with('brand')->with('model')->with('region')->with('city')
                        ->where('country_id',my_country()->id)
                        ->orderby('id','desc')->limit(12)->get();

        $about = Page::find(1);
        $total_sellers_count = Seller::count() + Broker::count();
        $total_cars_count = AvailableModel::count();
 
        return view("site.home",compact('home','brands','stocks','cars','about',
                'total_sellers_count','total_cars_count'));
    }
}
