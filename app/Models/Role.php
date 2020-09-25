<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //角色管理表
    protected $table = 'role';

    protected $primaryKey = 'id';

    protected $guarded = [];
    //添加动态属性，管理权限
    public  function permission(){
        //被关联的模型  关联表  当前模型外键 被关联模型外键
        return $this->belongsToMany('App\Models\Permission','role_permission','role_id','permission_id');
    }
}
