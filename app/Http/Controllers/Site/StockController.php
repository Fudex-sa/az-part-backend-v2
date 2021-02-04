<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Brand;
use App\Models\Modell;
use App\Models\Piece;
use DB;

class StockController extends Controller
{
    protected $view = "site.stock.";

    public function index()
    {
        $items = Stock::select('brand_id','model_id','piece_id','year',DB::raw('max(price) as max_price'),
                        DB::raw('min(price) as min_price'),
                        DB::raw('avg(price) as avg_price'))
                        ->with('piece')->with('brand')->with('model')
                        // ->whereHas('seller',function($q){
                        //     $q->where('country_id',my_country()->id);
                        // })
                        ->groupBy('brand_id')->groupBy('model_id')->groupBy('year')
                        ->groupBy('piece_id')
                        ->orderby('id','desc')
                        ->paginate(pagger());
        
        $brands = Brand::orderby('name_'.my_lang(),'desc')->get();
       
        return view($this->view . 'all',compact('items','brands'));
    }

    public function show(Request $request)
    {
        $items = Stock::where('brand_id',$request->brand)
                        ->where('model_id',$request->model)
                        ->where('year',$request->year)
                        ->where('piece_id',$request->piece)
                        ->with('brand')->with('model')->with('piece')
                        ->orderby('price','asc')
                        ->get();

        $brand = Brand::find($request->brand);
        $model = Modell::find($request->model);
        $piece = Piece::find($request->piece);

        return view($this->view . 'show',compact('items','brand','model','piece'));

    }

    public function filter(Request $request)
    {
        if($request->brand_id)
            $items = Stock::select('brand_id','model_id','piece_id','year',DB::raw('max(price) as max_price'),
                    DB::raw('min(price) as min_price'),
                    DB::raw('avg(price) as avg_price'))
                    ->with('piece')->with('brand')->with('model')
                    ->whereHas('seller',function($q){
                        $q->where('country_id',my_country()->id);
                    })
                    ->groupBy('brand_id')->groupBy('model_id')->groupBy('year')
                    ->groupBy('piece_id')
                    ->where('brand_id',$request->brand_id)                    
                    ->orderby('id','desc')
                    ->paginate(pagger());
                    
                     

        if($request->brand_id & $request->model_id)
            $items = Stock::select('brand_id','model_id','piece_id','year',DB::raw('max(price) as max_price'),
                    DB::raw('min(price) as min_price'),
                    DB::raw('avg(price) as avg_price'))
                    ->with('piece')->with('brand')->with('model')
                    ->whereHas('seller',function($q){
                        $q->where('country_id',my_country()->id);
                    })
                    ->groupBy('brand_id')->groupBy('model_id')->groupBy('year')
                    ->groupBy('piece_id')
                    ->where('brand_id',$request->brand_id)
                    ->where('model_id',$request->model_id)                    
                    ->orderby('id','desc')
                    ->paginate(pagger());

        if($request->brand_id & $request->model_id & $request->year)
            $items = Stock::select('brand_id','model_id','piece_id','year',DB::raw('max(price) as max_price'),
                            DB::raw('min(price) as min_price'),
                            DB::raw('avg(price) as avg_price'))
                            ->with('piece')->with('brand')->with('model')
                            ->whereHas('seller',function($q){
                                $q->where('country_id',my_country()->id);
                            })
                            ->groupBy('brand_id')->groupBy('model_id')->groupBy('year')
                            ->groupBy('piece_id')
                            ->where('brand_id',$request->brand_id)
                            ->where('model_id',$request->model_id)
                            ->where('year',$request->year)
                            ->orderby('id','desc')
                            ->paginate(pagger());



        $brands = Brand::orderby('name_'.my_lang(),'desc')->get();
 
        return view($this->view . 'all',compact('items','brands'));

    }
}
