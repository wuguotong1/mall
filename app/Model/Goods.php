<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    public $table = 'goods';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;
    
    public function comment()
    {
    	return $this->hasMany('App\Model\Comment','gid');
    }

}
