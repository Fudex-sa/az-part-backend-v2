<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ElectronicRequest;

class ElecEngineController extends Controller
{
    
    protected $view = "dashboard.engine.";

    public function all()
    {
        $items = ElectronicRequest::with('piece_alt')->with('brand')->with('model')->with('region')
                    ->with('user')
                    ->orderby('id','desc')->paginate(pagger());

        return view($this->view . 'all' , compact('items'));
    }

    public function show($id)
    {
        $item = ElectronicRequest::with('piece_alt')->with('brand')->with('model')->with('region')
                                ->with('user')->with('country')
                                ->where('id',$id)
                                ->orderby('id','desc')->first();

        return view($this->view . 'show' , compact('item'));
    }

    public function engine($id)
    {
        $item = ElectronicRequest::with('piece_alt')->with('brand')->with('model')->with('region')
                                ->with('user')->with('country')
                                ->with('assign_sellers')
                                ->where('id',$id)
                                ->orderby('id','desc')->first();

        return view($this->view . 'sellers' , compact('item'));
    }

}
