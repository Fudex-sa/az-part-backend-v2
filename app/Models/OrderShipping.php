<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id' , 'country_id' , 'region_id' , 'city_id' , 'street' , 'address' , 
        'lat' , 'lng' , 'rep_id' , 'notes'
    ];
}
