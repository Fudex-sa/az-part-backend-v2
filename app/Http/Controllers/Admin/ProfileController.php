<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    protected $view = "dashboard.";
 
    public function index(){     
        $user = Admin::find(auth('admin')->user()->id);  

        return view($this->view.'profile',compact('user'));
    }

    public function update(Request $request){
        $user = Admin::find(auth('admin')->user()->id);

        $rules = [
            'name' => 'required',            
            'mobile' => 'required|unique:users,mobile,'.$user->id,
          ];
  
         $messages = [            
            'mobile.unique' => __('site.duplicated_mobile_used')
         ];
  
         $this->validate($request, $rules, $messages);
   
         $data = $request->except('_token','api_token');
  
          
         ($request->password) ? $password = bcrypt($request->password) : $password = $user->password;
         
         $data['password'] = $password; 

         $response = Admin::where('id',$user->id)->update($data);
        
         if($response)
             return back()->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen') );

             
    }
}
