<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Helpers\ElecEngine;

class ElectronicController extends Controller
{
    protected $view = "site.parts.";
    protected $elechelp;
    
    public function __construct()
    {
        $this->elechelp = new ElecEngine();

    }

    public function create_request(Request $request)
    {
         
        if($this->elechelp->send_request($request) == 1){ 
            return redirect()->route('my_requests')->with('success' , __('site.your_request_sent_successfully'));
        }else
            return back()->with('failed' , __('site.error-happen'))->withInput();

    }
}
