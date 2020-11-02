<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Company extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name' , 'email' , 'mobile' , 'saudi' , 'active' , 'verification_code' , 'verified' , 
        'vip' , 'lang' , 'last_login' , 'photo' , 'rating' , 'user_type' , 'api_token' , 'password',
        'available_orders' , 'created_by' , 'region_id' , 'city_id' , 'address'  , 'lat' , 'lng'        
    ];


    public function scopeSaudi($query)
    {
        return $query->whereSaudi(1);
    }
    
    public function region()
    {
        return $this->belongsTo(Region::class,'region_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
}
