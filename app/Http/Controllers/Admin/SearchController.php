<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    protected $view = "dashboard.search.";

    public function index(Request $request)
    {
        $items = User::where('name','like','%'.$request->search_text.'%')
                        ->orWhere('mobile',$request->search_text)
                        ->orderby('name','desc')->paginate(pagger());
        
        return view($this->view.'users',compact('items'));
    }
}
