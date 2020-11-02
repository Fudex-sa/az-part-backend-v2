<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\UserSignup;
use App\Models\User;
use App\Models\Company;
use Auth;

class UserController extends Controller
{
    protected $view = "site.auth.";

    public function register()
    {
        return view($this->view . 'register_user');
    }

   
    public function signup(UserSignup $request)
    {
        $data = $request->except('_token','api_token','country_id','region_id','user_type');
 
        $data['password'] = bcrypt($request->password);
        $verification_code = rand(10000,99999);
        $data['verification_code'] = $verification_code;
        
        
        if($request->photo){
            $fileName = time().'.'.$request->photo->extension();  
            $request->photo->move(public_path('uploads'), $fileName);
     
            $data['photo'] = $fileName;
        }  

        if($request->user_type == 'c')
            $item = Company::create($data);
        else 
            $item = User::create($data);

        if($item){
            $message = notification('verfication_message') . $verification_code;
            send_sms($item->mobile,$message);

            return redirect()->route('verfication',['id'=>$item->id , 'type' => $request->user_type]);
        }            

        return back()->with('failed' , __('site.error-happen'))->withInput();

    }

   


}
