<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Modell;
use App\Http\Resources\BrandsResource;
use App\Http\Resources\CarModelResource;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Brand::orderby('name_ar', 'desc')->get();
        return response()->json(['status'=>true, 'data' => BrandsResource::collection($items)], 200);
    }


    public function show($id)
    {
        $items = Modell::where('brand_id', $id)->orderby('name_ar', 'desc')->get();
        return response()->json(['status'=>true, 'data' => CarModelResource::collection($items)], 200);
    }
}
