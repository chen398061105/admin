<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UsersController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //关键字过滤降序检索
        $users = User::orderBy('id', 'asc')
            ->where(function ($query) use ($request) {
                //根据用户名检索
                $name = $request->get('name');
                if (!empty($name)) {
                    $query->where('username', 'like', '%' . $name . '%');
                }
            })->paginate(10);
        session(['users' => $request->get('name')]);//
        $num = User::count();//一共有多少数据
        return view('admin.members', compact('users', 'request', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.member-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token', 'repass');
        //表单验证。。暂时不做
        // 如果该用户已经存在则返回
        $username = $input['username'];
        $pass = Crypt::encrypt($input['password']);

        $res = User::select('username')->get()->toArray();
        $data = ['status' => 1, 'msg' => '该用户已经存在'];
        foreach ($res as $names) {
            if (in_array($username, $names)) {
                return $data;
            }
        }
        $res = User::create(['username' => $username, 'password' => $pass]);
        if ($res) {
            $data = [
                'status' => 0,
                'msg' => '添加成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '添加失败'
            ];
        }
        return $data;
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
        $user = User::find($id);
        return view('admin.member-edit', compact('user'));
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
        //
        $input = $request->only('username', 'password');
        $username = $input['username'];
        $pass = Crypt::encrypt($input['password']);

        $user = User::find($id);
        $res = $user->update(['username' => $username, 'password' => $pass]);
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
        //
        $input = User::find($id)->delete();
        if ($input) {
            $data = [
                'status' => 0,
                'msg' => '操作成功'
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '操作失败'
            ];
        }
        return $data;
    }

    public function auth($id){

        $user = User::find($id);
        $roles = Role::get();
        $own_roles = $user->role;
        //当前用户拥有的角色的ID列表
        $own_roleids = [];
        foreach ($own_roles as $own_role){
            $own_roleids[] = $own_role->id;
        }
        return view('admin.member-auth',compact('user','roles','own_roleids'));
    }

    public function doAuth(Request $request){
        $input = $request->except('_token');
       if (!isset($input['role_id'])){
           $data = [
               'status' => 1,
               'msg' => '角色必须得选一个！'
           ];
           return $data;
       }
        //传过来的id字符串转成数组
        $role_id = explode(',',$input['role_id']);
        //如果权限存在则删除重新赋权
        DB::table('user_role')->where('user_id', $input['user_id'])->delete();
        if (!empty($role_id)) {
            foreach ($role_id as $role) {
                DB::table('user_role')->insert(['user_id' => $input['user_id'], 'role_id' => $role]);
            }
        }
        $data = [
            'status' => 0,
            'msg' => '设置成功！'
        ];
        return $data;
    }

}
