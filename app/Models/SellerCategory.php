<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerCategory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' , 'user_type' , 'category_id'];

    public function user()
    {
        return $this->belongsTo(Seller::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
