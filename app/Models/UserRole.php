<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' , 'role_id' , 'type'
    ];

    public function scopeDuplicatedRole($query,$role_id,$user_id)
    {
        return $query->where('role_id',$role_id)->where('user_id',$user_id);
    }

    public function scopeRoles($query,$user_id,$type)
    {
        return $query->where('user_id',$user_id)->where('type',$type);
    }

    public function scopeUser_roles($query,$user_id,$type)
    {
        return $query->where('user_id',$user_id)->where('type',$type)->pluck('role_id');
    }

    public function role(){
        return $this->belongsTo(Role::class,'role_id');
    }
}
