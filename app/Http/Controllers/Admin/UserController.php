<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use DB;
use App\User;
use App\Model\Userinfo;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataa = User::count();
        // $data = DB::table('admin_users')->get();
        // dd($data);
        //        多条件分页查询
        $data = User::orderBy('id','asc')->where(function($query) use($request){
            //检测关键字
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
        
        // 加载后台首页模板
        return view('admin.user.index',['data'=>$data, 'request'=> $request,'dataa'=>$dataa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 加载后台添加模板
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request -> except('_token','repass','phone','email','qq');
        $data['password'] = Hash::make($data['password']);
        $res = DB::table('admin_user')->insert($data);
        if ($res) {
            $dataa = $request -> except('_token','repass','username','password','status','auth');
            
            $uid = DB::table('admin_user')->where('username',$data['username'])->value('id');
            $dataa['uid'] = $uid;
            $ress = DB::table('admin_users')->insert($dataa);

            if ($ress) {
                $data = [
                    'status'=>0,
                    'msg'=>'添加成功'
                ];
            } else {
                DB::table('admin_user')->where('username',$data['username'])->delete();
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
        $user = User::findOrFail($id);
        return view('admin.user.edit',['user'=>$user]);
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
        $user = User::find($id);
        //将用户的相关属性修改为用户提交的值
        $input = $request -> except('uid','phone','email','qq');
        $res = $user->where('id',$id)->update($input);
        if($res){
            $inputs = $request -> except('uid','username','auth');
            $ress = Userinfo::where('uid',$id)->update($inputs);
            if ($ress) {
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
        }else{
            $data = [
                'status'=>1,
                'msg'=>'修改失败'
            ];
        }
        return $data;
    }

    /**
     * 删除用户
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //找到要删除的记录，并删除
        $res = User::find($id)->delete();
        if($res){
            $ress = Userinfo::where('uid',$id)->delete();
            if($ress) {
                $data = [
                    'status'=>0,
                    'msg'=>'删除成功'
                ];
            } else {
                $data = [
                    'status'=>1,
                    'msg'=>'删除失败'
                ];
            } 
        } else {
                $data = [
                    'status'=>1,
                    'msg'=>'删除失败'
                ];
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
        $user = User::find($input['id']);
        $st = ($user->status == 0)? 1:0;
        //更改状态
        // $res = $user->update(['status'=>$st]);
        // return $res;
        $user->status = $st;
        $res = $user->save();
        if($res){
            $data = [
                'status'=>0,
                'msg'=>'添加成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'添加失败'
            ];
        }

        return $data;
    }

    /**
     * 批量删除用户
     */
    public function plsc(Request $request)
    {
        $input = $request->input('ids');
        // return $input;
        // $res = User::destroy($input);
        // if($res){
        foreach ($input as $key => $value) {
            $res = User::where('id',$value)->delete();
            // return $res;
            if($res) {
                $ress = Userinfo::where('uid',$value)->delete();
                if ($ress) {
                    $data = [
                        'status'=>0,
                        'msg'=>'删除成功'
                    ];
                } else {
                    $data = [
                        'status'=>1,
                        'msg'=>'删除失败'
                    ];
                }
            } else {
                $data = [
                    'status'=>1,
                    'msg'=>'删除失败'
                ];
            }
        }
            return $data;
    }
}
