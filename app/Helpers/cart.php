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
use App\Models\AvailableModel;
use App\Models\DeliveryRegion;
use App\Models\ElectronicRequest;
use Carbon\Carbon;

if (! function_exists('cart')) {
    function cart() {

        $items = Cart::myCart()->with('piece_alt')->with('seller')->get();
        
        return $items;
    }
}

if (! function_exists('tashlih_regions')) {
    function tashlih_regions() {
         
        $items = Cart::myCart()->with('seller')                    
                    ->groupBy('seller_id')
                    ->get()                    
                    ->pluck('seller.tashlih_region')
                    ->unique()
                    ->toArray();
         
        return $items;
    }
}

if (! function_exists('from_region')) {
    function from_region($region) {

        $item = DeliveryRegion::find($region);
        
        return $item['name_'.my_lang()];
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
                
        $tax = setting('pieces_tax') / 100 * total_without_tax();
 
        return $tax;
    }
}

if (! function_exists('commission')) {
    function commission() {
                
        $commission = setting('site_commission') / 100 * sub_total();
 
        return $commission < 20 ? 20 : $commission;
    }
}
 
if (! function_exists('total_without_tax')) {
    function total_without_tax() {
    
        if(session()->get('payment_type') == 'package')
            $result = Package::packagePrice(session()->get('package_id'));

        else{

            session()->get('with_oil') ? $with_oil = session()->get('with_oil') : $with_oil = 0;

            $result = sub_total() + commission();
            $result = $result - discount();
 
        }
       
        $total = number_format((float)$result, 2, '.', '');
         
        return $total;
    }
}

if (! function_exists('total')) {
    function total() {
    
        if(session()->get('payment_type') == 'package'){
            $result = Package::packagePrice(session()->get('package_id'));

            coupon_discount() != 0 ?  $discount_val = coupon_discount() : $discount_val = 0;

            $discount = $discount_val / 100 * $result; 
            $result =  $result - $discount;    

        }else{

            session()->get('with_oil') ? $with_oil = session()->get('with_oil') : $with_oil = 0;

            $result = sub_total() + commission();
            $result = $result - discount();

             
            $result = $result + taxs();
            $result = $result + delivery_price() + $with_oil;
        }
       
        $total = number_format((float)$result, 2, '.', '');
         
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
 
if (! function_exists('valid_coupon')) {
    function valid_coupon($code)
    {         
        $coupon = Coupon::where('code',$code)->where('active',1)
                        ->whereDate('expiration_date','>',Carbon::now())
                        ->orwhereDate('expiration_date',null)
                        ->first();

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


if (! function_exists('discount')) {
    function discount() {
        
        if(session()->get('payment_type') == 'package')
            $result = coupon_discount() / 100 * total();

        else{
            if(coupon_discount() != 0)            
                // $result = coupon_discount() / 100 * sub_total();
                $result = coupon_discount() / 100 * commission();
    
            else $result = 0;
        }
        return $result;
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
        // $rep_price = RepPrice::find(session()->get('rep_price'));
        // return $rep_price ? $rep_price->price : 0;

        return session()->get('rep_price');
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
        // $sys_elec_search =  setting('electronic_search_result');
        // $available_orders = logged_user()->available_orders;

        $special_requests = setting('electronic_search_result') + logged_user()->available_orders;

        $avialable_package_orders = PackageSubscribe::myPackagesByType('electronic')->get()->sum('stores_no');

        $my_elec_orders = ElectronicRequest::myRequests()->where('package_sub_id',0)->count();
        
        if($my_elec_orders < $special_requests) return 1;
        else {
            if($avialable_package_orders > 0) return 1;
            else return 0;
        }
    }
}

if (! function_exists('total_valid_elec')) {
    function total_valid_elec()
    {   
        $total = 0;
        
        $total += PackageSubscribe::myPackagesByType('electronic')->get()->sum('stores_no');

        $sys_elec_search =  setting('electronic_search_result');
        $available_orders = logged_user()->available_orders;

        $my_elec_orders = ElectronicRequest::myRequests()->where('package_sub_id',0)->count();

        $total += $sys_elec_search + $available_orders - $my_elec_orders;
         
        return $total;
    }
}

if (! function_exists('coupon_used_times')) {
    function coupon_used_times($coupon_id)
    {   
        $count = Order::where('coupon_id',$coupon_id)->count();
        return $count;
    }
}

if (! function_exists('cities_sellers')) {
    function cities_sellers()
    {  
        $search = search_session();

        $brand = $search['brand'];
        $model = $search['model'];
        $year = $search['year'];
        $country = $search['country'];
 
        $items = AvailableModel::select('city_id', DB::raw('count(*) as stores'))
                    ->matchOrder($brand,$model,$year)     
                    ->whereHas('seller',function($q) use ($country){
                        $q->where('country_id',$country)->where('active',1)
                            ->orderby('saudi','desc')->orderby('vip','desc');
                    })                        
                    ->groupBy('city_id')
                    ->get();            
                          
        return $items;

    }
}

if (! function_exists('if_subscribe')) {
    function if_subscribe($package_type)
    {
        $items = PackageSubscribe::myPackagesByType()->get();
        
        if(count($items) > 0)
            return 1;
        else return 0;
    }
}

        
 
 