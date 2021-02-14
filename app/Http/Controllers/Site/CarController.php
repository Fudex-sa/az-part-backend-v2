<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Brand;
use App\Models\CarComment;
use App\Models\Ad;

class CarController extends Controller
{
    protected $view = "site.cars.";

    public function antique()
    {
        $antique = true;

        $brands = Brand::where('active',1)->orderby('name_'.my_lang(),'desc')->get();

        $items = Car::with('imgs')->with('brand')->with('model')->with('region')->with('city')
                    ->where('type','antique')->where('publish',1)
                    ->where('country_id',my_country()->id)
                    ->orderby('id','desc')
                    ->paginate(pagger());
                    
        $ad_top = Ad::find(2);
        $ad_right = Ad::find(3);

        return view($this->view . 'antique' , compact('antique','brands','items','ad_top','ad_right'));
    }

    public function damaged()
    {
        
        $damaged = true;

        $brands = Brand::where('active',1)->orderby('name_'.my_lang(),'desc')->get();

        $items = Car::with('imgs')->with('brand')->with('model')->with('region')->with('city')
                    ->where('type','damaged')->where('publish',1)
                    ->where('country_id',my_country()->id)
                    ->orderby('id','desc')
                    ->paginate(pagger());

        $ad_top = Ad::find(2);
        $ad_right = Ad::find(3);

        return view($this->view . 'damaged' , compact('damaged','brands','items','ad_top','ad_right'));
    }

    public function show($id)
    {
        $item = Car::with('imgs')->with('brand')->with('model')->with('region')->with('city')
                    ->with('comments')
                    ->where('id',$id)->first();

        $cars = Car::with('imgs')->with('brand')->with('model')->with('region')->with('city')
                    ->where('type',$item->type)
                    ->where('id','!=',$id)
                    ->limit(4)->get();

        Car::where('id',$id)->update(['views' => $item->views + 1]);

        return view($this->view .'show' ,compact('item','cars'));
    }

    public function search(Request $request)
    {
         
        $type = $request->type;
         
        $damaged = true;

        $brands = Brand::where('active',1)->orderby('name_'.my_lang(),'desc')->get();
   
        if($request->model)
            $items = Car::with('imgs')->with('brand')->with('model')->with('region')->with('city')
                        ->where('type',$type)->where('publish',1)
                        ->where('brand_id',$request->brand)
                        ->where('model_id',$request->model)
                        ->where('country_id',my_country()->id)
                        ->orderby('id','desc')
                        ->paginate(pagger());

        elseif($request->year)
            $items = Car::with('imgs')->with('brand')->with('model')->with('region')->with('city')
                        ->where('type',$type)->where('publish',1)
                        ->where('year',$request->year)                        
                        ->where('country_id',my_country()->id)
                        ->orderby('id','desc')
                        ->paginate(pagger());
            
        elseif($request->brand && $request->model && $request->year)
            $items = Car::with('imgs')->with('brand')->with('model')->with('region')->with('city')
                        ->where('type',$type)->where('publish',1)
                        ->where('brand_id',$request->brand)                        
                        ->where('model_id',$request->model)                        
                        ->where('year',$request->year)        
                        ->where('country_id',my_country()->id)                
                        ->orderby('id','desc')
                        ->paginate(pagger());

        else
            $items = Car::with('imgs')->with('brand')->with('model')->with('region')->with('city')
                        ->where('type',$type)->where('publish',1)
                        ->where('brand_id',$request->brand)      
                        ->where('country_id',my_country()->id)                                                              
                        ->orderby('id','desc')
                        ->paginate(pagger());

        $ad_top = Ad::find(2);
        $ad_right = Ad::find(3);

        return view($this->view . 'search' , compact('damaged','brands','items','ad_top','ad_right'));

    }

    public function store_comment(Request $request,$id)
    {
        $data = $request->except("_token");
        $data['user_type'] = user_type();
        $data['user_id'] = logged_user()->id;
        $data['car_id'] = $id;

        $item = CarComment::create($data);
        
        if($item)
            return back()->with('success' , __('site.success-save') );
        else
            return back()->with('failed' , __('site.error-happen'))->withInput();

    }
}
