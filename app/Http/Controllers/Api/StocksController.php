<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Http\Resources\StockResource;
use DB;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 0;
        }

        if ($limit != 0) {
            $items = Stock::select(
                'brand_id',
                'model_id',
                'piece_id',
                'year',
                DB::raw('max(price) as max_price'),
                DB::raw('min(price) as min_price'),
                DB::raw('avg(price) as avg_price')
            )
                        ->with('piece')->with('brand')->with('model')
                        ->groupBy('brand_id')->groupBy('model_id')->groupBy('year')
                        ->groupBy('piece_id')
                        ->orderby('id', 'desc')
                        ->limit(30)
                        ->get();
        } else {
            $items = Stock::select(
                'brand_id',
                'model_id',
                'piece_id',
                'year',
                DB::raw('max(price) as max_price'),
                DB::raw('min(price) as min_price'),
                DB::raw('avg(price) as avg_price')
            )
                        ->with('piece')->with('brand')->with('model')
                        ->groupBy('brand_id')->groupBy('model_id')->groupBy('year')
                        ->groupBy('piece_id')
                        ->orderby('id', 'desc')
                        ->limit(30)
                        ->get();
        }

        return response()->json(['status'=>true, 'data' =>$items], 200);
    }

    public function search(Request $request)
    {
        //dd('aaa');
        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 0;
        }

        if ($limit != 0) {
            $items = Stock::select(
                'brand_id',
                'model_id',
                'piece_id',
                'year',
                DB::raw('max(price) as max_price'),
                DB::raw('min(price) as min_price'),
                DB::raw('avg(price) as avg_price')
            )
                        ->with('piece')->with('brand')->with('model')
                        ->groupBy('brand_id')->groupBy('model_id')->groupBy('year')
                        ->groupBy('piece_id')
                        ->where('brand_id', $request->brand_id)
                        ->where('model_id', $request->model_id)
                        ->where('year', $request->year)
                        ->orderby('id', 'desc')
                        ->get();
        } else {
            $items = Stock::select(
                'brand_id',
                'model_id',
                'piece_id',
                'year',
                DB::raw('max(price) as max_price'),
                DB::raw('min(price) as min_price'),
                DB::raw('avg(price) as avg_price')
            )
                        ->with('piece')->with('brand')->with('model')
                        ->groupBy('brand_id')->groupBy('model_id')->groupBy('year')
                        ->groupBy('piece_id')
                        ->where('brand_id', $request->brand_id)
                        ->where('model_id', $request->model_id)
                        ->where('year', $request->year)
                        ->orderby('id', 'desc')
                        ->get();
        }

        return response()->json(['status'=>true, 'data' =>$items], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        $items =      Stock::select(
            'brand_id',
            'model_id',
            'piece_id',
            'year',
            DB::raw('max(price) as max_price'),
            DB::raw('min(price) as min_price'),
            DB::raw('avg(price) as avg_price')
        )
                        ->with('piece')->with('brand')->with('model')
                        ->groupBy('brand_id')->groupBy('model_id')->groupBy('year')
                        ->groupBy('piece_id')
                        ->orderby('id', 'desc')
                        ->where('brand_id', $id)
                        ->limit(30)
                        ->get();
        //return StockResource::collection($items);
        return response()->json(['status'=>true, 'data' =>StockResource::collection($items)], 200);
    }
}
