<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'rep_id' , 'city_id' , 'price' , 'active'
    ];

    public function rep()
    {
        return $this->belongsTo(Rep::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function scopeMyCities($q,$rep_id)
    {
        return $q->where('rep_id',$rep_id);
    }
}