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
//Route::get('/',function(){
//    return view('welcome');
//});
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
//批量删除用户路由
Route::get('admin/user/del','Admin\UserController@del');
Route::resource('admin/user','Admin\UserController');

//分类模块
Route::resource('admin/cate','Admin\CateController');
//商品模块
Route::post('admin/upload','Admin\GoodsController@upload');
Route::resource('admin/goods','Admin\GoodsController');

//推荐位管理
Route::controller('/admin/advert','Admin\AdvertController');
Route::post('/advert/upload','Admin\AdvertController@upload');
Route::post('/advert/sort','Admin\AdvertController@sort');
Route::post('/advert/sortt','Admin\AdvertController@sortt');

//轮播图管理
Route::resource('/admin/carousel','Admin\CarouselController');
Route::get('/change','Admin\CarouselController@change');
Route::any('/carousel/uploads','Admin\CarouselController@uploads');
Route::get('/carousel/dellall','Admin\CarouselController@delAll');

//前台相关路由
Route::get('/','Home\IndexController@index');
Route::get('/home','Home\IndexController@indexx');

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
