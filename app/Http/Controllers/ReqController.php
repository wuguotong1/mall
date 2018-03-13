<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cookie;
use Session;
use Input;

class ReqController extends Controller
{
    public function getCookie()
   {
        Cookie::queue('name','iloveyou',10);

        //返回客户端的响应信息
        return response('haha')->withCookie('uid',10,10);
        echo '设置cookie';
   }
   public function getSession()
   {
        // $value = $request->session()->get('key');//获取
        // $value = $request->session()->get('key','abc');//获取session，没有就设置
        // $data = $request->session()->all();//获取所有的session
        // $data = $request->session()->has('user'); //检测是否含有某session
        // $request->session()->put('key','value');//压入session
        // $value = $request->session()->pull('key','default');//数据从session中取出，并删除
        // $request->forget('key');//删除指定session
        // $request->flush();//删除所有session

    //获取session中的某条数据
    $value = session('key');
    //写入一条数据至session中
    //全局有效，不用开启，设置以数组形式
    session(['abc' => '123']);
    session(['arr'=>array('uname'=>'lisi','age'=>19)]);
    echo 'session';
   }

   public function getInfo(Request $request)
   {
    dump(Cookie::get('name'));
    dump($request->cookie('uid'));
    dump(session('abc'));
    dump(session('arr'));
    echo '获取cookie';
   }

   public function getAdd()
   {
        return view('req/add');
   }
   public function postInsert(Request $request)
   {
        //检测用户名是否存在
        if(!$request->has('name')){
            // $request->flash();
            // //返回上一次请求
            // return back();
            return back()->withInput();
        }
            var_dump($request->except('_token'));
   }
}
