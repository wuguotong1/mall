<?php

namespace App\Http\Controllers\Home;

use App\Model\Cate;
use App\Model\Goods;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CateController extends Controller
{
    /**
     * 通过分类点击的商品列表
     *
     *
     */
    public function index(Request $request,$id,$search='')
    {

        if(!empty($search)){
            //判断传过来的值是什么属性
            $arr = explode('=',$search);
            //颜色属性
            $data = [];
            $goods = [];
            if($arr[0] == 'color'){
                //查询商品属性表里的属性
                $detail = DB::table('goods_detail')->where('color',$arr[1])->get();
//                判断有没有该属性
                if(!empty($detail)){
                    //通过商品属性表查询对应商品
                    foreach ($detail as $v){
                        $goods[] = Goods::where('id',$v['gid'])->get();
                    }
                    //通过对应商品查询是否在该分类下

                    foreach ($goods as $m) {
                        if($id == $m[0]['cid']){
                            $data[] = $m;
                        }
                    }

                    $data = $data[0];
                    //二级分类
                    $cate =Cate::find($id);
                    //顶级分类
                    $cates = Cate::find($cate->pid);
                    return view('home.cate.list',compact('data','cate','cates'));
                }else{
                    $data = Goods::where('cid','=',$id)->orderBy('id','desc');
                    //二级分类
                    $cate =Cate::find($id);
                    //顶级分类
                    $cates = Cate::find($cate->pid);
                    return view('home.cate.list',compact('data','cate','cates'));
                }

            }
            //内存属性
            if($arr[0] == 'attr'){
                //查询商品属性表里的属性
                $detail = DB::table('goods_detail')->where('attr',$arr[1])->get();
                //通过商品属性表查询对应商品
                if(!empty($detail)){
                foreach ($detail as $v){
                    $goods[] = Goods::where('id',$v['gid'])->get();
                }
                //通过对应商品查询是否在该分类下

                foreach ($goods as $m) {
                    if($id == $m[0]['cid']){
                        $data[] = $m;
                    }
                }

                $data = $data[0];
                //二级分类
                $cate =Cate::find($id);
                //顶级分类
                $cates = Cate::find($cate->pid);
                return view('home.cate.list',compact('data','cate','cates'));
            }else {
                    $data = Goods::where('cid', '=', $id)->orderBy('id', 'desc');
                    //二级分类
                    $cate = Cate::find($id);
                    //顶级分类
                    $cates = Cate::find($cate->pid);
                    return view('home.cate.list', compact('data', 'cate', 'cates'));
                }
            }
        }else{

//            没有任何过滤条件
            $data = Goods::where('cid','=',$id)->orderBy('id','desc')->get();
            //二级分类
            $cate =Cate::find($id);
            //顶级分类
            $cates = Cate::find($cate->pid);

//            dump($data);
            return view('home.cate.list',compact('data','cate','cates'));
        }

        // dump($data);

    }

//    public function showList($id,$search)
//    {
//        $data = [];
//        $da = Goods::where('cid','=',$id)->get();
//        foreach ($da as $v){
//
//        }
//        //二级分类
//        $cate =Cate::find($id) ;
//        //顶级分类
//        $cates = Cate::find($cate->pid);
//        return view('home.cate.list',compact('data','cate','cates'));
//    }

    public function getSearch(Request $requests)
    {

        $search = $requests->all();
        $data = Goods::where('goods_title','like','%'.$search['search'].'%')->get();


        if(empty($data[0])){
            return redirect('/');
        }else{

            return view('home.cate.list',compact('data'));
        }

    }
}
