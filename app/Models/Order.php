<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'sub_total' , 'delivery_price' , 'taxs' , 'total' , 'status' , 'coupon_id' , 'coupon_value',
        'package_sub_id'
    ];

    public function scopeCouponByUser($q,$coupon_id)
    {
        return $q->where('user_id',logged_user()->id)->where('coupon_id',$coupon_id);
    }

    public function scopeMyOrders($q)
    {
        return $q->where('user_id',logged_user()->id)->where('user_type',user_type());
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class,'status');
    }

    public function user()
    {
        if($this->user_type == 'company')
            return $this->belongsTo(Company::class,'user_id');
        else
            return $this->belongsTo(User::class,'user_id');
    }
}
