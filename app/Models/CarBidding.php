<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CarBidding extends Model
{
    protected $table = "car_bidding";

    protected $fillable = ['id', 'user_id', 'car_id', 'comment', 'price', 'status'];


    public function car()
    {
        return $this->belongsTo(Car::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setPriceAttribute($value)
    {
        $arabic_numbers = ['.','١','٢','٣','٤','٥','٦','٧','٨','٩'];
        $english_numbers = ['0','1','2','3','4','5','6','7','8','9'];
        $this->attributes['price']  = str_replace($arabic_numbers, $english_numbers, $value);
    }

    public function getPriceAttribute($value)
    {
        $arabic_numbers = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
        $english_numbers = ['0','1','2','3','4','5','6','7','8','9'];
        return str_replace($arabic_numbers, $english_numbers, $value);
    }
}
