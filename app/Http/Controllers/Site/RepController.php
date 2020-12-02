<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\RepSignupRequest;
use App\Models\Rep;
use App\Models\Broker;
use App\Models\Seller;
use App\Models\User;
use App\Models\Company;
use App\Models\Supervisor;

class RepController extends Controller
{
    protected $view = "site.auth.";
    
    public function register()
    {
        return view($this->view . 'register_rep');
    }

   
    public function signup(RepSignupRequest $request)
    {
        
        $data = $request->except('_token','api_token');
         
        $if_exists = User::where('mobile',$request->mobile)->first();
        $if_exists2 = Company::where('mobile',$request->mobile)->first();
        $if_exists3 = Seller::where('mobile',$request->mobile)->first();
        $if_exists4 = Supervisor::where('mobile',$request->mobile)->first();
        $if_exists5 = Broker::where('mobile',$request->mobile)->first();

        if($if_exists || $if_exists2 || $if_exists3 || $if_exists4 || $if_exists5)
            return back()->with('failed' , __('site.duplicated_user'))->withInput();
 
        $data['password'] = bcrypt($request->password);
        $verification_code = rand(10000,99999);
        $data['verification_code'] = $verification_code;

        if($request->photo){
            $fileName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads'), $fileName);
     
            $data['photo'] = $fileName;
        }  
 
        $item = Rep::create($data);

        if($item){
            $message = notification('verfication_message') . $verification_code;
            send_sms($item->mobile,$message);

            return redirect()->route('verfication',['id'=>$item->id , 'type' => 'r']);
        }            

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }
}
