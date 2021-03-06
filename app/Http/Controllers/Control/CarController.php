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
use App\Models\InterestNotify;
use App\Models\UserInterest;


use App\Http\Controllers\Api\PushNotificationController;
use App\Http\Requests\Control\CarRequest;

class CarController extends Controller
{
    protected $view = "control.cars.";

    public function all()
    {
        $my_cars = true;

        $items = Car::with('imgs')->where('user_id', logged_user()->id)->where('user_type', user_type())
                    ->orderby('id', 'desc')->get();

        $brands = Brand::orderby('name_'.my_lang(), 'desc')->get();
        $countries = Country::orderby('name_'.my_lang(), 'desc')->get();

        return view($this->view . 'all', compact('items', 'my_cars','brands','countries'));
    }

    public function add()
    {
        $my_cars = true;
        $brands = Brand::orderby('name_'.my_lang(), 'desc')->get();
        $countries = Country::orderby('name_'.my_lang(), 'desc')->get();

        return view($this->view.'create',compact('brands', 'countries','my_cars'));
    }

    public function edit(Car $item)
    {
        $my_cars = true;

        $brands = Brand::orderby('name_'.my_lang(), 'desc')->get();
        $models = Modell::models_brand($item->brand_id)->get();

        $countries = Country::orderby('name_'.my_lang(), 'desc')->get();
        $regions = Region::country_regions($item->country_id)->get();
        $cities = City::regions($item->region_id)->get();

        return view($this->view . 'edit', compact('item', 'brands', 'countries', 'my_cars', 'models', 'regions', 'cities'));
    }

    public function store($id = null, CarRequest $request)
    {
        $data = $request->except('_token','imgs');
        
        $data['user_id'] = logged_user()->id;
        $data['user_type'] = user_type();

       if($id){
            $update = Car::where('id', $id)->update($data);
            $item = Car::find($id);

       } else $item = Car::create($data);

        if ($item) {
            if ($request->imgs) {
                foreach ($request->imgs as $img) {
                    
                    if($img->getSize() > 900000)
                        return back()->with('failed', __('site.car_image_shoud_not_excced_10m'))->withInput();

                         
                    $fileName = $img->getClientOriginalName();
                    $img->move(public_path('uploads'), $fileName);
 
                    $carImg = CarImage::create(['car_id' => $item->id , 'photo' => $fileName]);
                }
            }

            if ($item->price != null) {
                $interests = UserInterest::where('brand_id', $item->brand_id)
                                        ->where('car_model_id', $item->model_id)
                                        ->where('year', $item->year)
                                        ->where('city_id', $item->city_id)
                                          ->where('country_id', $item->country_id)
                                          ->where('region_id', $item->region_id)
                                          ->where('price_from', '<', $item->price)
                                          ->where('price_to', '>', $item->price)
                                        ->get();
            } else {
                $interests = UserInterest::where('brand_id', $item->brand_id)
                                        ->where('car_model_id', $item->model_id)
                                        ->where('year', $item->year)
                                        ->where('city_id', $item->city_id)
                                        ->where('country_id', $item->country_id)
                                        ->where('region_id', $item->region_id)
                                        ->get();
            }

            if ($interests) {
                foreach ($interests as $interest) {
                    InterestNotify::create([
                        'car_id' => $item->id,
                        'user_interest_id' => $interest->id,
                        'seen' => 0
                    ]);

                    $user_token = $interest->user['api_token'];

                    $title = __('site.new_car_you_interest_in');
                    $body = __('site.car') . $item->title . ' ' .$title .
                            __('site.have_been_reached_now');
                    PushNotificationController::send((array)$user_token, $title, $body, 'car', $item->id);
                }
            }

            return redirect()->route('control.cars')->with('success', __('site.success-save'));
        }
        return back()->with('failed', __('site.error-happen'))->withInput();
    }

    public function delete(Request $request)
    {
        $item = $request->input('id');

        if (Car::find($item)->delete()) {
            return 1;
        }

        return 0;
    }

    public function car_img_delete(Request $request)
    {
        $item = $request->input('id');

        if (CarImage::find($item)->delete()) {
            return 1;
        }

        return 0;
    }
}
