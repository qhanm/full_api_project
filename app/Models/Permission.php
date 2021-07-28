<?php
namespace App\Models;

use App\Components\BaseModel;

class Permission extends BaseModel
{
    protected $table = 'permission';

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_id', 'role_id');
    }

    public static function allKey() {
        return [
            PERMISSION_FB_LOGIN_ACCOUNT,
            PERMISSION_FB_CREATE_PAGE,
            PERMISSION_FB_DELETE_PAGE,
            PERMISSION_FB_LIST_FAN_PAGE,
            PERMISSION_FB_CHANGE_STATUS_FAN_PAGE,
            PERMISSION_FB_UPDATE_FAN_PAGE,
            PERMISSION_FB_CREATE_VIDEO,
            PERMISSION_FB_LIST_VIDEO,
            PERMISSION_FB_DELETE_VIDEO,
            PERMISSION_FB_UPDATE_VIDEO,
            PERMISSION_FB_LIST_LOG_SYNC,
            PERMISSION_FB_LIST_LOG_ERROR,
        ];
    }
}
