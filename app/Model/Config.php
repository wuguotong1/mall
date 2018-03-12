<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    public $table = 'config';
    public $primaryKey = 'conf_id';
    public $guarded = [];
//    public $fillable = ['cate_name','cate_title','cate_keywords'];

    public $timestamps = false;
}
