<?php

//admin 超级管理员
//验证码
Route::get('/verify', 'LoginController@verify');
//后台登录界面
Route::get('/', 'LoginController@login');
Route::get('logout', 'LoginController@logout');
Route::post('/login', 'LoginController@doLogin');
Route::get('/noAccess', 'LoginController@noAccess');//没有权限

//后台系统    'hasRole' 权限访问限制，暂时关闭
Route::group(['namespace' => "Admin", 'middleware' => ['admin']], function () {
    //后台首页/主页情报
    Route::get('/index', 'HomeController@index');
    Route::get('/welcome', 'HomeController@welcome');
    Route::get('/info', 'HomeController@info');//报表信息 后续添加

    //用户列表管理
    Route::resource('/users', 'UsersController');
    //用户授权/处理
    Route::get('/users/auth/{id}', 'UsersController@auth');
    Route::post('/users/doAuth', 'UsersController@doAuth');

    //权限列表管理
    Route::resource('/perm', 'PermController');
    //角色管理
    Route::resource('/roles', 'RoleController');
    //角色授权/处理
    Route::get('/roles/auth/{id}', 'RoleController@auth');
    Route::post('/roles/doAuth', 'RoleController@doAuth');
    //商品管理
    Route::resource('/products', 'ProductsController');
    Route::get('/product/{id}', 'ProductsController@info');//商品明细

    //文件打印
//    Route::any('/export/{id}', 'PrintController@export');
    Route::any('/export/', 'PrintController@exports');

    //文件导入
    Route::any('/import', 'PrintController@import');
    //导入导出格式选择
    Route::any('/confirm/output', 'ConfirmController@output')->name('output');
    Route::any('/confirm/input', 'ConfirmController@input')->name('input');


//    Route::any('/upload', 'PrintController@upload');
//    Route::any('/test/{id}','PdfController@index');// 打印发票用
    //通用批量删除
    Route::post('/delAll/{flag}', 'CommonController@delAll');
    Route::any('/test', 'PrintController@export_pdf');
});
