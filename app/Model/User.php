<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table = 'users_detail';
//    表的主键
    public $primaryKey = 'id';
    //    是否自动维护created_at和updated_at字段
    public $timestamps = true;

    public $guarded = [];

    public function comment()
    {
    	return $this->hasMany('App\Model\comment','uid');
    }
    public function user()
    {
    	return $this->hasMany('App\Model\feedback','uid');
    }
    public function feedback()
    {
        return $this->hasMany('App\Model\feedback','uid');
    }
}
