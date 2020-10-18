<?php
namespace App\Helpers;

use Session;
use App\Models\Order;
use App\Models\OrderShipping;
use App\Helpers\PackageHelp;

class OrderHelp
{

    protected $package;

    public function __construct()
    {    
        $this->package = new PackageHelp();
    }

    public function create_order()
    {
        
        $item = Order::create([
            'user_id' => logged_user()->id , 'sub_total' => sub_total() ,
            'delivery_price' => session()->get('delivery_price'),
            'taxs' => taxs() , 'total' => total() , 'coupon_value' => coupon_discount(),
            'coupon_id' => coupon_id()
        ]);

        if($item){
            update_cart($item->id);

            $this->create_shipping($item->id);

            $this->package->update_expired($item->id);

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
            'rep_id' => $shipping['rep_id'] , 'order_id' => $order_id
        ];

        if($shipping){
            $item = OrderShipping::create($data);
        }

        Session::forget('shipping');
    }

  


}