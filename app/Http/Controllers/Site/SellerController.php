<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Broker;
use App\Models\Seller;
use App\Http\Requests\Site\SellerSignup;

class SellerController extends Controller
{
    protected $view = "site.auth.";
    
    public function register()
    {
        return view($this->view . 'register_seller');
    }

   
    public function signup(SellerSignup $request)
    {
        
        $data = $request->except('_token','api_token','user_type');
         
 
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
