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
use App\Models\Bank;
use App\Models\DeliveryRegion;
use App\Models\VipRequest;

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
            $regions = Region::where('country_id',1)->orderby('name_ar','desc')->get();
            $cities = null;
        } 

        $banks = Bank::all();
        $delivery_regions = DeliveryRegion::all();

        $vip_user = VipRequest::where('user_id',logged_user()->id)->where('user_type',user_type())->first();

        return view($this->view . 'profile', compact('profile','regions','cities','banks','delivery_regions','vip_user'));
    }

    public function update(AllUsersRequest $request)
    {
          
        $user = logged_user();
 
        if(user_type() == 'seller') 
            $data = $request->except('_token','api_token','confirm_password');
        else 
           $data = $request->except('_token','api_token','confirm_password','tashlih_region');

          
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
        
        elseif(user_type() == 'broker')
            $response = Broker::where('id',$user->id)->update($data);
        
        elseif(user_type() == 'rep')
            $response = Rep::where('id',$user->id)->update($data);
        
        else
            $response = User::where('id',$user->id)->update($data);
        
        
        if($response)
             return back()->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen') );

    }

    public function request_vip()
    {
         
        $exists = VipRequest::where('user_id',logged_user()->id)->where('user_type',user_type())->first();
        if(! $exists){
            
            if( VipRequest::create(['user_id' => logged_user()->id , 'user_type' => user_type()]))
                return back()->with('success' , __('site.your_vip_request_under_review') );

        }

        return back()->with('failed' , __('site.error-happen') );
    }
}
