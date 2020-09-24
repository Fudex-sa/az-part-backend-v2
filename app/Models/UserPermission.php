<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'permission' , 'type'
    ];


    public function scopePermissions($query,$user_id,$type)
    {
        return $query->where('user_id',$user_id)->where('type',$type);
    }

    public function scopeUser_permissions($query,$user_id,$type)
    {
        return $query->where('user_id',$user_id)->where('type',$type)->pluck('permission');
    }

}
