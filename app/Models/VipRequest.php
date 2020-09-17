<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VipRequest extends Model
{
    use HasFactory;

    protected $fillable = [
       'user_id' , 'status' , 'approved_by'
    ];

}
