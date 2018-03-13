<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
<<<<<<< HEAD
    public $table = 'user';
=======
    public $table = 'users';
>>>>>>> 1ed457b73b5b6074410e8785e05b2f7243908361
//    表的主键
    public $primaryKey = 'id';

//    是否自动维护created_at和updated_at字段
    public $timestamps = true;

    public $guarded = [];
<<<<<<< HEAD
=======

    public function comment()
    {
    	return $this->hasMany('App\Model\comment','uid');
    }
    public function user()
    {
    	return $this->hasMany('App\Model\feedback','uid');
    }
>>>>>>> 1ed457b73b5b6074410e8785e05b2f7243908361
}
