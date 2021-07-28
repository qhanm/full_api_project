<?php
namespace App\Components;
use Jenssegers\Mongodb\Eloquent\Model;

class ModelMongo extends Model
{
    protected $connection = 'mongodb';
}