<?php
namespace App\Helpers;

use Session;
use App\Models\PackageSubscribe;
use App\Models\Package;
use App\Models\Order;
use App\Models\ElectronicRequest;
use App\Helpers\Search;
use App\Models\Seller;
use App\Models\Company;
use App\Models\broker;
use App\Models\User;

class PackageHelp
{

    protected $search;

    public function __construct()
    {     
        
        $this->search = new Search();
    }

    public function subscribe()
    {
        $package_id = Session::get('package_id');

        $package = Package::find($package_id);

        $item = PackageSubscribe::create([
            'user_id' => logged_user()->id ,'user_type' => user_type() , 'package_id' => $package_id ,
            'package_type' => $package->type ,
            'price' => total() , 'stores_no' => $package->stores_no ,
            'remaining' =>  $package->stores_no,
            'coupon_id' => coupon_id()          
        ]);
    

        if($item){
            $response = true;
            
            $brand = $this->search->search_res('brand');
            $model = $this->search->search_res('model');
            $year = $this->search->search_res('year');
            $country = $this->search->search_res('country');
            $region = $this->search->search_res('region');
            $city = $this->search->search_res('city');

            $this->search->update_limit_history($this->final_limit());

            // $this->search->save_search_history($brand,$model,$year,$country,$region,$city,
            //                 $this->final_limit());

            // $this->update_remaining(session()->get('remaining_stores'));

        }else $response = false;

        session()->forget('package_id');
        session()->forget('coupon');

        return $response;
    }

    public function stores_limit($package_type)
    {
        $limit = PackageSubscribe::myPackagesByType($package_type)->get()->sum('remaining');

        return $limit;
    }

    public function final_limit()
    {
        $sys_limit = setting('manual_search_result');
          
        $this->stores_limit('manual') > 0 ? 

                $limit = $this->stores_limit('manual') + $sys_limit : $limit = $sys_limit;
           
        $limit = $limit + logged_user()->special_stores_no;
 
        return $limit;

    }
 

    public function update_remaining($remaining)
    {
        // $cookies = $this->search->delete_cookies();
        // if($cookies == 0){

            ($remaining < 0) ? $remaining = 0 : $remaining = $remaining;

            $item = PackageSubscribe::myPackagesByType('manual')->first();
            if($item){
                $item->remaining = $remaining;
                $item->save();

                if($item->remaining == 0)
                    $this->update_expired($item->id);
            }
        // }

    }
    public function update_expired($package_sub_id) {

        $my_subscribe = PackageSubscribe::find($package_sub_id);
  
        if($my_subscribe->package_type == 'manual'){
            $my_subscribe->expired = 1;
            $my_subscribe->save();
             
        }else {
            $reqs = $my_subscribe->stores_no;
            $my_orders = ElectronicRequest::where('package_sub_id',$package_sub_id)->count();

            if($my_orders == $reqs){
                $my_subscribe->expired = 1;
                $my_subscribe->save();   
            }
        }
    }

    public function update_remaining_special($limit)
    {
        $remaining =  $limit - logged_user()->special_stores_no -  setting('manual_search_result');
        
        $remaining < 0 ? $remaining = 0 : $remaining = $remaining;
 
        if(user_type() == 'seller')
            Seller::where('id',logged_user()->id)->update(['special_stores_no' => $remaining]);

        elseif(user_type() == 'broker')
            Broker::where('id',logged_user()->id)->update(['special_stores_no' => $remaining]);

        elseif(user_type() == 'company')
            Company::where('id',logged_user()->id)->update(['special_stores_no' => $remaining]);

        else
            User::where('id',logged_user()->id)->update(['special_stores_no' => $remaining]);

    }

}