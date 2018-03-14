<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    public $table = 'goods_detail';
    public $primaryKey = 'id';
    public $guarded = [];
    public $timestamps = false;

}
