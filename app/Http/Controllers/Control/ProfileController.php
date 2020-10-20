<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\AllUsersRequest;
use App\Models\User;
use App\Models\Company;
use App\Models\Seller;
use App\Models\Broker;
use App\Models\Rep;
use App\Models\Region;
use App\Models\City;

class ProfileController extends Controller
{
    protected $view = "control.";
    
    public function index()
    {
        $profile = true;

        if(logged_user()->region){
            $regions = Region::where('country_id',logged_user()->region['country_id'])->orderby('name_ar','desc')->get();
            $cities = City::where('region_id',logged_user()->region_id)->orderby('name_ar','desc')->get();
        }else{
            $regions = null;
            $cities = null;
        } 

        return view($this->view . 'profile', compact('profile','regions','cities'));
    }

    public function update(AllUsersRequest $request)
    {
          
        $user = logged_user();

         $data = $request->except('_token','api_token','country_id','confirm_password');
  
          
         ($request->password) ? $password = bcrypt($request->password) : $password = $user->password;
         
         $data['password'] = $password; 

        if($request->photo){
            $fileName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads'), $fileName);
     
            $data['photo'] = $fileName;
        }  

        if(user_type() == 'company')
            $response = Company::where('id',$user->id)->update($data);
        elseif(user_type() == 'seller')
            $response = Seller::where('id',$user->id)->update($data);
        if(user_type() == 'broker')
            $response = Broker::where('id',$user->id)->update($data);
        if(user_type() == 'rep')
            $response = Rep::where('id',$user->id)->update($data);
        else
            $response = User::where('id',$user->id)->update($data);
        
        
        if($response)
             return back()->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen') );

    }
}
