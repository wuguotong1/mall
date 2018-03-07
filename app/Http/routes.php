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
Route::get('/',function(){
    return view('welcome');
});
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    //后台登录
    Route::get('login','LoginController@login')->name('admin.login');
//获取验证码
    Route::get('vcode','LoginController@vcode');
    //提交后台登录处理逻辑
    Route::post('dologin','LoginController@doLogin');

});
// Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'login'],function(){
    //用户模块
Route::get('admin/user/changestate','Admin\UserController@changeState');
//    批量删除用户路由
Route::get('admin/user/del','Admin\UserController@del');
Route::resource('admin/user','Admin\UserController');

//分类模块
Route::resource('admin/cate','Admin\CateController');
//商品模块
Route::post('admin/upload','Admin\GoodsController@upload');
Route::resource('admin/goods','Admin\GoodsController');