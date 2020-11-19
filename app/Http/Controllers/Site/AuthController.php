<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\seller;
use App\Models\Broker;
use App\Models\rep;
use Auth;
use App\Http\Requests\Site\LoginRequest;
use Session;
use App\Helpers\Search;

class AuthController extends Controller
{
    protected $view = "site.auth.";
    protected $search;

    public function __construct()
    {    
        $this->search = new Search();
    }

    public function signup_as()
    {       
        return view($this->view . 'signup_as');
    }


    public function signin()
    {
        return view($this->view . 'signin');
    }

    public function login_as()
    {
        return view($this->view . 'login_as');
    }

    public function forget_password()
    {
        return view($this->view . 'reset_password');
    }

    public function reset_password(Request $request)
    {
        $type = $request->user_type;

        $verification_code = rand(10000,99999);

        if($type == 'u')
            $item = User::where('mobile',$request->mobile)->first();
        
        elseif($type == 'c')
            $item = Company::where('mobile',$request->mobile)->first();

        elseif($type == 'b')
            $item = Broker::where('mobile',$request->mobile)->first();

        elseif($type == 'r')
            $item = Rep::where('mobile',$request->mobile)->first();

        else
            $item = Seller::where('mobile',$request->mobile)->first();


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
            $response = $this->company_login($request,$cred);

        elseif($request->user_type == 'u')
            $response = $this->user_login($request,$cred);

        elseif($request->user_type == 'b')
            $response = $this->broker_login($request,$cred);
 
        elseif($request->user_type == 'r')
            $response = $this->rep_login($request,$cred);

        else
            $response = $this->seller_login($request,$cred);

        if($response == 1){
            $search = Session::get('search');
 
            if( $search && session()->get('has_request') == 1)
                return redirect($this->search->search_url()); 
             
            else 
                return redirect()->route('profile'); 
        }
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

    public function seller_login(LoginRequest $request,$cred)
    {
        if (auth()->guard('seller')->validate($cred)) {
            
            $user = Seller::where('mobile',$request->mobile)->first();

            if ($user->active == 1 && Auth::guard('seller')->attempt($cred)) {
                return true;         

            } else {                
                $this->send_new_code($user);
 
                return $user->id;       
            }
        }else
          return -1;
    }

    public function broker_login(LoginRequest $request,$cred)
    {
        if (auth()->guard('broker')->validate($cred)) {
            
            $user = Broker::where('mobile',$request->mobile)->first();

            if ($user->active == 1 && Auth::guard('broker')->attempt($cred)) {
                return true;         

            } else {                
                $this->send_new_code($user);
 
                return $user->id;       
            }
        }else
          return -1;
    }

    public function rep_login(LoginRequest $request,$cred)
    {
        if (auth()->guard('rep')->validate($cred)) {
            
            $user = Rep::where('mobile',$request->mobile)->first();

            if ($user->active == 1 && Auth::guard('rep')->attempt($cred)) {
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
        Auth::guard('broker')->logout();
        Auth::guard('seller')->logout();
        Auth::guard('rep')->logout();

        clear_session();
        
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
