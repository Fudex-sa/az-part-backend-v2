<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageSubscribe;
use Session;

class PackageController extends Controller
{
 
    public function show($type)
    {
        $packages = true;

        $items = Package::type($type)->orderby('id','desc')->get();

        return view('site.packages',compact('type','items','packages'));
    }

    public function subscribe($id)
    {
        $package = Package::find($id);
        $myPackage = PackageSubscribe::myPackagesByType($package->type)->count();

        if($myPackage < 1){
            Session::put('package_id',$id);
            
            return redirect()->route('payment.method','package');
        }else
            return back()->with('failed' , __('site.You_already_join_in_package'))->withInput();
    }
}
