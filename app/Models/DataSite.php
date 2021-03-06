<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'keyword' , 'value_ar' , 'value_en' , 'value_hi'
    ];
}
