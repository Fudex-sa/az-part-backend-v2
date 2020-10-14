<?php
namespace App\Helpers;

use Session;
use App\Models\Order;
use App\Models\OrderShipping;

class OrderHelp
{

    public function create_order()
    {
        
        $item = Order::create([
            'user_id' => logged_user()->id , 'sub_total' => sub_total() , 
            'taxs' => taxs() , 'total' => total()
        ]);

        if($item){
            update_cart($item->id);

            $this->create_shipping($item->id);
        }
        return $item->id;
    }

    public function create_shipping($order_id)
    {
        $shipping = Session::get('shipping');

        if($shipping){
            $item = OrderShipping::create([
                'country_id' => $shipping['country_id'] , 'region_id' => $shipping['region_id'] , 
                'city_id' => $shipping['city_id'] , 'street' => $shipping['street'] , 
                'address' => $shipping['address'] , 'lat' => $shipping['lat'] , 
                'lng' => $shipping['lng'] , 'notes' => $shipping['notes'] , 
                'rep_id' => $shipping['rep_id'] , 'order_id' => $order_id
            ]);
        }

        Session::forget('shipping');
    }

    


}