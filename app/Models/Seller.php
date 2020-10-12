<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Seller extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name' , 'email' , 'mobile' , 'saudi' , 'active' , 'verification_code' , 'verified' , 
        'vip' , 'lang' , 'last_login' , 'photo' , 'rating' , 'user_type' , 'api_token' , 'password'  ,
        'total_requests' , 'created_by' , 'city_id' , 'address'        
    ];

    public function scopeSaudi($query)
    {
        return $query->whereSaudi(1);
    }
    
    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
 
}
