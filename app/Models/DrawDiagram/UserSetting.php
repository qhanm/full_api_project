<?php

namespace App\Models;

use App\Components\ModelMongo;

/***
 * Class UserSetting
 * @package App\Models
 * @property integer $id
 * @property integer $user_id
 * @property string $fb_access_token
 * @property string $fb_account_id
 * @property string $fb_avatar
 * @property string $fb_name
 * @property string $created_at
 * @property string $updated_at
 */
class UserSetting extends ModelMongo
{
    protected $table = 'user_setting';
}
