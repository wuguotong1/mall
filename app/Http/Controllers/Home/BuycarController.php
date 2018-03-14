<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Buycar;
use App\Model\Collect;
class BuycarController extends Controller
{
    /**
     * 显示购物车页面
     * @param
     * 
     */
    public function index()
    {
        //查询数据
        $data = Buycar::where('uid',1)->get();
        // dd($data);
        // die;
        //加载模板
        return view('Home.user.buycar',['data'=>$data]);
    }

    /**
     * 数量修改后 显示的价格
     * @param json data
     * 
     */
    public function num(Request $request)
    {
        //接收参数
        $input = $request->all();
        // return $input;
        // die;
        //修改数据库
        $res = Buycar::where('uid',$input['uid'])->where('gid',$input['gid'])->update(['num'=>$input['c']]);
        if($res){
            $data=[
                'status' => 1
            ];
        }else{
            $data = [
                'status' => 0
            ];
        }
        return $data;
    }

    /**
     * 将商品加入收藏
     * @param 
     * 
     */
    public function collect(Request $request)
    {
        //接收数据
        $input = $request->all();
        //插入数据
        $res = Collect::insert($input);
        if($res){
            $data = [
                'status' => 1,
                'msg' => '添加收藏成功'
            ];
        }else{
            $data = [
                'status' => 0,
                'msg' => '已收藏'
            ];
        }
        return $data;
    }

    /**
     * 删除购物车里的商品
     * @param int $id
     * 
     */
    public function del(Request $request)
    {
        //接收数据
        $input = $request->all();
        //执行操作
        $res = Buycar::where('id',$input['id'])->delete();
        if($res){
            $data = [
                'status' => 1,
            ];
        }else{
            $data = [
                'status' => 0,
            ];
        }
    }

    /**
     * 显示商品收藏页面
     * @param 
     * 
     */
    public function showCollect()
    {
        return view('Home.user.collect');
    }

}
