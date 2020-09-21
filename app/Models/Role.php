<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar' , 'name_en' , 'name_hi' , 'active'
    ];

    public function role_permissions(){
        return $this->hasMany(RolePermission::class,'role_id');
    }

}
