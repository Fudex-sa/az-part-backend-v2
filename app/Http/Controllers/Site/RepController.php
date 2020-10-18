<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\RepSignupRequest;
use App\Models\Rep;

class RepController extends Controller
{
    protected $view = "site.auth.";
    
    public function register()
    {
        return view($this->view . 'register_rep');
    }

   
    public function signup(RepSignupRequest $request)
    {
        
        $data = $request->except('_token','api_token','country_id','region_id');
         
 
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
