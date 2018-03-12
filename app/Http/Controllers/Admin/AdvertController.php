<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Recommend;
use App\Model\Goods;
use App\Model\Cate;
use DB;
class AdvertController extends Controller
{
    /**
     * 定义显示类的公共方法
     * @param
     * 
     */
    public function pubCates()
    {
        //获取当前所有的分类
        $cates = DB::table('goods_cate')->select('*',DB::raw('concat(path,",",id) as paths'))->orderBy('paths','asc')->get();
        //处理分类名称
        foreach ($cates as $key => $value) {
            //统计字符串出现的次数
            $sum = substr_count($value['path'],',');
            //重复使用字符串 拼接名称
            $cates[$key]['type_name'] = str_repeat('|---',$sum).$cates[$key]['type_name'];
        }
        //返回数据
        return $cates;
    }

    /**
     * 显示列表页面
     * @param $request
     * @return
     */
    public function getIndex(Request $request)
    {
        //接收数据
        $search = $request->input('search','');
        //判断数据
        if(!empty($search)) {
            $data = Recommend::where('name','like','%'.$search.'%')->orderBy('sort','asc')->paginate(4);
            $count = count($data);
        }else {
            $data = Recommend::orderBy('sort','asc')->paginate(4);
            $count = Recommend::count();
        }
        //加载推荐位模板
        return view('Admin.recommend.recom',['data'=>$data,'search'=>$search,'count'=>$count]);
    }

    /**
     * 显示推荐位添加的页面
     * @param void
     * @return
     * 
     */
    public function getAdd()
    {
        //获取分类表中的数据 加载到添加页面中
        $cates = $this->pubCates();
        $count = Recommend::count();
        //分配数据
        return view('Admin.recommend.recomAdd',['cates'=>$cates,'count'=>$count]);
    }

    /**
     * 执行添加页面的数据
     * @param  Request $request 
     * @return            
     */
    public function postInsert(Request $request)
    {
        //接收数据
        $data = $request->except('_token','file_upload');
        // dump($data);
        $res = Recommend::insert($data);
        if($res) {
            return redirect('/admin/advert')->with('success','添加成功');
        }else {
            return back()->with('error','添加失败');
        }
    }

     /**
      * 使用Ajax上传图片的方法
      * @param  Request $request 接收的文件
      * @return [type]
      */
     public function upload(Request $request)
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
        $count = Recommend::count();
        if($input['sort'] >= 1 && $input['sort'] <= $count){
            //查询所有的数据
            if($input['mark'] == 1) {
                //进行数据修改
                $res = Recommend::where('sort',$input['sort']-1)->update(['sort'=>$input['sort']]);
                $ress = Recommend::where('id',$input['id'])->where('sort',$input['sort'])->update(['sort'=>$input['sort']-1]);
            }else {
                $res = Recommend::where('sort',$input['sort']+1)->update(['sort'=>$input['sort']]);
                $ress = Recommend::where('id',$input['id'])->where('sort',$input['sort'])->update(['sort'=>$input['sort']+1]);
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

    /**
     * 显示修改的操作页面
     * @param int $id
     * @return obj $data
     * 
     */
    public function getEdit($id)
    {
        //获取分类
        $cates = $this->pubCates();
        //获取推荐表中数据
        $data = Recommend::where('id',$id)->first();
        //加载模板
        return view('Admin.recommend.recomEdit',['cates'=>$cates,'data'=>$data]);
    }

    /**
     *  执行修改页面的数据
     *  @param Request $request int $id
     *  @return bool $res
     *  
     */
    public function postUpdate(Request $request,$id)
    {
        //接收数据
        $data = $request->except('_token','file_upload');
        $path = $data['old_thumb'];
        unset($data['old_thumb']);
        //执行更改
        $res = Recommend::where('id',$id)->update($data);
        if($res) {
            unlink(public_path().$path);
            return redirect('/admin/advert')->with('success','修改成功');
        }else {
            return back()->with('error','修改失败');
        }
    }

    /**
     * 删除数据
     * @param int $id
     * @return bool $res
     * 
     */
    public function getDelete($id)
    {
        //执行删除
        $res = Recommend::where('id',$id)->delete();
        if($res) {
            return redirect('/admin/advert')->with('success','删除成功');
        }else {
            return back()->with('error','删除失败');
        }
    }

    /**
     * 批量删除用户
     * @param array $arr 用户id数组
     * @return bool $res
     * 
     */
    public function getDelall(Request $request)
    {
        //接收参数
        $input = $request->input('ids');
        // return $input;
        //执行删除操作
        $res = Recommend::destroy($input);
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
     * @param Request $request
     * 
     */
    public function getChange(Request $request)
    {
        //接收参数
        $input = $request->all();
        //根据id获取要修改状态的用户
        $recom = Recommend::find($input['id']);
        //对状态进行取反操作
        $status = ($recom->status == 0)? 1:0;
        //更改状态
        $res = $recom->where('id',$input['id'])->update(['status'=>$status]);
        //判断结果
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

    /**
     * 当选择分类后显示
     * 显示该分类下的商品列表
     * @param int cid
     * @return json
     * 
     */
    public function goods(Request $request)
    {
        //接收参数
        $cid = $request->input('cid');
        //查询数据库
        $result = Goods::where('cid',$cid)->get();
        return $result;
    }
}
