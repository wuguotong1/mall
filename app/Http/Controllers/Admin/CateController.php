<?php

namespace App\Http\Controllers\Admin;

use App\Model\Cate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
    /**
     * 分类控制器
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $cates = (new Cate())->getTree();
        //数据格式化（排序、缩进）

        return view('admin.cate.list',compact('cates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cateone = Cate::where('pid',0)->get();
        return view('admin.cate.add',compact('cateone'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        if($data['pid'] == 0){
            // 顶级分类
            $data['path'] = 0;
        }else{
            // 子分类
            // 查询父级分类的数据
            $parent_data = Cate::where('id',$data['pid'])->first();
            // 处理数据
            $data['path'] = $parent_data['path'].','.$parent_data['id'];
        }

        // 执行添加
        $res = Cate::insert($data);
        if($res){
            return redirect('admin/cate')->with('success','添加成功');
        }else{
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Cate::findOrFail($id);
        if($data->pid == 0)
        {
            $data->pid = '顶级分类';
        }
        return view('admin.cate.edit',compact('data'));
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
        $input = $request->except('email');
        $cate = Cate::find($id);
        //将用户的相关属性修改为用户提交的值

//        $cate['type_name'] = $input['type_name'];
//            $res = $cate->save();
        $res = $cate->update(['type_name'=>$input['type_name']]);

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
//        $cate = Cate::where('id',$input->id)
//            ->update(['type_name'=>$input->type_name])
//        $cate->update
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
