@extends('admin.layout.index')

@section('content')
    <div class="x-body">
        <form id="art_form" class="layui-form" action="{{ url('admin/goods') }}" method="post" enctype="multipart/form-data">
            <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="x-red">*</span>分类
                </label>
                <div class="layui-inline">
                    {{ csrf_field() }}
                    {{--将表单的提交方式改成PUT--}}
                    {{--                  {{ method_field('PUT') }}--}}
                    {{--<input type="hidden" name="_method" value="PUT">--}}
                    <select name="cid">
                        {{--<option value="0">请选择分类</option>--}}
                        @foreach($cates as $v)
                            <option value="{{ $v->id }}">{{ $v->type_name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="layui-form-item">
                <label for="L_art_title" class="layui-form-label">
                    <span class="x-red">*</span>商品名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_art_title" name="goods_title" required=""
                           autocomplete="off" class="layui-input">

                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_art_editor" class="layui-form-label">
                    <span class="x-red">*</span>商品原价
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_art_editor" name="old_price" required=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_art_editor" class="layui-form-label">
                    <span class="x-red">*</span>商品现价
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_art_editor" name="new_price" required=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="x-red">*</span>商品描述
                </label>
                <div class="layui-input-block">
                    <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_art_editor" class="layui-form-label">
                    <span class="x-red">*</span>缩略图
                </label>
                <div class="layui-input-inline">
                    <input type="file" id="file_upload" name="file_upload" value="">
                </div>
                <script type="text/javascript">
                    $(function () {
                        $("#file_upload").change(function () {
                            uploadImage();
                        })
                    })
                    function uploadImage() {
//  判断是否有选择上传文件
                        var imgPath = $("#file_upload").val();
                        if (imgPath == "") {
                            alert("请选择上传图片！");
                            return;
                        }
                        //判断上传文件的后缀名
                        var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                        if (strExtension != 'jpg' && strExtension != 'gif'
                            && strExtension != 'png' && strExtension != 'bmp') {
                            alert("请选择图片文件");
                            return;
                        }
                        //将整个表单打包进formData
                        var formData = new FormData($('#art_form')[0]);

                        //只将上传文件打包进formData
                        // var formData = new FormData();
                        // formData.append('fileupload',$('#file_upload')[0].files[0]);
                        //{{--formData.append('_token','{{ csrf_token() }}');--}}
                        $.ajax({
                            type: "POST",
                            url: "/admin/upload",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: formData,
                            contentType: false,
                            processData: false,
                            async:true,
                            cache:false,
                            success: function(data) {

                                $('#thumb').attr('src',data);
                                //显示上传到OSS上的图片
                                // $('#thumb').attr('src','oss的域名'+data);
                                //{{--$('#thumb').attr('src','{{ env('ALIOSS_DOMAIN') }}'+data);--}}
                                $('#art_thumb').val(data);
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                alert("上传失败，请检查网络后重试");
                            }
                        });
                    }
                </script>

            </div>
            <div class="layui-form-item">
                <label for="L_art_tag" class="layui-form-label">
                    <span class="x-red"></span>
                </label>
                <div class="layui-input-block">
                    <input type="hidden" name="photo" id="art_thumb" value="">
                    {{--上传成功后显示上传图片--}}
                    <img src="" id="thumb" alt="" style="width:100px;">
                </div>
            </div>


            <div class="layui-form-item">

                <div class="layui-input-block">
                    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
                    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
                    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
                    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
                    <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

                    <script name="art_content" id="editor" type="text/plain" style="width:700px;height:500px;"></script>

                    <script type="text/javascript">

                    //实例化编辑器
                    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                    var ue = UE.getEditor('editor');
                    </script>
                </div>

            </div>

            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button  class="layui-btn" lay-filter="add" lay-submit="">
                    增加商品
                </button>
            </div>
        </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
            var form = layui.form
                ,layer = layui.layer;

            //自定义验证规则
            form.verify({

            });

            //监听提交
            form.on('submit(add)', function(data){

            });
        });
    </script>

@endsection