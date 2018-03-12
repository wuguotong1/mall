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
    //return Hash::check('123123','$2y$10$Tlj5KfZn3J44.FBcgX6HTuArtxkaYhXJgXu9o4RYKdjJdXjX2mHje');
});

//后台登录页面的显示
Route::get('/admin','Admin\LoginController@login');
//后台验证码的生成
Route::get('/admin/code','Admin\LoginController@code');
//后台详情页
Route::get('/admin/welcome','Admin\LoginController@welcome');


//后台首页显示
Route::controller('/admin/index','Admin\LoginController');
//网站配置模块
Route::post('/admin/config/changecontent','Admin\ConfigController@changeContent');
Route::get('/admin/config/putcontent','Admin\ConfigController@putContent');
Route::resource('/admin/config','Admin\ConfigController');
//文件上传
Route::post('/admin/config/upload','Admin\ConfigController@upload');

//前台路由
Route::get('/index','Home\IndexController@index');
