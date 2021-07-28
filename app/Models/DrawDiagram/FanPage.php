<?php
namespace App\Models\DrawDiagram;

use App\Components\ModelMongo;

/***
 * Class FanPage
 * @package App\Models\DrawDiagram\FanPage
 * @property string $_id
 * @property int $page_id
 * @property int $account_id
 * @property string $avatar
 * @property string $access_token
 * @property string $category
 * @property array $category_list
 * @property array $tasks
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 * @property int $total_video_upload_by_day
 * @property int $remaining_amount
 */
class FanPage extends ModelMongo
{
    const status_active = 10;
    const status_block = 5;

    protected $collection = 'facebook_page';

    public static function search(string $search){
        return empty($search) ? self::query() : self::query()->where('name', 'like', '%' . $search . '%');
    }


}
