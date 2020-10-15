<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageSubscribe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'package_id' , 'price' , 'stores_no' , 'user_type' , 'expired' , 'order_id'
    ];

    public function scopeMyPackages()
    {
        return $this->where('user_id',logged_user()->id)->where('user_type',user_type())
                    ->where('expired',0);
    }

    public function scopeMyAllPackages()
    {
        return $this->where('user_id',logged_user()->id)->where('user_type',user_type());
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
