<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Hash;

class PassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::findOrFail($id);
        return view('admin.user.pass',['user'=>$user]);
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
        //根据id,获取要修改的用户
        // $user = User::find($id);
        $users = $request->all();   
        // $input = '123123';
        // $str = "123123";
        // return Hash::make($str);
        // plain-text：input提交过来的数据
        // $hashedPassword 数据库里的数据
        $auser = DB::table('admin_user')->where('id',$id)->first();
        // $pwd = $request->except('username','uid','repass','oldpass');

        $res = Hash::check($users['oldpass'],$auser['password']);
        if ($res) {
            $users['password'] = Hash::make($users['password']);
           
            $upd = User::where('id',$id)->update(['password'=>$users['password']]);
            if ($upd){
                    $data = [
                        'status'=>0,
                        'msg'=>'修改成功'
                    ];
                } else {
                    $data = [
                        'status'=>0,
                        'msg'=>'修改失败'
                    ];
                }
        } else {
            $data = [
                    'status'=>0,
                    'msg'=>'旧密码错误'
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
        //
    }
}
