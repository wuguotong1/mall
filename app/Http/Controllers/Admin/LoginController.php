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

    public function vcode()
    {
        $code = new Code;

        return $code->make();
    }

    public function doLogin(Request $request)
    {
        $input = $request->except('_token');

//          2. 验证数据有效性
//        $validator = Validator::make(需要验证的数据，验证规则，错误提示信息);

          $rule = [
              'username'=>'required|between:5,18',
              'password'=>'required|between:5,20|alpha_dash'
          ];
        $msg =[
            'username.required'=>'用户名必须输入',
            'username.between'=>'用户名应该在5到18位之间',
            'password.required'=>'密码必须输入',
            'password.between'=>'密码应该在5到20位之间',
            'password.alpha_dash'=>'密码必须是数字字母下划线',

        ];

        $validator = Validator::make($input,$rule,$msg);
        //如果验证失败
        if($validator->fails()){
            return redirect('admin/login')->withErrors($validator)->withInput();
        }

//        3. 验证用户是否存在

        $user = User::where('user_name',$input['username'])->first();
        if(empty($user)){
            return redirect('admin/login')->with('errors','用户名不存在');
        }

//        4. 密码是否正确
        if($input['password'] !=  Crypt::decrypt($user->user_pass) ){
            return redirect('admin/login')->with('errors','密码不对');
        }

//        5. 验证码
        if(strtolower($input['code'])  != strtolower(session('code')) ){
            return redirect('admin/login')->with('errors','验证码不对');
        }

        //如果登录成功，将登录用户信息保存到session中

        session()->put('user',$user);

        return redirect('admin/index');

    }
    /**
     * 后台首页显示
     * @param
     * @return
     *
     */
    public function code()
    {
        $code = new Code;
        return $code->make();
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
