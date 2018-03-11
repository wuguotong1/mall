<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
//后台 前台用户状态
Route::get('/admin/list/changestate','Admin\UsersController@changeState');

//后台 前台批量删除
Route::get('/admin/qtpl','Admin\UsersController@qtpl');

//后台 前台修该密码实现
Route::get('/admin/updates/{uid}','Admin\UsersController@updates');

//后台 前台修该密码页面显示
Route::get('/admin/xgmm/{id}','Admin\UsersController@xgmm');

//后台 前台列表页
Route::resource('/admin/list','Admin\UsersController');

//批量删除用户路由
Route::get('/admin/plsc','Admin\UserController@plsc');

//用户状态
Route::get('/admin/user/changestate','Admin\UserController@changeState');

//后台修改密码页面显示
Route::resource('/admin/pass','Admin\PassController');

//后台登录页面的显示
Route::controller('/admin/login','Admin\LoginController');

//后台首页显示
Route::resource('/admin/index','Admin\UserController');

