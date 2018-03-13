<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Link;
class LinkController extends Controller
{
    /**
     * 显示友情链接列表
     * @param
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //接收数据
        $search = $request->input('search','');
        //判断数据
        if(!empty($search)) {
            $data = Link::where('link_name','like','%'.$search.'%')->orderBy('sort','asc')->paginate(4);
            $count = count($data);
        }else {
            $data = Link::orderBy('sort','asc')->paginate(4);
            $count = Link::count();
        }
        //加载推荐位模板
        return view('Admin.link.link',['data'=>$data,'search'=>$search,'count'=>$count]);
    }

    /**
     * 显示添加页面的模板
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //预留排序字段
        $count = Link::count();
        //加载模板
        return view('Admin.link.linkAdd',['count'=>$count]);
    }

    /**
     * 执行添加的数据
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接收数据
        $data = $request->except('_token','file_upload');
        //执行操作
        $res = link::insert($data);
        if($res) {
            return redirect('/admin/link')->with('success','添加成功');
        }else {
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
        //
    }

    /**
     * 显示修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function edit($id)
    {
        //获取数据
        $data = link::where('id',$id)->first();
        // dd($data);
        //加载修改页面的模板
        return view('Admin.link.linkEdit',['data'=>$data]);
    }

    /**
     * 执行修改的数据
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //接收数据
        $data = $request->except('_token','file_upload','_method');
        //执行更改
        $res = link::where('id',$id)->update($data);
        if($res) {
            return redirect('/admin/link')->with('success','修改成功');
        }else {
            return back()->with('error','修改失败');
        }
    }

    /**
     * 删除数据
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //找到要删除的记录，并删除
       $res =  Link::find($id)->delete();
        if($res){
            $data = [
                'status'=>0,
                'msg'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'删除失败'
            ];
        }
        return $data;
    }

    /**
     * 修改推荐位的状态
     * @param
     * 
     */
    public function change(Request $request)
    {
        //接收参数
        $input = $request->all();
        //根据id获取要修改状态的用户
        $link = link::find($input['id']);
        //对状态进行取反操作
        $status = ($link->status == 0)? 1:0;
        //更改状态
        $res = $link->where('id',$input['id'])->update(['status'=>$status]);
        //判断结果
        if($res){
            $data = [
                'status'=>1,
                'msg'=>'修改成功'
            ];
        }else{
            $data = [
                'status'=>0,
                'msg'=>'修改失败'
            ];
        }
        return $data;
    }

    /**
     * 轮播图上传
     * @param file
     * 
     */
    public function uploads(Request $request)
    {
        //获取上传的文件对象
        $file = $request->file('file_upload');
        //2.判断上传文件的有效性
        if($file->isValid()){
            //获取文件后缀名
            $ext = $file->getClientOriginalExtension(); //文件拓展名
            //生成新文件名
            $newfilename = md5(date('YmdHis').rand(1000,9999).uniqid()).'.'.$ext;
            //1.上传到本地服务器
            $res = $file->move(public_path().'/uploads', $newfilename);
            //将上传文件的位置返回给客户端
            return '/uploads/'.$newfilename;
        }
    }

    /**
     * 修改推荐位的排序
     * @param
     * 
     */
    public function sort(Request $request)
    {
        //接收参数
        $input = $request->all();
        $count = Link::count();
        if($input['sort'] >= 1 && $input['sort'] <= $count){
            //查询所有的数据
            if($input['mark'] == 1) {
                //进行数据修改
                $res = Link::where('sort',$input['sort']-1)->update(['sort'=>$input['sort']]);
                $ress = Link::where('id',$input['id'])->where('sort',$input['sort'])->update(['sort'=>$input['sort']-1]);
            }else {
                $res = Link::where('sort',$input['sort']+1)->update(['sort'=>$input['sort']]);
                $ress = Link::where('id',$input['id'])->where('sort',$input['sort'])->update(['sort'=>$input['sort']+1]);
            }
            //判断结果
            if($res && $ress){
                $data=[
                    'status'=>0,
                    'msg'=>'修改成功'
                ];
            }else{
                $data=[
                    'status'=>1,
                    'msg'=>'修改失败'
                ];
            }
        }else {
            $data=[
                'status'=>1,
                'msg'=>'不可修改'
                ];
        }
        //给客户端返回修改是否成功的提示信息
        return $data;
    }
}
