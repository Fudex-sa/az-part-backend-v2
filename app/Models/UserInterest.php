<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserInterest extends Model
{
    protected $table ='user_interests';

    protected $fillable = [
        'user_id' , 'brand_id' , 'city_id','car_model_id','year','price_type','price_from','price_to','created_at','updated_at'
    ];


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function model()
    {
        return $this->belongsTo(Modell::class, 'car_model_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
