<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class User extends Model
{

    //管理员表
    protected $table = 'user';

    protected $primaryKey = 'id';

    protected $guarded = [];


    public function role()
    {

        return $this->belongsToMany('App\Models\Role', 'user_role', 'user_id', 'role_id');
    }
}
