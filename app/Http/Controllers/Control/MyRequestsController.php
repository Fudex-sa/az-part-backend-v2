<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ElectronicEngine;

class MyRequestsController extends Controller
{
    protected $view = "control.requests.";

    public function all()
    {
        $my_requests = true;

        $items = ElectronicEngine::with('piece_alt')->myRequests()->orderby('id','desc')->get();
        
        return view($this->view . 'all',compact('items','my_requests'));
    }
    
    function show($id)
    {
        $item = ElectronicEngine::with('piece_alt')->where('id',$id)->first();

        return view($this->view . 'show',compact('item'));
    }

    public function delete(Request $request){
        $item = $request->input('id');

        if(ElectronicEngine::find($item)->delete()) 
            return 1;

        return 0;
    }
}
