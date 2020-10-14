<?php
namespace App\Helpers;

use Session;
use App\Models\PackageSubscribe;

class PackageHelp
{

     
    public function subscribe()
    {
        $package_id = Session::get('package_id');

        if($package_id){
            $item = PackageSubscribe::create([
                'user_id' => logged_user()->id , 'package_id' => $package_id ,
                'price' => total()
            ]);
        }

        Session::forget('payment_type');
        Session::forget('package_id');
    }

    


}