<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>添加网站配置</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
      <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
      <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css') }}">
      <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
      <script src="{{ asset('admin/lib/layui/layui.js') }}" charset="utf-8"></script>
      <script type="text/javascript" src="{{ asset('admin/js/xadmin.js') }}"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="x-body">
        <form id="art_form" class="layui-form" action="{{ url('admin/config') }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="layui-form-item">
              <label for="L_cate_name" class="layui-form-label">
                  <span class="x-red">*</span>标题
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_cate_name" name="conf_title" required=""
                  autocomplete="off" class="layui-input">
              </div>
          </div>
            <div class="layui-form-item">
                <label for="L_cate_name" class="layui-form-label">
                    <span class="x-red">*</span>名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_cate_name" name="conf_name" required=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_cate_title" class="layui-form-label">
                    <span class="x-red">*</span>内容
                </label>
                <div class="layui-input-block">
                    <input type="text" id="L_cate_title" name="conf_content" required=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_art_editor" class="layui-form-label">
                    <span class="x-red">*</span>Logo
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
                //判断是否有选择上传文件
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
                    var formData = new FormData($('#art_form')[0]);
                    $.ajax({
                        type: "POST",
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/admin/config/upload",
                        data: formData,
                        contentType: false,
                        processData: false,
                        async:true,
                        cache:false,
                        success: function(data) {
                            $('#thumb').attr('src',data);
                            $('#conf_content').val(data);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert("上传失败，请检查网络后重试");
                        }
                    });
                }
              </script>
            </div>
          <div class="layui-form-item">
                <label for="L_cate_name" class="layui-form-label">
                    <span class="x-red">*</span>
                </label>
                <div class="layui-input-inline">
                    <input type="hidden" name="conf_contents" id="conf_content" value="">
                    <!-- 上传成功后显示上传图片 -->
                    <img src="" id="thumb" alt="" style="width:100px;">
                </div>
          </div>
          <div class="layui-form-item">
              <label for="L_pass" class="layui-form-label">
                  <span class="x-red">*</span>类型
              </label>
                  <div class="layui-input-block">
                      <input type="radio" name="field_type" value="input" title="文本框" checked>
                      <input type="radio" name="field_type" value="textarea" title="文本域">
                      <input type="radio" name="field_type" value="radio" title="单选按钮">
                      <input type="radio" name="field_type" value="img" title="图片">
                  </div>
          </div>
          <div class="layui-form-item">
              <label for="L_pass" class="layui-form-label">
                  <span class="x-red">*</span>类型值
              </label>
                  <div class="layui-input-block">
                    <input type="text" id="L_cate_title" name="field_value" required=""
                           autocomplete="off" class="layui-input"><span class="x-red">*</span>类型之只有在radio的情况下才需要配置，格式是1|开启,0|关闭
                </div>
          </div>
            <div class="layui-form-item">
                <label for="L_cate_title" class="layui-form-label">
                    <span class="x-red">*</span>排序
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_cate_title" name="conf_order" required=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="x-red">*</span>说明
                </label>
                <div class="layui-input-block">
                    <textarea name="conf_tips" placeholder="请输入内容" class="layui-textarea"></textarea>
                </div>
            </div>

          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">添加</button>
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
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>
</html>