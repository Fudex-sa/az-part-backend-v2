<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code' , 'value' , 'uses_number' , 'expiration_date' , 'active'
    ];

    public function scopeCouponValue($q,$code)
    {
        return $q->where('code',$code);
    }
 
}
