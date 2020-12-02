<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo' , 'name_ar' , 'name_en' , 'name_hi' , 'active' , 'sort' , 'description_ar' , 'description_en',
        'description_hi'
    ];
}
