<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarFavorite extends Model
{
    protected $fillable = ['user_id','car_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}