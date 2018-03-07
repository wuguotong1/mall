@extends('admin.layout.index')


@section('content')
<!-- 显示错误 -->

<div class="x-body">
  <form class="layui-form">
    <div class="layui-form-item">
      <label for="L_email" class="layui-form-label">
        <span class="x-red">*</span>邮箱
      </label>
      <div class="layui-input-inline">
        <input type="text" id="L_email" name="email" required="" lay-verify="email"
               autocomplete="off" class="layui-input">
      </div>
      <div class="layui-form-mid layui-word-aux">
        <span class="x-red">*</span>
      </div>
    </div>
    <div class="layui-form-item">
      <label for="L_username" class="layui-form-label">
        <span class="x-red">*</span>用户名
      </label>
      <div class="layui-input-inline">
        <input type="text" id="L_username" name="user_name" required="" lay-verify="nikename"
               autocomplete="off" class="layui-input">
      </div>
    </div>
    <div class="layui-form-item">
      <label for="L_pass" class="layui-form-label">
        <span class="x-red">*</span>密码
      </label>
      <div class="layui-input-inline">
        <input type="password" id="L_pass" name="pass" required="" lay-verify="pass"
               autocomplete="off" class="layui-input">
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
               autocomplete="off" class="layui-input">
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
                url : '/admin/user',//路径
                data : data.field,//数据，这里使用的是Json格式进行传输
                dataType : "Json",
                success : function(result) {//返回数据根据结果进行相应的处理
                    console.log(result);
                    // 如果ajax的返回数据对象的status属性值是0，表示用户添加成功；弹添加成功的提示信息
                    if(result.status == 0){
                        layer.alert(result.msg, {icon: 6},function () {
                            // // 获得frame索引
                            // var index = parent.layer.getFrameIndex(window.name);
                            // //关闭当前frame
                            // parent.layer.close(index);

                            //刷新父页面
                            parent.location.reload();
                        });
                    }else{
                        layer.alert(result.msg, {icon: 6},function () {
                            // 获得frame索引
                            // var index = parent.layer.getFrameIndex(window.name);
                            // //关闭当前frame
                            // parent.layer.close(index);

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

@endsection