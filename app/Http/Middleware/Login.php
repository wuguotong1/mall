<?php

namespace App\Http\Middleware;

use Closure;

class Login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!session('user')){
            return redirect()->route('admin.login')->with('errors','这里不欢迎你，请你自觉离开，谢谢！');
        }
//        登录后
        return $next($request);
    }
}
