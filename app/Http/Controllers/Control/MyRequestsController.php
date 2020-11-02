<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ElectronicRequest;
use App\Models\AssignSeller;


class MyRequestsController extends Controller
{
    protected $view = "control.requests.";

    public function all()
    {
        $my_requests = true;

        $items = ElectronicRequest::with('assign_sellers')->with('piece_alt')->myRequests()->orderby('id','desc')->get();

        return view($this->view . 'all',compact('items','my_requests'));
    }
    
    function offers($id)
    {
        $my_requests = true;

        $item = ElectronicRequest::with('piece_alt')->where('id',$id)->first();

        $sellers = AssignSeller::with('seller')->where('request_id',$id)->orderby('id','desc')->get();
        
        return view($this->view . 'offers',compact('my_requests','item','sellers'));
    }

    function edit($id)
    {
        $my_requests = true;

        $item = ElectronicRequest::with('piece_alt')->where('id',$id)->first();

        return view($this->view . 'edit',compact('item','my_requests'));
    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(ElectronicRequest::find($item)->delete()) 
            return 1;

        return 0;
    }
}
