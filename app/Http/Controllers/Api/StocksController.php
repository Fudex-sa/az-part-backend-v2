<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Http\Resources\StockResource;

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
            $items = Stock::with('brand')->with('piece')->with('model')
                    ->orderby('updated_at', 'desc')->paginate($limit);
        } else {
            $items = Stock::with('brand')->with('piece')->with('model')
                    ->orderby('updated_at', 'desc')->get();
        }

        return response()->json(['status'=>true, 'data' =>StockResource::collection($items)], 200);
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
            $items = Stock::with('brand')->with('piece')->with('model')
                          ->where('brand_id', $request->brand_id)

                          ->orderby('id', 'desc')->paginate($limit);
        } else {
            $items = Stock::with('brand')->with('piece')->with('model')
                          ->where('brand_id', $request->brand_id)

                          ->orderby('id', 'desc')->get();
        }

        return StockResource::collection($items);
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

        $items = Stock::with('brand')->with('piece')->with('model')
                ->where('brand_id', $id)->orderby('updated_at', 'desc')->paginate($limit);
        //return StockResource::collection($items);
        return response()->json(['status'=>true, 'data' =>StockResource::collection($items)], 200);
    }
}
