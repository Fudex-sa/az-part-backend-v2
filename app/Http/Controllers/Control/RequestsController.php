<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignSeller;
use App\Models\ElectronicRequest;

class RequestsController extends Controller
{
    protected $view = "control.requests.";
 
    public function show($id)
    {
        $my_requests = true;

        $item = ElectronicRequest::with('user')->where('id',$id)->first();

        if(user_type() == 'seller')
            $req_seller = AssignSeller::where('request_id',$item->id)
                        ->where('seller_id',logged_user()->id)->first();
        
        else $req_seller = null;

        return  view($this->view . 'show',compact('my_requests','item','req_seller'));
    }

    public function update(Request $request,AssignSeller $item)
    {
        $item->price = $request->price;
        $item->status_id =  10;
        
        if($item->save())
            return back()->with('success' , __('site.success-save') );

        return back()->with('failed' , __('site.error-happen'))->withInput();
 
    }
 
}
