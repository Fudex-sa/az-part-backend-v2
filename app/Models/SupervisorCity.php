<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorCity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'region_id' , 'city_id'
    ];

    public function scopeUser_cities($query,$user_id)
    {
        return $query->whereUser_id($user_id);
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class,'user_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
