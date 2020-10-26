<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Region;
use App\Models\City;
use App\Models\Brand;
use App\Models\Modell;
use App\Models\RepPrice;
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
        $size = $request->input('size');
 
        $rep_prices = RepPrice::with('rep')->whereHas('rep' , function($q){
                                $q->where('active',1)->orderby('lat','asc')->orderby('lng','asc');
                                })                                
                                ->where('city_id',$city_id)->where('active',1)
                                ->orderby('price','asc')
                                ->get();


        if(count($rep_prices) > 0) {
            
            foreach($rep_prices as $k=>$rep_price){
                if(in_array($size,$rep_price->car_size)){    
                    $number = $k+1;

                    $result .= "<tr>";
                    $result .= "<td> ". $number ." </td>";

                    $result .= "<td>
                                <label> 
                                    <input type='radio' name='rep_price_id' value='".$rep_price->id."' /> ". $rep_price->rep['name'] ."
                                </label>   
                                </td>";

                    $result .= "<td> ". $rep_price->price . __('site.rs') ." </td>";
                    $result .= "</tr>";
                }
            }
        }else{

            $result .= "<tr class='text-center'> <td colspan='3'> ". __('site.no_reps_in_this_city_found') ." </td> </tr>";
        }

        return $result;
    }

    public function rep_choose(Request $request)
    {
        $rep_price_id = $request->input('rep_price_id');

        $rep_price = RepPrice::find($rep_price_id);
        
        $delivery_price = $rep_price->price;

        session()->put('delivery_price',$delivery_price);

        if(session()->get('delivery_price'))
            $total = total() - session()->get('delivery_price') + $delivery_price;
        else
            $total = total() + $delivery_price;

        return response()->json(['total'=> $total, 'delivery_price'=> $delivery_price]);

    }

    public function with_oil(Request $request)
    {
        $with_oil = $request->input('with_oil');

        $with_oil ? $with_oil_fees = setting('with_oil_fees') : $with_oil_fees = 0;
 
        session()->put('with_oil',$with_oil_fees);

        $total = total()  + $with_oil_fees;
         
        return response()->json(['total'=> $total, 'with_oil_fees'=> $with_oil_fees]);

    }
}
