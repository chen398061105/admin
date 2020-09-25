<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        return view('admin.index');
    }
    public function welcome(){
        return view('common.public.welcome');
    }
    //后台主页情报
    public function info(){

    }

}
