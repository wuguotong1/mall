<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
*/






































































































//后台首页显示 hou
Route::resource('/admin/index','Admin\IndexController');

//前台首页 hou
Route::resource('/','Home\IndexController');//前台页面跳转到商品详情页还没做

// Route::resource('/product','Home\IndexController');//需要传gid	

Route::resource('/home','Home\IndexController');

// Route::controller('/req','ReqController');

Route::resource('/home/index','Home\IndexController');

Route::resource('/feedback','Home\FeedbackController');



