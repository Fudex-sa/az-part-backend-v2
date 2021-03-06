<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    protected $fillable =[
        'name' , 'value' , 'active'
    ];
 
    public function scopeActiveLinks($query)
    {
        return $query->whereActive(1);
    }
}
