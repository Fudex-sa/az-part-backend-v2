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
        'type' , 'user_id' , 'seller_id' , 'brand_id' , 'model_id' , 'year' , 'country_id' ,

        'region_id' , 'city_id' , 'piece_alt_id' , 'price' , 'guarantee' , 'notes' , 'status' ,

        'total' , 'bought'
    ];

    public function scopeMyCart($q)
    {
        return $q->where('bought',0)->where('user_id',logged_user()->id)->orderby('id','desc');
    }

    public function piece_alt()
    {
        return $this->belongsTo(PieceAlt::class,'piece_alt_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class,'seller_id');
    }
}
