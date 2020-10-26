<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id' , 'model_id' , 'year' ,'piece_id' , 'price' , 'seller_id'
    ];

    public function piece()
    {
        return $this->belongsTo(Piece::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function model()
    {
        return $this->belongsTo(Modell::class,'model_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class,'seller_id');
    }
}
