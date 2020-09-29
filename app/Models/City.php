<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'region_id' , 'name_ar' , 'name_en' , 'name_hi' , 'active'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function scopeRegions($query,$region_id)
    {
        return $query->where('region_id',$region_id);
    }
}

