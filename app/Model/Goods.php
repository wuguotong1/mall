<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    public $table = 'goods';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;

    public function detail()
    {
        return $this->hasOne('App\Model\Detail','gid');
    }

    public function cate()
    {
        return $this->hasMany('App\Model\Cate','id','cid');
    }
}
