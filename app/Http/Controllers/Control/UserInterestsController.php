<?php

namespace App\Http\Controllers\Control;

use App\Models\Brand;
use App\Models\Modell;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use App\Http\Requests\Site\UserInterestRequest;

use App\Models\UserInterest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Auth;
use Validator;

class UserInterestsController extends Controller
{
    protected $view = "control.interests.";

    public function index()
    {
        $interests = UserInterest::where('user_id', logged_user()->id)
        ->orderby('id', 'desc')->get();


        $brands = Brand::orderby('name_'.my_lang(), 'desc')->get();
        $cities = City::orderby('name_'.my_lang(), 'desc')->get();
        $countries = Country::orderby('name_'.my_lang(), 'desc')->get();


        //dd($interests);

        return view($this->view . 'all', compact('interests', 'brands', 'cities', 'countries'));
    }

    public function store($id = null, UserInterestRequest $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = logged_user()->id;

        if (request('price_type') == 'fixed') {
            $rules = [
                'price_from' => 'required',
                'price_to' => 'required',
              ];

            $customMessages = [
              'price_from.required' =>  __('site.price_required'),
              'price_to.required' =>  __('site.price_required'),
            ];
            $validator = Validator::make($request->all(), $rules, $customMessages);

            if ($validator->fails()) {
                return redirect()->back()->with('failed', $validator->errors()->first());
            }
        }

        $id ? $item = UserInterest::where('id', $id)->update($data) :  $item = UserInterest::create($data);

        if ($item) {
            return redirect()->route('control.user_interests')->with('success', __('site.success-save'));
        }
        return back()->with('failed', __('site.error-happen'))->withInput();
    }


    public function edit(UserInterest $item)
    {
        $brands = Brand::orderby('name_'.my_lang(), 'desc')->get();
        $models = Modell::models_brand($item->brand_id)->get();
        $cities = City::orderby('name_'.my_lang(), 'desc')->get();
        $countries = Country::orderby('name_'.my_lang(), 'desc')->get();
        $regions = Region::country_regions($item->country_id)->get();
        //dd('aa');
        return view($this->view . 'edit', compact('item', 'brands', 'cities', 'models', 'countries', 'regions'));
    }



    public function delete(Request $request, $id)
    {
        $item = $request->input('id');
        if (UserInterest::find($id)->delete()) {
            return redirect()->route('control.user_interests')->with('success', __('site.delete_success'));
        } else {
            return back()->with('failed', __('site.error-happen'));
        }
    }
}
