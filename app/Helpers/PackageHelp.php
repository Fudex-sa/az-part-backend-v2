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
                'user_id' => logged_user()->id , 'package_id' => $package_id ,
                'price' => total() , 'stores_no' => $package->stores_no                 
            ]);
        }

        Session::forget('payment_type');
        Session::forget('package_id');
    }

    public function stores_limit()
    {
        $limit = PackageSubscribe::myPackages()->get()->sum('stores_no');

        return $limit;
    }

    public function update_expired($order_id) {
                
        PackageSubscribe::myPackages()->update(['expired' => 1 , 'order_id' => $order_id]);
        
    }

}