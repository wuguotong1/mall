<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Userf extends Model
{
    protected $table = 'users';

    public function users()
    {
        return $this->hasOne('App\Model\Users','uid');
    }
}
