<?php

namespace App\Models;
use Auth;
use Illuminate\Database\Eloquent\Model;
class Permission extends Model
{

    //权限管理表
    protected $table = 'permission';

    protected $primaryKey = 'id';

    protected $guarded = [];
}

