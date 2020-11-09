<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'user_type' , 'brand_id' , 'model_id' , 'year' , 'country_id' ,

        'region_id' , 'city_id' , 'piece_alt_id' , 'notes' , 'color' , 'notes' , 'photo' , 'qty' ,
        'status_id'

    ];

    public function scopeMyRequests($q)
    {
        return $q->where('user_id',logged_user()->id)
                    ->where('user_type',user_type());
    }

    public function piece_alt()
    {
        return $this->belongsTo(PieceAlt::class,'piece_alt_id');
    }
 
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function model()
    {
        return $this->belongsTo(Modell::class,'model_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function assign_sellers()
    {
        return $this->hasMany(AssignSeller::class,'request_id');
    }

    public function assign_sellers_replied()
    {
        return $this->hasMany(AssignSeller::class,'request_id')->where('price','!=',null);
    }

    public function user()
    {
        if($this->user_type == 'company')
            return $this->belongsTo(Ccompany::class,'user_id');
        else
            return $this->belongsTo(User::class,'user_id');
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class,'status_id');
    }
}
