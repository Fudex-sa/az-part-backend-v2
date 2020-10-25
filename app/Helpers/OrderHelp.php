<?php
namespace App\Helpers;

use Session;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Models\PackageSubscribe;
use App\Helpers\PackageHelp;
use App\Helpers\App\Helpers;

class OrderHelp
{

    protected $package;
    protected $search;

    public function __construct()
    {    
        $this->package = new PackageHelp();

        $this->search = new Search();

    }

    public function create_order()
    {

        $my_subscribe = PackageSubscribe::myPackages()->first();
        $my_subscribe ? $package_sub_id = $my_subscribe->id : $package_sub_id = 0 ;

        $item = Order::create([
            'user_id' => logged_user()->id , 'sub_total' => sub_total() ,
            'delivery_price' => session()->get('delivery_price'),
            'taxs' => taxs() , 'total' => total() , 'coupon_value' => coupon_discount(),
            'coupon_id' => coupon_id() , 'package_sub_id' => $package_sub_id
        ]);

        if($item){
            $search = session()->get('search');

            update_cart($item->id);

            $this->create_shipping($item->id);

            if($package_sub_id != 0)
                $this->package->update_expired($package_sub_id);

            Session::forget('search');
            Session::forget('has_request');
            Session::forget('coupon');
            Session::forget('delivery_price');
            
        }
        return $item->id;
    }

    public function create_shipping($order_id)
    {
        $shipping = Session::get('shipping');

        $data = [
            'country_id' => $shipping['country_id'] , 'region_id' => $shipping['region_id'] , 
            'city_id' => $shipping['city_id'] , 'street' => $shipping['street'] , 
            'address' => $shipping['address'] , 'lat' => $shipping['lat'] , 
            'lng' => $shipping['lng'] , 'notes' => $shipping['notes'] , 
            'rep_id' => $shipping['rep_id'] , 'order_id' => $order_id , 'size' => $shipping['size'],
            'with_oil' => $shipping['with_oil']
        ];

        if($shipping){
            $item = OrderShipping::create($data);
        }

        Session::forget('shipping');
    }

  


}