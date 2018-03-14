<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Indent extends Model
{
    public $table = 'goods_indent';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = true;

    public function User()
    {
        return $this->hasOne('App\Model\User','id','uid')->get();
    }
    public function Goods()
    {
        return $this->hasOne('App\Model\Goods','id','gid')->get();
    }
}
