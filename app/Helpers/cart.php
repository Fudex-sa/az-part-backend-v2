<?php

use App\Models\Cart;
use App\Models\Package;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\user;
use App\Models\Company;
use App\Models\Seller;
use App\Models\Broker;
use App\Models\RepPrice;
use App\Models\PackageSubscribe; 

if (! function_exists('cart')) {
    function cart() {

        $items = Cart::myCart()->with('piece_alt')->with('seller')->get();
        
        return $items;
    }
}

if (! function_exists('order_type')) {
    function order_type() {

        $item = Cart::myCart()->first();
        
        return $item->type;
    }
}

if (! function_exists('sub_total')) {
    function sub_total() {
        $sub_total = 0;
        // $result = Cart::myCart()->with('piece_alt')->with('seller')->sum('price');

        $carts = Cart::myCart()->with('piece_alt')->with('seller')->get();
        if($carts){
            foreach($carts as $cart){
                $sub_total += $cart->price * $cart->qty;
            }
        }
        
        return $sub_total;
    }
}

if (! function_exists('taxs')) {
    function taxs() {
                
        $commission = setting('site_commission') / 100 * sub_total();

        $result = setting('pieces_tax') + $commission;
        
        return $result;
    }
}


if (! function_exists('payment_type')) {
    function payment_type() {

        $payment_type = session()->get('payment_type') ? session()->get('payment_type') : 'cart';
 
        return $payment_type;
    }
}


if (! function_exists('total')) {
    function total() {
                
        if(payment_type() == 'package')
            $result = Package::packagePrice(session()->get('package_id'));

        else{

            $result = sub_total() + taxs() + delivery_price();
 
            if(session()->get('with_oil'))
                $result = $result + session()->get('with_oil');            
            
        }
              
        $total = (int)$result - coupon_discount();
        return $total;
    }
}


if (! function_exists('update_cart')) {
    function update_cart($order_id) {
                
        Cart::myCart()->update(['order_id' => $order_id , 'bought' => 1]);
        
    }
}

if (! function_exists('my_orders')) {
    function my_orders($user_id,$user_type) {
          
        $items = Order::where('user_type',$user_type)->where('user_id',$user_id)->get();
        
        return $items; 
    }
}

// if (! function_exists('update_available_orders')) {
//     function update_available_orders($user_id) {
                
//         if(user_type() == 'company')
//             $user = Company::find($user_id);
        
//         else if(user_type() == 'seller')
//             $user = Seller::find($user_id);
        
//         else if(user_type() == 'broker')
//             $user = Broker::find($user_id);
        
//         else
//             $user = User::find($user_id);

//         $user->available_orders = $user->available_orders - 1;
//         $user->save();
         
//     }
// }

if (! function_exists('valid_coupon')) {
    function valid_coupon($code)
    {         
        $coupon = Coupon::where('code',$code)->first();

        if($coupon){
            $used_times = Order::couponByUser($coupon->id)->get()->count();
            
            if($used_times < $coupon->uses_number)                
                return 1;
                 
            else return 0;
        }
        
        else return 0;
    }
}
 
if (! function_exists('coupon_discount')) {
    function coupon_discount()
    {   
        if(session()->get('coupon')) 
            $discount = Coupon::couponValue(session()->get('coupon'))->first()->value;

        else $discount = 0;

        return $discount;
    }
}

if (! function_exists('coupon_id')) {
    function coupon_id()
    {   
        if(session()->get('coupon')) 
            $id = Coupon::where('code',session()->get('coupon'))->first()->id;

        else $id = 0;

        return $id;
    }
}

if (! function_exists('delivery_price')) {
    function delivery_price()
    {   
        $rep_price = RepPrice::find(session()->get('rep_price'));
        return $rep_price ? $rep_price->price : 0;
    }
}

if (! function_exists('delivery')) {
    function delivery()
    {   
        $rep_price = RepPrice::find(session()->get('rep_price'));
        return $rep_price;
    }
}

if (! function_exists('clear_session')) {
    function clear_session()
    {   
        session()->forget('search');
        session()->forget('has_request');
        session()->forget('coupon');
        session()->forget('delivery_price');
        session()->forget('with_oil');
        session()->forget('rep_price');
    }
}

if (! function_exists('valid_for_elec')) {
    function valid_for_elec()
    {   
        $sys_elec_search =  setting('electronic_search_result');
        $available_orders = logged_user()->available_orders;

        $avialable_package_orders = PackageSubscribe::myPackagesByType('electronic')->get()->sum('stores_no');

        $my_elec_orders = Order::where('type','electronic')->where('package_sub_id',0)
                    ->where('user_id',logged_user()->id)->count();
        
        if($my_elec_orders < $sys_elec_search || $my_elec_orders < $available_orders) return 1;
        else {
            if($avialable_package_orders > 0) return 1;
            else return 0;
        }
    }
}

if (! function_exists('coupon_used_times')) {
    function coupon_used_times($coupon_id)
    {   
        $count = Order::where('coupon_id',$coupon_id)->count();
        return $count;
    }
}





        
 
 