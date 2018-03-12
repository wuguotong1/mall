<?php

namespace App\Http\Controllers\Admin;
use App\Model\Config;
// use App\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use League\Flysystem\Exception;
class ConfigController extends Controller
{
    /**
     * 文件上传处理
     */
    public function upload(Request $request)
    {
       //1.获取上传的文件对象
       $file = $request->file('file_upload');
       //return $file;
       //2.判断上传文件的有效性
       if($file->isValid()){
            //获取上传文件的后缀名
            $ext = $file->getClientOriginalExtension();
            //生成新文件名
            $newfilename = md5(date('YmdHis').rand(1000,9999).uniqid()).'.'.$ext;
            //移动文件到指定位置
            // return $newfilename;
            $res = $file->move(public_path().'/upload',$newfilename);
            //将上传文件的位置返回给客户端
            return '/upload/'.$newfilename;
       }
    }

    /**
     * 将数据表的对应字段的内容写入config目录下的webconfig.php文件 
    */
    public function putContent()
    {
        //1.从数据库中读取相关内容数据
        $content = Config::lists('conf_content','conf_name')->all();
        //dd($content);
        //数组不能直接写入文件，向文件中只能写字符(数组格式的字符串)
        //将数组变成字符串
        $str = '<?php return '.var_export($content,true).';';
        //2.创建webconfig.php文件
        //3.将数据写入webconfig.php文件
        file_put_contents(config_path().'/webconfig.php',$str);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //获取网站标题
       //$conf_title= Config::where('conf_name','web_title')->first()->conf_content;
       //获取网站配置数据
       $data = Config::orderBy('conf_order','asc')->get();
       //dd($data);
       //对返回的网站配置数据进行格式化(内容字段,根据内条记录的类型,显示对应类型的标签)
       foreach($data as $v){
            //不同的记录类型作不同的处理
            switch($v->field_type){
                //如果此条记录的类型是文本框，内容字段应该返回这样的值
                //<input type="text"  name="conf_title"  class="layui-input" value="">
                case 'input':
                    $v->conf_content = '<input type="text"  name="conf_content[]"  class="layui-input" value="'.$v->conf_content.'">';
                    break;
                //如果此条记录的类型是文本域，内容字段应该返回这样的值
                //<textarea name="conf_tips" class="layui-textarea" value="">
                case 'textarea':
                    $v->conf_content ='<textarea name="conf_content[]" class="layui-textarea">'.$v->conf_content.'</textarea>';
                    break;
                //如果此条记录的类型是单选按钮，内容字段应该返回这样的值
                //<input type="radio" name="conf_content" value="1" title="开启">
                //<input type="radio" name="conf_content" value="0" title="开启">
                case 'radio':
                    //存放最终的结果
                    $str = '';
                    //  1|开启,0|关闭========》
                    //  [
                    //     0=> '1|开启',
                    //     1=>'0|关闭'
                    //  ]
                  $arr = explode(',',$v->field_value);
                  foreach ($arr as $n=>$m){
                    $r = explode('|',$m);
                    //  $r=[
                    //      0=>1,
                    //      1=>'开启'
                    //  ]
                    //判断哪一个按钮被选中
                     $c = ($v->conf_content == $r[0]) ? 'checked' : '';
                     $str.= '<input type="radio" name="conf_content[]" '.$c.' value="'.$r[0].'" title="'.$r[1].'" >'.$r[1].'&nbsp;&nbsp;&nbsp;&nbsp;';
                  }
                    $v->conf_content = $str;
                    break;
                //如果此条记录的类型是图片，内容字段应该返回这样的值
                //<img src="" alt="">
                case 'img':
                $v->conf_content ='<img src="'.$v->conf_content.'">';
                break;
            } 
       }
       // return view('admin/config/list',compact('data','conf_title'));
       return view('admin/config/list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin/Config/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        if($input['field_type'] == 'img'){
             $input['conf_content']=$input['conf_contents'];
        }
        unset($input['conf_contents']);
        //dd($input);
        $res = Config::create($input);
        if($res){
            //如果网站配置添加成功，调用putContent()将数据同步到webconfig.php文件
            $this->putContent();
            return redirect('admin/config');
        }else{
            return back();
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
        //根据id获取要修改的用户
        $config = Config::findOrFail($id);
        return view('Admin/Config/edit')->with('config',$config);
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

        //根据id,获取要修改的配置
        $config = Config::find($id);
        //将配置的相关属性修改为配置提交的值
        $input = $request->all(); 
        if(!empty($input['conf_contents'])){
            $input['conf_content']=$input['conf_contents'];
        }
        //return $input;
        $res = $config->update(['conf_title'=>$input['conf_title'],'conf_content'=>$input['conf_content']]);
        if($res){
            //如果网站配置添加成功，调用putContent()将数据同步到webconfig.php文件
            $this->putContent();
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //找到要删除的记录，并删除
        $res = Config::find($id)->delete();
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

    public function changeContent(Request $request)
    {
        $input = $request->all();
        dd($input);
        // DB::beginTransaction();
        // try{
        //     //根据id，遍历所有的记录
        //     foreach($input['conf_id'] as $k=>$v){
        //         //根据当前遍历的id,获取网站配置记录
        //         $conf = Config::find($v);
        //         //执行修改操作
        //         $conf->update(['conf_content'=>$input['conf_content'][$k]]);
        //         DB::table('config')->where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
        //     }
        //     //如果所有的操作成功，提交事务
        //     DB::commit();
        //     //如果网站配置添加成功，调用putContent()将数据同步到webconfig.php文件
        //     $this->putContent();
        //     return redirect('admin/config');
        // }catch(Exception $e){
        //     DB::rollBack();
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // } 
    }
}
