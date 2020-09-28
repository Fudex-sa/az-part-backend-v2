<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Supervisor extends Authenticatable
{
    use HasFactory , Notifiable;

    protected $fillable = [
        'name' , 'email' , 'mobile' , 'saudi' , 'active' , 'verification_code' , 'verified' , 
        'vip' , 'lang' , 'last_login' , 'photo' , 'rating' , 'user_type' , 'api_token' , 'password'   
        , 'created_by' , 'city_id'        
    ];

    public function supervisor_roles(){
        return $this->hasMany(UserRole::class,'user_id')->where('type','supervisor');
    }

    public function cities()
    {
        return $this->hasMany(SupervisorCity::class,'user_id');
    }


    public function my_sellers()
    {
        return $this->hasMany(Seller::class,'created_by');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
 
}
