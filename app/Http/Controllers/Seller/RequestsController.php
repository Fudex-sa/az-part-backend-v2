<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignSeller;
use App\Models\ElectronicRequest;

class RequestsController extends Controller
{
    protected $view = "sellers.requests.";

    public function all()
    {
        $my_requests = true;

        $items = AssignSeller::where('seller_id',logged_user()->id)->orderby('id','desc')->paginate(pagger());

        return view($this->view . 'all',compact('my_requests','items'));
    }

    public function show($id)
    {
        $my_requests = true;

        $item = ElectronicRequest::with('user')->where('id',$id)->first();

        $req_seller = AssignSeller::where('request_id',$item->id)->where('seller_id',logged_user()->id)->first();

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
