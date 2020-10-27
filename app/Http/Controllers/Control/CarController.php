<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\Brand;
use App\Models\Modell;
use App\Models\Region;
use App\Models\City;
use App\Models\Country;

class CarController extends Controller
{
    protected $view = "control.cars.";

    public function all()
    {
        $my_cars = true;

        $items = Car::where('user_id',logged_user()->id)->where('user_type',user_type())
                    ->orderby('id','desc')->get();

        $brands = Brand::orderby('name_'.my_lang(),'desc')->get();
        $countries = Country::orderby('name_'.my_lang(),'desc')->get();

        return view($this->view . 'all' , compact('items','brands','countries','my_cars'));
    }

    public function edit(Car $item)
    {
        $my_cars = true;

        $brands = Brand::orderby('name_'.my_lang(),'desc')->get();
        $models = Modell::models_brand ($item->brand_id)->get();

        $countries = Country::orderby('name_'.my_lang(),'desc')->get();
        $regions = Region::country_regions ($item->country_id)->get();
        $cities = City::regions ($item->region_id)->get();

        return view($this->view . 'edit',compact('item','brands','countries','my_cars','models','regions','cities'));
    }

    public function store($id = null , Request $request)
    {
        
        $data = $request->except('_token');
        $data['user_id'] = logged_user()->id;
        $data['user_type'] = user_type();
 
        $id ? $item = Car::where('id',$id)->update($data) :  $item = Car::create($data);

        if($item){
            if($request->imgs){
                foreach($request->imgs as $img){
                    $fileName = time().'.'.$img->extension();  
                    $img->move(public_path('uploads'), $fileName);
            
                    $carImg = CarImage::create(['car_id' => $item->id , 'photo' => $fileName]);
                }            
            } 

            return redirect()->route('control.cars')->with('success' , __('site.success-save') );
        }
        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(Car::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function car_img_delete(Request $request){
        $item = $request->input('id');

        if(CarImage::find($item)->delete()) 
            return 1;

        return 0;
    }
}
