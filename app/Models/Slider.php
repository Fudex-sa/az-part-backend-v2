<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'img' , 'title_ar' , 'title_en' , 'title_hi' , 'content_ar' , 'content_en' , 'content_hi' ,

        'active' , 'sort'

    ];
}
