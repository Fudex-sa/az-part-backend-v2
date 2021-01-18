<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageSubscribe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'package_id' ,'package_type' , 'price' , 'stores_no' , 'user_type' , 'expired' ,
        'coupon_id','remaining'
    ];

    public function scopeMyPackages()
    {
        return $this->where('user_id',logged_user()->id)->where('user_type',user_type())
                    ->where('expired',0);
    }

    public function scopeMyPackagesByType($q,$package_type='manual')
    {
        return $q->where('user_id',logged_user()->id)->where('user_type',user_type())
                    ->where('expired',0)->where('package_type',$package_type);
    }

    public function scopeMyAllPackages()
    {
        return $this->where('user_id',logged_user()->id)->where('user_type',user_type());
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function my_orders()
    {
        return $this->hasMany(ElectronicRequest::class,'package_sub_id');
    }
}
