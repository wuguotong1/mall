<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <form class="layui-form" id="art_form" >
           <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_cate_name" name="conf_name" required=""
                           autocomplete="off" class="layui-input" value="{{$config->conf_name}}" disabled>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>标题
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_cate_name" name="conf_title" required=""
                  autocomplete="off" class="layui-input" value="{{$config->conf_title }}">
                  <input type="hidden" name="conf_id" value="{{$config->conf_id}}">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red"></span>
              </div>
          </div>
          <div class="layui-form-item">
                <label for="L_cate_title" class="layui-form-label">
                    <span class="x-red">*</span>内容
                </label>
                <div class="layui-input-block">
                    <input type="text" id="L_cate_title" name="conf_content" required=""
                           autocomplete="off" class="layui-input" value="{{$config->conf_content}}">
                </div>
            </div>
          <div class="layui-form-item">
                <label for="L_art_editor" class="layui-form-label">
                    <span class="x-red">*</span>Logo
                </label>
                <div class="layui-input-inline">
                    <input type="file" id="file_upload" name="file_upload" value="{{$config->conf_content}}">
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
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="edit" lay-submit="">
                  修改
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
          nikename: function(value){
            if(value.length < 5){
              return '昵称至少得5个字符啊';
            }
          }
          ,pass: [/(.+){6,12}$/, '密码必须6到12位']
          ,repass: function(value){
              if($('#L_pass').val()!=$('#L_repass').val()){
                  return '两次密码不一致';
              }
          }
        });

        //监听提交
        form.on('submit(edit)', function(data){
          console.log(data.field);
            //获取 要修改的用户的ID
            var conf_id = $("input[name='conf_id']").val();
            $.ajax({
                type : "PUT", //提交方式
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : '/admin/config/'+conf_id,//路径
                data : data.field,//数据，这里使用的是Json格式进行传输
                dataType : "Json",
                success : function(result) {//返回数据根据结果进行相应的处理
                    console.log(result);
                    // 如果ajax的返回数据对象的status属性值是0，表示用户添加成功；弹添加成功的提示信息
                    if(result.status == 0){
                        layer.alert(result.msg, {icon: 6},function () {
                            //刷新父页面
                            parent.location.reload();
                        });
                    }else{
                        layer.alert(result.msg, {icon: 6},function () {
                            parent.location.reload();
                        });
                    }
                }
            });



            console.log(data);
            //发异步，把数据提交给php

            return false;
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