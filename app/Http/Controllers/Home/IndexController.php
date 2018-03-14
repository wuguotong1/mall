<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Comment;
use App\Model\Reply;
use App\Model\User;
use App\Model\Carousel;
use App\Model\Recommend;
use App\Model\Link;
use DB;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $data = Comment::first();
    //     // $data['uname'] = $_GET['uname'];
    //     return view('/home/product',['title'=>'评论列表','data'=>$data]);

    // }

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
        $data = $request->input();
        //开启事务
        DB::beginTransaction();
        $dataa = User::where('id',4)->first();
        $dataa['score'] += 2;
        $ress = User::where('id',4)->update(['score'=>$dataa['score']]);

        //接收评论数据
        $data = $request -> except('_token');
        // 处理数据
        $res = Comment::create($data);

        if($res && $ress){
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

    /**
     * 加载首页
     * @param
     * 
     */
    public function indexx()
    {
        //推荐位
        $recom = Recommend::where('status','1')->orderBy('sort','asc')->get();
        //轮播图
        $carousel = Carousel::where('status','1')->get();
        //友情链接
        $link = Link::where('status','1')->orderBy('sort','asc')->get();
        //加载模板
        return view('Home.Index',['carousel'=>$carousel,'recom'=>$recom,'link'=>$link]);
    }
}
