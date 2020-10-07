<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Modell;

class ModelController extends Controller
{
    
    public function all(Request $request)
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

}
