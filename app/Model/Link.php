<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    //关联的表名
    public $table = 'link';
	//表的主键
    // public $primaryKey = 'user_id';

    //是否自动维护created_at和updated_at字段
    public $timestamps = true;
    public $guarded = [];
}
