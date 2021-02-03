<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'type' , 'user_id' , 'title' , 'brand_id' , 'model_id' , 'year' , 'color' , 'kilo_no' ,
        'country_id' , 'region_id' , 'city_id' , 'price_type' , 'price' , 'validatly' , 'examination' ,'kilo_no',
        'notes' , 'publish' , 'views' , 'user_type' , 'qty','auction','date_auction' , 'original' , 'original_year' , 'replica_year'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'user_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'user_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function model()
    {
        return $this->belongsTo(Modell::class);
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

    public function imgs()
    {
        return $this->hasMany(CarImage::class, 'car_id');
    }

    public function comments()
    {
        return $this->hasMany(CarComment::class, 'car_id');
    }
 
}
