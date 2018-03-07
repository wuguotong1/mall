<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Auser extends Model
{
    public $table = 'admin_user';
//    表的主键
    public $primaryKey = 'id';

//    是否自动维护created_at和updated_at字段
    public $timestamps = true;


}
