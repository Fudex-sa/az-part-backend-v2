<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'sub_total' , 'taxs' , 'total' , 'status' , 'coupon_id' , 'coupon_value'
    ];

    public function scopeCouponByUser($q,$coupon_id)
    {
        return $q->where('user_id',logged_user()->id)->where('coupon_id',$coupon_id);
    }
}
