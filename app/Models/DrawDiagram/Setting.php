<?php
namespace App\Models\DrawDiagram;

use App\Components\ModelMongo;

/***
 * @property string $_id
 * @property string $fb_app_id
 * @property string $fb_secret_id
 * @property string $graph_api_version
 * @property int $upload_max_file_size
 * @property int $total_upload_video_by_day
 */
class Setting extends ModelMongo
{
    protected $collection = 'setting_draw_diagram';
}
