<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar' , 'name_en' , 'name_hi'  
    ];

    public function alts()
    {
        return $this->hasMany(PieceAlt::class);
    }
}
