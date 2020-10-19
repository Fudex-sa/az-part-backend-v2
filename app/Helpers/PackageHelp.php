<?php
namespace App\Helpers;

use Session;
use App\Models\PackageSubscribe;
use App\Models\Package;

class PackageHelp
{

    public function subscribe()
    {
        $package_id = Session::get('package_id');

        $package = Package::find($package_id);

        if($package_id){
            $item = PackageSubscribe::create([
                'user_id' => logged_user()->id ,'user_type' => user_type() , 'package_id' => $package_id ,
                'package_type' => $package->type ,
                'price' => total() , 'stores_no' => $package->stores_no                 
            ]);
        }

        Session::forget('payment_type');
        Session::forget('package_id');
    }

    public function stores_limit($package_type)
    {
        $limit = PackageSubscribe::myPackagesByType($package_type)->get()->sum('stores_no');

        return $limit;
    }

    public function update_expired($order_id,$package_type) {

        if($package_type == 'manual')
            PackageSubscribe::myPackagesByType($package_type)->update([
                'expired' => 1 , 'order_id' => $order_id
            ]);

        else 
            PackageSubscribe::myPackagesByType($package_type)->update([
                'order_id' => $order_id
            ]);  
        
    }

}