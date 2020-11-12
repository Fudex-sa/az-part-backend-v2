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

    public function __construct()
    {    
        $this->package = new PackageHelp();

    }

    public function create_order()
    {
        $shipping = $this->create_shipping();

        search_session()['search_type'] ?             
            $order_type = search_session()['search_type'] : $order_type = order_type();


        $my_subscribe = PackageSubscribe::myPackagesByType($order_type)->first();
        $my_subscribe ? $package_sub_id = $my_subscribe->id : $package_sub_id = 0 ;

         
        $item = Order::create([
            'user_id' => logged_user()->id , 'user_type' => user_type() ,
            'sub_total' => sub_total() ,
            'delivery_price' => delivery_price(),
            'taxs' => taxs() , 'total' => total() , 'coupon_value' => coupon_discount(),
            'coupon_id' => coupon_id() , 'package_sub_id' => $package_sub_id ,
            'shipping_id' => $shipping->id , 'type' => $order_type
        ]);

        if($item){          
            update_cart($item->id);
          
            if($package_sub_id != 0)
                $this->package->update_expired($package_sub_id);

            clear_session();            
        }else{
            $shipping->delete();
        }
        
        return $item->id;
    }

    public function create_shipping()
    {
        $shipping = Session::get('shipping');

        $data = [
            'country_id' => $shipping['country_id'] , 'region_id' => $shipping['region_id'] , 
            'city_id' => $shipping['city_id'] , 'street' => $shipping['street'] , 'notes' => $shipping['notes'] , 
            'rep_id' => delivery()->rep_id , 'size' => $shipping['size'],
            'with_oil' => $shipping['with_oil']
        ];

        if($shipping){            
            $item = OrderShipping::create($data);

            return $item;
        }

       
        
    }

  


}