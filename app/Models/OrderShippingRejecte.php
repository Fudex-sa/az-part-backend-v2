<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShippingRejecte extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_shipping_id' , 'reject_reason'
    ];

    public function order_shipping()
    {
        return $this->belongsTo(OrderShipping::class,'order_shipping_id');
    }
}
