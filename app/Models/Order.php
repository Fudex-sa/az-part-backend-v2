<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id' , 'user_type' , 'sub_total' , 'delivery_price' , 'taxs' , 'total' , 'status' , 'coupon_id' , 'coupon_value',
        'package_sub_id' , 'shipping_id' , 'type'
    ];

    public function scopeCouponByUser($q,$coupon_id)
    {
        return $q->where('user_id',logged_user()->id)->where('coupon_id',$coupon_id);
    }

    public function scopeCouponUsedCount($q,$coupon_id)
    {
        return $q->where('coupon_id',$coupon_id);
    }

    public function scopeMyOrders($q)
    {
        return $q->where('user_id',logged_user()->id)->where('user_type',user_type());
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class,'status');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class,'coupon_id');
    }

    public function user()
    {
        if($this->user_type == 'company')
            return $this->belongsTo(Company::class,'user_id');
        else
            return $this->belongsTo(User::class,'user_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class,'order_id');
    }

    public function package_subscribe()
    {
        return $this->belongsTo(PackageSubscribe::class,'package_sub_id');
    }

    public function shipping()
    {
        return $this->belongsTo(OrderShipping::class,'shipping_id');
    }
 
}
