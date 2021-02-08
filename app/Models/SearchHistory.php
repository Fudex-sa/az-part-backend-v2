<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id' , 'model_id' , 'year' , 'country_id' , 'region_id' , 'city_id' , 'limit' ,
        'user_id' , 'user_type' , 'search_type' , 'expired'
    ];

    public function scopeMatch($q,$brand,$model,$year)
    {
        return $q->where('brand_id',$brand)
                ->where('model_id',$model)
                ->where('year',$year)
                ->where('expired',0)
                ->where('user_id',logged_user()->id)
                ->where('user_type',user_type());
    }
}
