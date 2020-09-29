<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PieceAlt extends Model
{
    use HasFactory;

    protected $fillable = [
        'piece_id' , 'name_ar' , 'name_en' , 'name_hi'  
    ];

    public function piece()
    {
        return $this->belongsTo(Piece::class);
    }
}
