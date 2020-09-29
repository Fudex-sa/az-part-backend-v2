<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id' , 'name_ar' , 'name_en' , 'name_hi' , 'active'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    
}
