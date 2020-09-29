<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar' , 'name_en' , 'name_hi' , 'active' , 'logo'
    ];

    public function models()
    {
        return $this->hasMany(Modell::class,'brand_id');
    }
    
}
