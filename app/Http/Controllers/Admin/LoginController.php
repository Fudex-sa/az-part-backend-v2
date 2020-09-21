<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supervisor;
use Auth;

class LoginController extends Controller
{
    protected $view = "dashboard.auth.";

    public function index()
    {
        return view($this->view.'login');
    }

    public function login(Request $request)
    {
        
        $credentials = $request->except(['_token']);

        $user = Supervisor::where('mobile',$request->mobile)->first();

        if(Auth::guard('admin')->attempt($credentials))            

            return redirect()->route('admin.dashboard');

        return back()->with('failed' , __('site.invalid_login') );

    }

}
