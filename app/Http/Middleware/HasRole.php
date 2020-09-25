<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Route;

class HasRole
{
    /**
     * Handle an incoming request.
     *判断该角色是够拥权限
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //获取当前请求的路由，对应的控制器方法名
        $route =  $request->route()->getActionName();
        echo $route;
        //获取当前用户的权限组 用户->角色->权限关系
        $user = User::find(session()->get('user')->id);
        $roles = $user->role;
       //根据用户拥有的角色找权限
        $arr = [];
        foreach ($roles as $v){
            $perms =   $v->permission;
            foreach ($perms as $perm){
                $arr[] = $perm->controllers;
            }
        }
        //去掉重复权限
        array_unique($arr);
        //判断请求路由在对应的arr数组中
        if(!in_array($route,$arr)){
           return redirect('noAccess');
        }
        return $next($request);
    }
}
