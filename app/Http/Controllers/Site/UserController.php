<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\UserSignup;
use App\Models\User;
use App\Models\Company;
use Auth;
use App\Http\Requests\Site\LoginRequest;

class UserController extends Controller
{
    
    public function register()
    {
        return view('site.register_user');
    }

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

    public function login(LoginRequest $request)
    {
        
        $credentials = $request->except(['_token']);
 
        // if(auth()->attempt($credentials))            
 
        // if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password , 'active' => 1])) 
        // //     // return redirect()->intended($this->redirectPath());
        //     return redirect()->route('profile');            
         
        $cred = ['mobile' => $request->mobile, 'password' => $request->password];

        if (auth()->guard()->validate($cred)) {
            
            $user = User::where('mobile',$request->mobile)->first();

            if ($user->active == 1 && Auth::attempt($cred)) {
                return redirect()->route('profile');       

            } else {
                $verification_code = rand(10000,99999);
                $user->verification_code = $verification_code;
                $user->save();

                $message = notification('verfication_message') . $verification_code;
                send_sms($user->mobile,$message);

                return redirect()->route('verfication',['id' => $user->id , 'type' => 'u']);       

            }
        }else
            return back()->with('failed' , __('site.invalid_login') )->withInput();
    }

    public function logout()
    {
        Auth::logout();
        Auth::guard('company')->logout();

        return redirect()->route('home');
    }


}
