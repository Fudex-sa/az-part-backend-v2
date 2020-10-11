<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Broker;
use App\Models\Seller;
use App\Models\Rep;
use Auth;

class VerficationController extends Controller
{
    
    public function index($id,$type)
    {
        return view('site.verfication',compact('id','type'));
    }

    public function confirm($id,$type,Request $request)
    {
        
        $verification_code = implode('',$request->verification_code);
         
        if($type == 'u')
            $item = User::find($id);
        
        elseif($type == 'c')
            $item = Company::find($id);

        elseif($type == 'b')
            $item = Broker::find($id);

        elseif($type == 'r')
            $item = Rep::find($id);
        
        else
            $item = Seller::find($id);

        if($item->verification_code == $verification_code){
            $item->active = 1;
            $item->save();

            if($type == 'u') Auth::login($item);
            elseif($type == 'c') Auth::guard('company')->login($item);
            elseif($type == 'b') Auth::guard('broker')->login($item);
            elseif($type == 'r') Auth::guard('rep')->login($item);
            else Auth::guard('seller')->login($item);

            return redirect()->route('home');
        }

        return back()->with('failed' , __('site.in_valid_code'));
  
    }

    public function resend_code($id)
    {
         
        if($user_type == 'u')
            User::where('id',$id)->update(['verification_code' => rand(10000,99999) ]);
        
        if($user_type == 'c')
            Company::where('id',$id)->update(['verification_code' => rand(10000,99999) ]);

        if($user_type == 'b')
            Broker::where('id',$id)->update(['verification_code' => rand(10000,99999) ]);

        if($user_type == 'r')
            Rep::where('id',$id)->update(['verification_code' => rand(10000,99999) ]);

        else
            Seller::where('id',$id)->update(['verification_code' => rand(10000,99999) ]);
        
        return back()->with('success',__('site.your_verfication_code_sent'));

    }
}
