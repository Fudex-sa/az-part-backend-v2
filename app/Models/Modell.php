<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modell extends Model
{
    use HasFactory;

    protected $fillable = [
       'brand_id' , 'name_ar' , 'name_en' , 'name_hi' , 'active' 
    ];


    public function scopeModels_brand($q,$brand_id)
    {
        return $q->where('brand_id',$brand_id);
    }
}
