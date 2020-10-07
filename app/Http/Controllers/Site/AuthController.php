<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Auth;
use App\Http\Requests\Site\LoginRequest;

class AuthController extends Controller
{
    
    public function forget_password()
    {
        return view('site.reset_password');
    }

    public function reset_password(Request $request)
    {
        $type = $request->user_type;

        $verification_code = rand(10000,99999);

        if($type == 'u')
            $item = User::where('mobile',$request->mobile)->first();
        elseif($type == 'c')
            $item = Company::where('mobile',$request->mobile)->first();

        if($item){
            $item->verification_code = $verification_code;
            $item->save();

            $message = notification('verfication_message') . $verification_code;
            send_sms($item->mobile,$message);

            return redirect()->route('verfication',['id'=>$item->id , 'type' => $request->user_type]);
        }
        
        return back()->with('failed' , __('site.number_not_registered'))->withInput();

    }

    public function login(LoginRequest $request)
    {
    
        $cred = ['mobile' => $request->mobile, 'password' => $request->password];

        $type = $request->user_type ? $request->user_type : 'u';

        if($request->user_type == 'c')
            $response = company_login($request,$cred);

        else
            $response = $this->user_login($request,$cred);
 
        if($response == 1)
            return redirect()->route('profile'); 

        else  if($response == -1)
            return back()->with('failed' , __('site.invalid_login') )->withInput();
        
        else return redirect()->route('verfication',['id' => $response , 'type' => $type]);               
        
    }

    public function company_login(LoginRequest $request,$cred)
    {
        if (auth()->guard('company')->validate($cred)) {
            
            $user = Company::where('mobile',$request->mobile)->first();

            if ($user->active == 1 && Auth::guard('company')->attempt($cred)) {
                return true;         

            } else {                
                $this->send_new_code($user);
 
                return $user->id;       
            }
        }else
          return -1;
    }

    public function user_login(LoginRequest $request,$cred)
    {
        if (auth()->guard()->validate($cred)) {
            
            $user = User::where('mobile',$request->mobile)->first();

            if ($user->active == 1 && Auth::attempt($cred)) {
                return true;      

            } else {                
                $this->send_new_code($user);
 
                return $user->id;
            }
        }else
          return -1;
    }

    public function logout()
    {
        Auth::logout();
        Auth::guard('company')->logout();

        return redirect()->route('home');
    }

    public function send_new_code($item)
    {
        
        $verification_code = rand(10000,99999);
        $item->verification_code = $verification_code;
        $item->save();

        $message = notification('verfication_message') . $verification_code;
        send_sms($item->mobile,$message);

    }

}
