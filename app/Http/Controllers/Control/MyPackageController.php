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

        $items = PackageSubscribe::myAllPackages()->with('package')->get();
 
        return view($this->view . 'my_packages',compact('my_packages','items'));
    }
}
