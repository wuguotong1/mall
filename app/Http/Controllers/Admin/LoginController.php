<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Code\Code;
use \DB;
require_once app_path().'\Code\Code.class.php';
class LoginController extends Controller
{
	/**
	 * 显示登录页
	 * @param 
	 * @return 
	 */
    public function getLogin()
    {
    	return view('admin\user\login');
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
}
