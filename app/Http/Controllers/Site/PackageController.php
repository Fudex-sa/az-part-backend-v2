<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use Session;

class PackageController extends Controller
{
    protected $view = "site.packages.";


    public function show($type)
    {
        $items = Package::type($type)->orderby('id','desc')->get();

        return view($this->view . 'show',compact('type','items'));
    }

    public function subscribe($id)
    {
        Session::put('payment_type','package');

        Session::put('package_id',$id);
        
        return redirect()->route('payment.method');
    }
}
