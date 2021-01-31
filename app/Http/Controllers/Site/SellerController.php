<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Broker;
use App\Models\Seller;
use App\Models\User;
use App\Models\Company;
use App\Models\Supervisor;
use App\Models\Rep;
use App\Models\DeliveryRegion;
use App\Http\Requests\Site\SellerSignup;

class SellerController extends Controller
{
    protected $view = "site.auth.";
    
    public function register()
    {
        $delvry_regions = DeliveryRegion::all();

        return view($this->view . 'register_seller' , compact('delvry_regions'));
    }

   
    public function signup(SellerSignup $request)
    {
        
        $data = $request->except('_token','api_token','user_type');
         
        $if_exists = User::where('mobile',$request->mobile)->first();
        $if_exists2 = Company::where('mobile',$request->mobile)->first();
        $if_exists3 = Rep::where('mobile',$request->mobile)->first();
        $if_exists4 = Supervisor::where('mobile',$request->mobile)->first();

        if($if_exists || $if_exists2 || $if_exists3 || $if_exists4)
            return back()->with('failed' , __('site.duplicated_user'))->withInput();

 
        $data['password'] = bcrypt($request->password);
        $verification_code = rand(10000,99999);
        $data['verification_code'] = $verification_code;
        
        if($request->user_type == 't') $data['user_type'] = 'tashalih';
        
        else if($request->user_type == 'm') $data['user_type'] = 'manufacturing';

        if($request->photo){
            $fileName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads'), $fileName);
     
            $data['photo'] = $fileName;
        }  

        if($request->user_type == 'b')
            $item = Broker::create($data);
         
        else 
            $item = Seller::create($data);

        if($item){
            $message = notification('verfication_message') . $verification_code;
            send_sms($item->mobile,$message);

            return redirect()->route('verfication',['id'=>$item->id , 'type' => $request->user_type]);
        }            

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

}
