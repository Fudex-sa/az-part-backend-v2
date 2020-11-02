<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'car_id' , 'user_type' , 'comment' , 'approved'
    ];

    public function user()
    {         
        return $this->belongsTo(User::class,'user_id');
    }

    public function company()
    {         
        return $this->belongsTo(Company::class,'user_id');
    }

    public function car()
    {        
        return $this->belongsTo(Car::class,'car_id');
    }
}
