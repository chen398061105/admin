<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //角色管理表
    protected $table = 'file_type';

    protected $primaryKey = 'id';

    protected $guarded = [];

}
