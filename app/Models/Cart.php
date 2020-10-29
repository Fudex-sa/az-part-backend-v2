<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PieceAlt;
use App\Models\Seller;


class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'type' , 'user_id' , 'user_type', 'seller_id' , 'brand_id' , 'model_id' , 'year' , 'country_id' ,

        'region_id' , 'city_id' , 'piece_alt_id' , 'price' , 'guarantee' , 'notes' , 'bought' , 'order_id' ,
        
        'color' , 'notes' , 'photo'

    ];

    public function scopeMyCart($q)
    {
        return $q->where('bought',0)->where('user_id',logged_user()->id)
                    ->where('user_type',user_type())->orderby('id','desc');
    }

    public function piece_alt()
    {
        return $this->belongsTo(PieceAlt::class,'piece_alt_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class,'seller_id');
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
}
