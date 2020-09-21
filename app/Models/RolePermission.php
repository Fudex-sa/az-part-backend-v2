<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id' , 'permission'
    ];

    public function scopeDuplicatedRole($query,$role_id,$permission)
    {
        return $query->where('role_id',$role_id)->where('permission',$permission);
    }

    public function scopeRole_permissions($query,$role_id)
    {
        return $query->where('role_id',$role_id)->pluck('permission');
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function scopePermissions($query,$role_id)
    {
        return $query->where('role_id',$role_id);
    }
}
