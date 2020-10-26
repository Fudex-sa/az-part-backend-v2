<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Brand;
use App\Models\Piece;
use DB;

class StockController extends Controller
{
    
    public function index()
    {
        $items = Stock::select('brand_id','model_id','piece_id','year',DB::raw('max(price) as max_price'),
                        DB::raw('min(price) as min_price'),
                        DB::raw('avg(price) as avg_price'))
                        ->with('piece')->with('brand')->with('model')
                        ->groupBy('brand_id')->groupBy('model_id')->groupBy('year')
                        ->groupBy('piece_id')
                        ->orderby('id','desc')
                        ->paginate(pagger());
        
        $brands = Brand::orderby('name_'.my_lang(),'desc')->get();
        // $pieces = Piece::orderby('name_'.my_lang(),'desc')->get();

        return view('site.stock',compact('items','brands'));
    }

    public function filter(Request $request)
    {
        
        $items = Stock::select('brand_id','model_id','piece_id','year',DB::raw('max(price) as max_price'),
                        DB::raw('min(price) as min_price'),
                        DB::raw('avg(price) as avg_price'))
                        ->with('piece')->with('brand')->with('model')
                        ->groupBy('brand_id')->groupBy('model_id')->groupBy('year')
                        ->groupBy('piece_id')
                        ->where('brand_id',$request->brand_id)
                        ->where('model_id',$request->model_id)
                        ->where('year',$request->year)
                        ->orderby('id','desc')
                        ->paginate(pagger());

        $brands = Brand::orderby('name_'.my_lang(),'desc')->get();
        // $pieces = Piece::orderby('name_'.my_lang(),'desc')->get();

        return view('site.stock',compact('items','brands'));

    }
}
