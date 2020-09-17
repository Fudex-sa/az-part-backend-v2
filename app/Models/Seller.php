<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' , 'email' , 'mobile' , 'saudi' , 'active' , 'verification_code' , 'verified' , 
        'vip' , 'lang' , 'last_login' , 'image' , 'rating' , 'user_type' , 'api_token' , 'password'  ,
        'total_requests'      
    ];
    
}
