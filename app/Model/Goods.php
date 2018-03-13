<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    public $table = 'goods';
//    表的主键
    public $primaryKey = 'id';

//    是否自动维护created_at和updated_at字段
    public $timestamps = true;

    public $guarded = [];

    public function Comment()
    {
    	return $this->hasMany('App\Model\Comment','uid');
    }
}
