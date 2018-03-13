<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public $table = 'reply';
//    表的主键
    public $primaryKey = 'id';

//    是否自动维护created_at和updated_at字段
    public $timestamps = true;

    public $guarded = [];

    public function comment()
    {
    	return $this->belongsTo('App\Model\comment','comment_id');
    }
}
