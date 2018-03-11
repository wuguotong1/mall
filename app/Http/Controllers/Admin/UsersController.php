<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use DB;
use App\Model\Users;
use App\Model\Userf;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataa = Userf::count();
        $data = Userf::orderBy('id','asc')->where(function($query) use($request){
            // 检测关键字
            $username = $request->input('keywords1');
            $email = $request->input('keywords2');

            //如果用户名不为空
            if(!empty($username)) {
                $query->where('username','like','%'.$username.'%');
            }
            //如果邮箱不为空
            if(!empty($email)) {
                $query->where('email','like','%'.$email.'%');
            }
        })->paginate($request->input('num', 5));
        // 后台 前台用户列表页
        return view('admin.home.list',['data'=>$data,'request'=>$request,'dataa'=>$dataa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.home.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request -> except('_token','uid','nikename','repass','sex','age','phone','email','QQ');
        $data['password'] = Hash::make($data['password']);
        $res = Userf::insert($data);
        if ($res) {
            $dataa = $request -> except('_token','repass','username','password','status');
            $uid = Userf::where('username',$data['username'])->value('id');
            $dataa['uid'] = $uid;
            $ress = Users::insert($dataa);
            if ($ress) {
                $data = [
                    'status'=>0,
                    'msg'=>'添加成功'
                ];
            } else {
                Userf::where('username',$data['username'])->delete();
                $data = [
                    'status'=>1,
                    'msg'=>'添加失败'
                ];
            }
        } else {
             $data = [
                    'status'=>1,
                    'msg'=>'添加失败'
                ];
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 根据ID获取要修改的用户
        $user = Userf::findOrFail($id);
        return view('admin.home.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $input = $request -> except('_token','repass','username','password','status');
        $uid = $input['uid'];
        unset($input['uid']);
        $res = DB::table('users_detail')->where('uid',$uid)->update($input);
        if ($res) {
            $data = [
                'status'=>0,
                'msg'=>'修改成功'
            ];
        } else {
            $data = [
                'status'=>1,
                'msg'=>'修改失败'
            ];
        }
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //找到要删除的记录，并删除
        $res = Userf::where('id',$id)->delete();
        DB::beginTransaction();
        if($res){
                Users::where('uid',$id)->delete();
                DB::commit();
                $data = [
                    'status'=>0,
                    'msg'=>'删除成功'
                ];
            } else {
                DB::rollBack();
                $data = [
                    'status'=>1,
                    'msg'=>'删除失败'
                ];
            }
        return $data;
    }

    /**
     * 修改密码
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function xgmm($id)
    {
        // 根据id,获取要修改的用户
        $user = Userf::find($id);
        return view('admin.home.xgmm',['user'=>$user]);
    }

    /**
     * 修改密码
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updates(Request $request, $uid)
    {
        // 用户提交的数据
        $input = $request->all();
        // 数据库的数据
        $datas = Userf::where('id',$uid)->first();
        //开启事务
        DB::beginTransaction();
        // 哈希验证 旧密码是否和数据库的密码一致
        $res = Hash::check($input['oldpass'],$datas['password']);
        if ($res) {
            $input['password'] = Hash::make($input['password']);
            Userf::where('id',$uid)->update(['password'=>$input['password']]);
            DB::commit();
            $data = [
                'status'=>0,
                'msg'=>'修改成功'
            ];
        } else {
            DB::rollBack();
            $data = [
                'status'=>0,
                'msg'=>'旧密码错误'
            ];
        }
        return $data;
    }

    /**
     * 批量删除用户
     */
    public function qtpl(Request $request)
    {
        $input = $request->input('ids');
        DB::beginTransaction();
        foreach ($input as $key => $value) {
            $res = Userf::where('id',$value)->delete();
            if($res) {
                Users::where('uid',$value)->delete();
                DB::commit();
                $data = [
                    'status'=>0,
                    'msg'=>'删除成功'
                ];
            } else {
                DB::rollBack();
                $data = [
                    'status'=>1,
                    'msg'=>'删除失败'
                ];
            }
        }             
        return $data;
    }

    /**
     * 用户状态
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeState(Request $request)
    {
        $input = $request->all();
        //根据id获取要修改状态的用户
        $user = Userf::find($input['id']);
        $st = ($user->status == 0)? 1:0;
        //更改状态
        // $res = $user->update(['status'=>$st]);
        // return $res;
        $user->status = $st;
        $res = $user->save();
        if($res){
            $data = [
                'status'=>0,
                'msg'=>'修改成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'修改失败'
            ];
        }
        return $data;
    }
}
