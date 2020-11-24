<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableModel extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'years' => 'array'
    // ];

    protected $fillable = [
        'user_id' , 'brand_id' , 'model_id' , 'year' , 'city_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function model()
    {
        return $this->belongsTo(Modell::class);
    }

    public function user()
    {
        return $this->belongsTo(Seller::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'user_id');
    }

    public function broker()
    {
        return $this->belongsTo(Broker::class, 'user_id');
    }

    public function scopeUserBrands($q, $user_id)
    {
        return $q->where('user_id', $user_id);
    }

    public function scopeMatchOrder($query, $brand_id, $model_id, $year)
    {
        return $query->where('brand_id', $brand_id)->where('model_id', $model_id)
                    ->where('year', $year);
    }
}
