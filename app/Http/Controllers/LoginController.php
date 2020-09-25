<?php

namespace App\Http\Controllers;

use App\Models\User;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function login(){
        return view('auth.login');
    }
    public function doLogin(Request $request){
//        echo Crypt::encrypt('123456');exit;
        $input = $request->except('_token');
        // 进行表单验证
//        $validator = Validator::make('需要验证的表单数据','验证规则数组','错误提示信息数组')；
        $rule = [
            'username' => 'required|between:2,12',
            'password' => 'required|between:6,12|alpha_dash',//数字 字母 下划线
        ];
        $message = [
            'username.required' => '用户名必须输入',
            'username.between' => '用户名长度必须为4～18位',
            'password.required' => '用户名必须输入',
            'password.between' => '密码长度必须为4～18位',
            'password.alpha_dash' => '密码必须是数字,字母,下划线',
        ];
        $validator = Validator::make($input,$rule,$message);
        //如果验证失败跳转到登录页面，
        if ($validator->fails()){
            return redirect('/')->withErrors($validator)->withInput();
        }
//        验证账户是否存在
//        1 - 验证验证码
        if (strtolower($input['verity'])  != strtolower(session()->get('code'))) {
            return redirect('/')->with('errors', '验证码错误！');
        }
        //2 -验证数据库
        $user = User::where('username',$input['username'])->first();
        if (!$user){
            return redirect('/')->with('errors', '用户名错误！');
        }
        if ($input['password'] != Crypt::decrypt($user['password'])){
            return redirect('/')->with('errors', '密码错误！');
        }

        //4信息保存到session中,退出以及等时候可以可以删除
        session()->put('username', $user['username']);
        session()->put('password', $user['password']);
        session()->put('user', $user);//hasRole里调用
        return view('admin.index');
    }

    public function logout(){
        session()->flush();
        return redirect('/');
    }

    public function verify(){
        $phrase = new PhraseBuilder;
        $code = $phrase->build(4);
        $builder = new CaptchaBuilder($code, $phrase);
        $builder->setBackgroundColor(255, 255, 255);
        $builder->build(130,40);
        $phrase = $builder->getPhrase();
        Session::flash('code', $phrase); //存储验证码
        return response($builder->output())->header('Content-type','image/jpeg');
    }

    public function noAccess(){

        return view('errors.access');
    }
}
