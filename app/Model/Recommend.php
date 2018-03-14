<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Recommend extends Model
{
    //关联的表名
    public $table = 'goods_recommend';
	//表的主键
    // public $primaryKey = 'user_id';

    //是否自动维护created_at和updated_at字段
    public $timestamps = true;
    public $guarded = [];

    //定义推荐表和分类表的属于关系
    public function cate()
    {
    	return $this->belongsTo('App\Model\Cate','tid');
    }
    public function goods()
    {
        return $this->belongsTo('App\Model\Goods','gid');
    }
}