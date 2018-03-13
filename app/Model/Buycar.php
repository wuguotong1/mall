<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Buycar extends Model
{
    //关联的表名
    public $table = 'buycar';
    //是否自动维护created_at和updated_at字段
    public $timestamps = true;
    public $guarded = [];

    //定义购物车表和用户表的属于关系
    public function userCar()
    {
    	return $this->belongsTo('App\Model\Userf','uid');
    }
    //定义购物车表和商品表的属于关系
    public function goodsCar()
    {
        return $this->belongsTo('App\Model\Goods','gid');
    }
}
