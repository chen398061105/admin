<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Products;
use App\Models\Role;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    //通用删除
    public function delAll(Request $request,$flag)
    {
        switch ($flag){
            case 'order': //商品表批量删除
                for ($i=0; $i<count($request['keys']); $i++) {
                    $res = Products::where('id', $request['keys'][$i])->delete();  // 遍历删除
                }
                break;
            case 'users':   //用户名批量删除
                for ($i=0; $i<count($request['keys']); $i++) {
                    $res = User::where('id', $request['keys'][$i])->delete();  // 遍历删除
                }
                break;
            case 'roles':   //角色名批量删除
                for ($i=0; $i<count($request['keys']); $i++) {
                    $res = Role::where('id', $request['keys'][$i])->delete();  // 遍历删除
                }
                break;
            default:
                flash()->overlay('批量删除失败！');
                return false;
        }
        if ($res == 1) {
            $data = [
                'status' => 0,
                'msg' => '删除成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '删除失败'
            ];
        }
        return $data;
    }
}
