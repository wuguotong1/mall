<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public $table = 'feedback';
//    表的主键
    public $primaryKey = 'id';

//    是否自动维护created_at和updated_at字段
    public $timestamps = true;

    public $guarded = [];

    public function user()
    {
    	return $this->belongsTo('App\Model\User','uid');
    }
}
