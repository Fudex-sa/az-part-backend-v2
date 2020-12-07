<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id' , 'sellers_count'
    ];

    public function request()
    {
        return $this->belongsTo(AssignSeller::class);
    }
}
