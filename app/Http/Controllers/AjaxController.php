<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Region;
use App\Models\City;
use App\Models\Brand;
use App\Models\Modell;
use App\Models\Rep;
 
class AjaxController extends Controller
{
    
    public function cities(Request $request)
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

    public function models(Request $request)
    {
        $result = "";
        
        $brand_id = $request->input('brand_id');
        
        $brands = Modell::whereBrand_id($brand_id)->orderby('name_ar','desc')->get();
        
        $result .= "<option value=''> ".__('site.choose_model')." </option>";

        foreach($brands as $brand){
            $result .= "<option value='".$brand->id."'>" . $brand['name_'.my_lang()] . "</option>";
        }

        return $result;
    }

    public function regions(Request $request)
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

    public function reps(Request $request)
    {
        $result = "";
        
        $city_id = $request->input('city_id');
        
        $reps = Rep::whereCity_id($city_id)->orderby('name','desc')->get();
        
 
        foreach($reps as $rep){
            $result .= "<li> <label> <input type='radio' name='rep_id' value='".$rep->id."' />" . $rep->name . '</label> </li>';         
        }

        return $result;
    }

}
