<?php

namespace App\Http\Controllers\Control;

use App\Models\Brand;
use App\Models\Modell;
use App\Models\City;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Auth;

class UserInterestsController extends Controller
{
    protected $view = "control.interests.";

    public function index()
    {
        $interests = UserInterest::where('user_id', logged_user()->id)
        ->orderby('id', 'desc')->get();


        $brands = Brand::orderby('name_'.my_lang(), 'desc')->get();
        $cities = City::orderby('name_'.my_lang(), 'desc')->get();

        //dd($interests);

        return view($this->view . 'all', compact('interests', 'brands', 'cities'));
    }

    public function store($id = null, Request $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = logged_user()->id;


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
        //dd('aa');
        return view($this->view . 'edit', compact('item', 'brands', 'cities', 'models'));
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
