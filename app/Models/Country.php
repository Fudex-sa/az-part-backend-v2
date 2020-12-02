<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar' , 'name_en' , 'name_hi' , 'active' , 'logo'
    ];
 
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}
