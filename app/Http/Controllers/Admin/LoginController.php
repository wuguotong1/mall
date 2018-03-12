<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Code\Code;
require_once app_path().'\Code\Code.class.php';
class LoginController extends Controller
{
	/**
	 * 显示登录页
	 * @param 
	 * @return 
	 */
    public function login()
    {
    	return view('Admin/index');
    }

    /**
	 * 生成验证码
	 * @param 
	 * @return 
	 */
	public function code()
	{
		$code = new Code;
		return $code->make();
	}

	/**
	 * 后台首页显示
	 * @param 
	 * @return 
	 * 
	 */
	public function getIndex()
	{
		return view('Admin/Layout/index');
	}

	/**
	 * 后台详情页
	 * @param 
	 * @return 
	 * 
	 */
	public function welcome()
	{
		return view('Admin/welcome');
	}
}
