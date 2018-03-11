<?php

namespace App\Http\Controllers\Admin;

use App\Model\Cate;
use App\Model\Goods;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
     * 文件上传处理
     */
    public function upload(Request $request)
    {
        //1.获取上传文件
        $file = $request->file('file_upload');

//        2.判断上传文件的有效性
        if($file->isValid()){
//            获取文件后缀名
            $ext = $file->getClientOriginalExtension();    //文件拓展名

            //生成新文件名

            $newfilename = md5(date('YmdHis').rand(1000,9999).uniqid()).'.'.$ext;

            //1.上传到本地服务器
//            return $newfilename;
            $res = $file->move(public_path().'/upload', $newfilename);

//            2.上传到阿里云OSS
//            OSS::upload($newfilename,$file->getRealPath());

//            3.上传到七牛云
//            $disk = Storage::disk('qiniu');
//            $disk->put('avatars/1', $fileContents);
//             Storage::disk('qiniu')->writeStream('uploads/'.$newfilename, fopen($file->getRealPath(), 'r'));




            //将上传文件的位置返回给客户端

            return '/upload/'.$newfilename;

        }
    }
    public function index()
    {
//        return Hash::make('123123');
//        $2y$10$R0sMXj6Tbc4UNNbVBZZkSuFTkCwK9CcrvwYCfeArwaTWRG52b/60q

//        $goods = [];
        //对应分类cid 的商品信息
//        $goods = Goods::where('cid',2)->get()->toArray();
//        $data = Cate::get()->toArray();
//            foreach($data as $v){
//                $res = Goods::where('cid',$v['id'])->get()->toArray();
//
//                if(!empty($res)){
//                    $goods = $res;
//                }
//            }
        //商品表信息
        $goods = Goods::get()->toArray();
        foreach($goods as $k=>$v){
            $res = Cate::where('id',$v['cid'])->get();
            //拿商品表的cid去查分类id
            if(!empty($res)){
                foreach($res as $m)
                {
                    $goods[$k]['type_name']=$m->type_name;
                }
            }
        }
//        dd($goods);
        return view('admin.goods.list',compact('goods'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = Cate::get();
        return view('admin.goods.add',compact('cates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request -> except(['_token','file_upload']);
        $res = Goods::create($input);
        if($res){
            return redirect('admin/goods')->with('msg','添加成功');
        }else{
            return back()->with('msg','添加失败');
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
        $data = Goods::find($id);
        return view('admin.goods.edit',compact('data'));
    }

    /**
     * Update the specified resource pin storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token','file_upload','id');
        $goods = Goods::find($id);
        if(empty($data['photo'])){
            $old_photo = $goods->photo;
            $data['photo'] = $old_photo;
        }
        $res = $goods->update($data);
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
//        ['desc'=>$data['desc'],'photo'=>$data['photo'],'old_price'=>$data['old_price'],'new_price'=>$data['new_price'],'cid'=>$data['cid']]
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res =  Goods::find($id)->delete();
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
}
