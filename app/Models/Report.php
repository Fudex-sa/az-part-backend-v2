<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'seller_id' , 'piece_id' , 'user_type' , 'complain_id' , 'comment'
    ];

    public function user()
    {
        if($this->user_type == 'company')
            return $this->belongsTo(Company::class,'user_id');
        else
            return $this->belongsTo(User::class,'user_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class,'seller_id');
    }

    public function piece()
    {
        return $this->belongsTo(Piece::class,'piece_id');
    }

    public function complain()
    {
        return $this->belongsTo(Complain::class,'complain_id');
    }
}
