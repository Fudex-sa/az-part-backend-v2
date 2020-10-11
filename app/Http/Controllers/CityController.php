<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\City;

class CityController extends Controller
{
    
    public function all(Request $request)
    {
        $result = "";

        $region_id = $request->input('region_id');
        
        $cities = City::whereRegion_id($region_id)->orderby('name_ar','desc')->get();
        
        $result .= "<option value=''> ".__('site.choose_city')." </option>";

        foreach($cities as $city){
            $result .= "<option value='".$city->id."'>" . $city['name_'.my_lang()] . "</option>";
        }

        return $result;
    }

}
