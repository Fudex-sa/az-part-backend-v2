<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Rep extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
            'name' , 'mobile' , 'email' , 'saudi' , 'active' , 'verification_code' , 'verified' ,
            'lang' , 'last_login' , 'photo' , 'national_id' , 'rating' , 'api_token' , 'password'
            , 'created_by' ,'region_id', 'city_id', 'address' , 'type' , 'status' , 'id_copy' , 'bank_id' ,
            'car_license_img' , 'car_data' , 'car_img' ,'phone' , 'lat' , 'lng'         
    ];
 

    public function rep_roles(){
        return $this->hasMany(UserRole::class,'user_id')->where('type','rep');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class,'region_id');
    }
  
 

}
