<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Comment;
use App\Model\Reply;
use App\Model\User;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Comment::first();
        // $data['uname'] = $_GET['uname'];
        return view('/home/product',['title'=>'评论列表','data'=>$data]);

        // $data = DB::table('comment')->first();
        // // $data['uname'] = $_GET['uname'];
        // return view('/home/product',['title'=>'评论列表','data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $gid = $request->get('gid');
        //加载视图模板
        return view('/home/create',['gid'=>$gid]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //开启事务
        DB::beginTransaction();

        // $uid = DB::select('select uid from comment where id=14');
        // dd($uid[0]['uid']);
        // DB::update('update users set score=score+2 where id=?',[$uid[0]['uid']]);
        $score = User::where('id',4)->first();

        $score->update(['score'=>$score['score'] + 2]);
        
        $data = $request -> except('_token');
        // 处理数据
        $res = Comment::create($data);

        if($res){
            DB::commit();
            return redirect('/home/index')->with('success','添加成功');
        }else{
            DB::rollBack();
            return back()->with('error','添加失败');
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $data = Comment::where('gid',2)->get();
         //获取某商品的评价平均值
         $ave = Comment::where('gid',2)->avg('rate');
         $ave = round($ave);

         //获取某商品的好评差评中评个数
         $count = Comment::where('gid',2)->count();
         $count_high = Comment::where('gid',2)->whereBetween('rate',[81,100])->count();
         $count_midium = Comment::where('gid',2)->whereBetween('rate',[71,80])->count();
         $count_low = Comment::where('gid',2)->whereBetween('rate',[0,70])->count();
        // $data['uname'] = $_GET['uname'];

        return view('/home/product',['title'=>'用户详情','data'=>$data,'rate'=>$ave,'count_high'=>$count_high,'count_midium'=>$count_midium,'count_low'=>$count_low,'count'=>$count]);

         // $data = DB::table('comment as c')
         // ->join('reply as r','r.comment_id','=','c.id')
         // ->join('users as u','u.id','=','c.uid')
         // // ->where('gid','=','2')
         // ->select('r.reply','c.comment','c.ctime','u.uname','u.score')
         // ->paginate(10);
        // dd($data);
         
        //  $ave = DB::table('comment')->where('gid',2)->avg('rate');
        //  $ave = round($ave);
        //  // dump($ave);

        //  $count = DB::table('comment')->where('gid',2)->count();
        //  $count_high = DB::table('comment')->where('gid',2)->whereBetween('rate',[81,100])->count();
        //  $count_midium = DB::table('comment')->where('gid',2)->whereBetween('rate',[71,80])->count();
        //  $count_low = DB::table('comment')->where('gid',2)->whereBetween('rate',[0,70])->count();

        // // $data['uname'] = $_GET['uname'];
        // return view('/home/product',['title'=>'用户详情','data'=>$data,'rate'=>$ave,'count_high'=>$count_high,'count_midium'=>$count_midium,'count_low'=>$count_low,'count'=>$count]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
