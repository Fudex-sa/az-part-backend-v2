<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;

use App\Http\Resources\CityResource;
use App\Http\Resources\RegionResource;

use App\Http\Resources\CountryResource;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
        if ($id) {
            $items = City::where('region_id', $id)->orderby('name_ar', 'desc')->get();
        } else {
            $items = City::orderby('name_ar', 'desc')->get();
        }

        return response()->json(['status'=>true, 'data' => CityResource::collection($items)], 200);
    }

    public function countries()
    {
        $items = Country::orderby('name_ar', 'desc')->get();
        return response()->json(['status'=>true, 'data' => CountryResource::collection($items)], 200);
    }

    public function regions($id=null)
    {
        if ($id) {
            $items = Region::where('country_id', $id)->orderby('name_ar', 'desc')->get();
        } else {
            $items = Region::orderby('name_ar', 'desc')->get();
        }

        return response()->json(['status'=>true, 'data' => RegionResource::collection($items)], 200);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
