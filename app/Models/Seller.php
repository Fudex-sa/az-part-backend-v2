<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' , 'email' , 'mobile' , 'saudi' , 'active' , 'verification_code' , 'verified' , 
        'vip' , 'lang' , 'last_login' , 'photo' , 'rating' , 'user_type' , 'api_token' , 'password'  ,
        'total_requests' , 'created_by' , 'city_id'   
    ];

    public function scopeSaudi($query)
    {
        return $query->whereSaudi(1);
    }
    
}
