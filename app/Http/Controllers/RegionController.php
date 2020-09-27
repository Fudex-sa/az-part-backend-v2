<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Region;

class RegionController extends Controller
{
    
    public function all(Request $request)
    {
        $result = "";
        
        $country_id = $request->input('country_id');
        
        $regions = Region::whereCountry_id($country_id)->orderby('name_ar','desc')->get();
        
        $result .= "<option value=''> ".__('site.choose_region')." </option>";

        foreach($regions as $region){
            $result .= "<option value='".$region->id."'>" . $region['name_'.my_lang()] . "</option>";
        }

        return $result;
    }
}
