<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = 'comment';
//    表的主键
    public $primaryKey = 'id';

//    是否自动维护created_at和updated_at字段
    public $timestamps = true;

    public $guarded = [];

    public function reply()
    {
    	return $this->hasOne('App\Model\Reply','comment_id');
    }
    public function user()
    {
    	return $this->belongsTo('App\Model\User','uid');
    }
    public function goods()
    {
        return $this->belongsTo('App\Model\Goods','gid');
    }

}
