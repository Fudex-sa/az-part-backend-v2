<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id' , 'region_id' , 'city_id' , 'street' , 'address' , 
        'lat' , 'lng' , 'rep_id' , 'notes' , 'delivery_time' , 'with_oil' ,
        'size' 
    ];


    public function scopeRepOrders()
    {
        return $this->whereRep_id(logged_user()->id);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function rep()
    {
        return $this->belongsTo(Rep::class);
    }

}
