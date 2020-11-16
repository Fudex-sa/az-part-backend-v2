<?php
namespace App\Helpers;

use Session;
use App\Models\PackageSubscribe;
use App\Models\Package;
use App\Models\Order;

class PackageHelp
{

    public function subscribe()
    {
        $package_id = Session::get('package_id');

        $package = Package::find($package_id);

        $item = PackageSubscribe::create([
            'user_id' => logged_user()->id ,'user_type' => user_type() , 'package_id' => $package_id ,
            'package_type' => $package->type ,
            'price' => total() , 'stores_no' => $package->stores_no                 
        ]);
    

        if($item)
            $response = true;
        
        else $response = false;

        Session::forget('package_id');

        return $response;
    }

    public function stores_limit($package_type)
    {
        $limit = PackageSubscribe::myPackagesByType($package_type)->get()->sum('stores_no');

        return $limit;
    }

    public function update_expired($package_sub_id) {

        $my_subscribe = PackageSubscribe::find($package_sub_id);
 
        $reqs = $my_subscribe->stores_no;

        if($my_subscribe->package_type == 'manual')
            PackageSubscribe::myPackages()->update(['expired' => 1]);

        else {

            $my_orders = Order::where('package_sub_id',$package_sub_id)->count();

            if($my_orders == $reqs)
                PackageSubscribe::myPackages()->update(['expired' => 1]);  
        }
    }

}