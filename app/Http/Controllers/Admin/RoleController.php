<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //关键字过滤降序检索
        $roles = Role::orderBy('id', 'asc')
            ->where(function ($query) use ($request) {
                //根据角色名检索
                $role_name = $request->get('role_name');
                if (!empty($role_name)) {
                    $query->where('role_name', 'like', '%' . $role_name . '%');
                }
            })->paginate(10);
        session(['role_name' => $request->get('role_name')]);//

        $num = Role::count();//一共有多少数据
        return view('roles.roles-list', compact('roles', 'request', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('roles.roles-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取数据
        $input = $request->except('_token');
        //表单验证，暂时省略
        //添加到数据库
        $res = Role::create($input);
        if ($res) {
            $data = [
                'status' => 0,
                'msg' => '添加成功'
            ];
            return $data;
        } else {
            flash()->overlay('添加失败！');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        return view('roles.roles-edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->only('role_name');
//        使用模型修改表记录的两种方法,方法一
        $role = Role::find($id);
        $res = $role->update($input);

        if ($res) {
            $data = [
                'status' => 0,
                'msg' => '修改成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '修改失败'
            ];
        }
        return $data;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $input = Role::find($id)->delete();
        if ($input) {
            $data = [
                'status' => 0,
                'msg' => '删除成功！'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '删除失败！'
            ];
        }
        return $data;
    }

    //角色授权
    public function auth($id)
    {
        //当前角色
        $role = Role::find($id);
        //获取所有权限
        $perms = Permission::get();

        //获取当前用户拥有的权限
        $own_perms = $role->permission;

        $own_perm = [];//角色权限id
        foreach ($own_perms as $own) {
            $own_perm[] = $own->id;
        }

        return view('roles.auth-add', compact('role', 'perms', 'own_perm'));
    }

    //处理授权
    public function doAuth(Request $request)
    {
        $input = $request->except('_token');
        if (!isset($input['permission_id'])){
            $data = [
                'status' => 1,
                'msg' => '权限必须得选一个！'
            ];
            return $data;
        }

        //传过来的id字符串转成数组
        $perm_id = explode(',',$input['permission_id']);
        //如果权限存在则删除重新赋权
       DB::table('role_permission')->where('role_id', $input['role_id'])->delete();
        if (!empty($perm_id)) {
            foreach ($perm_id as $perm) {
                DB::table('role_permission')->insert(['role_id' => $input['role_id'], 'permission_id' => $perm]);
            }
        }
        $data = [
            'status' => 0,
            'msg' => '设置成功！'
        ];
        return $data;
    }
}
