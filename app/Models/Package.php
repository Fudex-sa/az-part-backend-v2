<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'type' , 'title_ar' , 'title_en' , 'title_hi' , 'stores_no' , 'price' , 'stores_no',
        'discount'
    ];

    public function scopeType($q,$type)
    {
        return $q->whereType($type);
    }

    public function scopePackagePrice($q,$id)
    {
        return $q->where('id',$id)->first()->price;
    }

}
