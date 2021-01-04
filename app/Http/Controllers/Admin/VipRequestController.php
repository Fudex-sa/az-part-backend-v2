<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VipRequest;

class VipRequestController extends Controller
{
    protected $view = "dashboard.vip_requests.";

    public function all()
    {
        $items = VipRequest::with('user')->orderby('id','desc')->paginate(pagger());

        return view($this->view.'all',compact('items'));
    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(VipRequest::find($item)->delete()) 
            return 1;

        return 0;
    }

    public function activate(Request $request)
    {
        $item = $request->input('id'); 

        if( VipRequest::where('id',$item)->update(['status' => 'accepted']) )
            return 1;

        return 0;        
    }

    public function deActivate(Request $request)
    {
        $item = $request->input('id');
 
        if( VipRequest::where('id',$item)->update(['status' => 'rejected']) )
            return 1;

        return 0;        
    }

}
