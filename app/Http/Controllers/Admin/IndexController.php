<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Comment;
use App\Model\Reply;
use Input;


class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //分页，如未选择显示条数，默认显示20条
        $count = Comment::count();
        $search = $request -> input('search','');

       
        //搜索框
        $data = Comment::where('comment','like','%'.$search.'%')
            ->orWhere('uid','like','%'.$search.'%')
            ->orWhere('id','like','%'.$search.'%')
            ->orWhere('title','like','%'.$search.'%')
            ->orWhere('item','like','%'.$search.'%')
            ->orWhere('rate','like','%'.$search.'%')
            ->paginate(5);
        //加载模板
        return view('/admin/index/index',['title'=>'评论列表','data'=>$data,'count'=>$count,'search'=>$search]);
    }

    /**
     * 在后台回复用户的评论，更新reply表里的数据
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //获取要回复的评论ID，和输入框内的回复内容
        $id = $request->input('id');
        $reply = $request->input('reply');
        //更新回复表内，对应comment_id的reply内容
        $res = Reply::where('comment_id',$id)->insert(['comment_id'=>$id,'reply'=>$reply]);

         if($res){
            return redirect('/admin/index')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }

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
        $data = Comment::where('id',$id)->first();
        
        return view('/admin/index/show',['title'=>'用户详情','data'=>$data]);
    } 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //获取用户数据
        $data = Comment::where('id',$id)->first();

        //加载模板
        return view('/admin/index/edit',['title'=>'修改好评','data'=>$data]);
    }
    /**
     * 修改用户评论
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //获取所有的数据
        $data = $request->all();

        // dump($data);
        $arr = ['id'=>$data['id'],'gid'=>$data['gid'],'title'=>$data['title'],'comment'=>$data['comment'],'rate'=>$data['rate']];   
        // $arr = ['id'=>$data['id'],'uname'=>$data['uname']];

        $res = Comment::where('id',$id)->update($arr); 
         if($res){
            return redirect('/admin/index')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }

        // $arr = ['id'=>$data['id'],'gid'=>$data['gid'],'title'=>$data['title'],'comment'=>$data['comment'],'ctime'=>$data['ctime'],'rate'=>$data['rate']];
        // // $arr = ['id'=>$data['id'],'uname'=>$data['uname']];

        // $res = DB::table('comment')->where('id',$id)->update($arr); 
        //  if($res){
        //     return redirect('/admin/index')->with('success','修改成功');
        // }else{
        //     return back()->with('error','修改失败');
        // }
    }

    /**
     * 删除某条用户评论
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Comment::where('id',$id)->delete();
        
        if($res){
            return redirect('/admin/index')->with('success','删除成功');
        }else{
            return back()->with('error','添加失败');
        }
        // $res = DB::table('comment')->where('id',$id)->delete();
        // if($res){
        //     return redirect('/admin/index')->with('success','删除成功');
        // }else{
        //     return back()->with('error','添加失败');
        // }
    }

}
