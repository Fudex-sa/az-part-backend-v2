<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rep extends Model
{
    use HasFactory;

    protected $fillable = [
            'name' , 'mobile' , 'email' , 'saudi' , 'active' , 'verification_code' , 'verified' ,
            'lang' , 'last_login' , 'photo' , 'national_id' , 'rating' , 'api_token' , 'password'
    ];
}