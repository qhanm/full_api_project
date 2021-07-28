<?php
namespace App\Models;

use App\Components\BaseModel;

class Role extends BaseModel
{
    protected $table = 'role';

    public function users() {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }
}
