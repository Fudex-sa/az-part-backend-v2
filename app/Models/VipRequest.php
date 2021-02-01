<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VipRequest extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id' , 'status' , 'approved_by' , 'user_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function broker()
    {
        return $this->belongsTo(Broker::class);
    }
}
