<!DOCTYPE html>
<html>  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
      <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
      <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css') }}">
      <script type="text/javascript" src="/admin/js/jquery-3.3.1.min.js"></script>
      <script src="{{ asset('admin/lib/layui/layui.js') }}" charset="utf-8"></script>
      <script type="text/javascript" src="{{ asset('admin/js/xadmin.js') }}"></script>
  </head>
  
  <body>
    <div class="x-body">
        <form class="layui-form">
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>用户名
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_username" name="username" required="" lay-verify="nikename"
                  class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_pass" class="layui-form-label">
                  <span class="x-red">*</span>密码
              </label>
              <div class="layui-input-inline">
                  <input type="password" id="L_pass" name="password" required="" lay-verify="pass"
                  class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  6到16个字符
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
                  <span class="x-red">*</span>确认密码
              </label>
              <div class="layui-input-inline">
                  <input type="password" id="L_repass" name="repass" required="" lay-verify="repass"
                  class="layui-input">
              </div>
          </div>
          <div class="layui-form-item"> 
              <label for="L_repass" class="layui-form-label">
                  <span class="x-red">*</span>权限
              </label> 
              <div class="layui-input-inline"> 
              <span class="select-box"> 
                <select class="select" name="auth" size="1"> 
                  <option value="0">普通管理员</option>
                  <option value="1">特级管理员</option>
                  <option value="2">超级管理员</option> 
                </select> 
            </span> 
            </div> 
          </div>
          <div class="layui-form-item">
              <label for="phone" class="layui-form-label">
                  <span class="x-red">*</span>手机
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="phone" name="phone" required="" lay-verify="phone"
                  class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>邮箱
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_email" name="email" required="" lay-verify="email"
                  class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>qq
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_email" name="qq" required="" lay-verify="email"
                  class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  增加
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
      form.on('submit(add)', function(data){

            $.ajax({
               type : "POST", //提交方式
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               url : '/admin/index',//路径
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
   </body>
</html>