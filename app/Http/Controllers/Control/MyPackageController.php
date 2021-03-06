<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageSubscribe;

class MyPackageController extends Controller
{
    protected $view = "control.";

    public function index()
    {
        $my_packages = true;
 
        $items = PackageSubscribe::with('my_orders')
                    ->myAllPackages()                    
                    ->with('package')->orderby('id','desc')->get(); 

        return view($this->view . 'my_packages',compact('my_packages','items'));
    }
}
