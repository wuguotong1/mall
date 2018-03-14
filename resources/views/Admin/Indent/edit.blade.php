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
    <script type="text/javascript" src="/admin/js/jquery-3.2.1.min.js"></script>
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
    <form id="art_form" class="layui-form" action="{{ url('admin/goods/') }}" method="post" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                <span class="x-red">*</span>商品订单编号
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_email" value="{{ $data->number }}" name="number" required=""
                       autocomplete="off" class="layui-input" disabled>
                <input type="hidden" name="id" value="{{ $data->id }}">
            </div>

        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>商品名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" value="{{ $data->Goods()[0]['goods_title'] }}" name="goods_title" required=""
                       autocomplete="off" class="layui-input" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>商品价格
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" value="{{ $data->goods_price }}" name="goods_price" required=""
                       autocomplete="off" class="layui-input" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>商品数量
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" value="{{ $data->goods_num }}" name="goods_num" required=""
                       autocomplete="off" class="layui-input" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>运费
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" value="{{ $data->carriage }}" name="carriage" required=""
                       autocomplete="off" class="layui-input" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>收货人姓名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" value="{{ $data->username }}" name="username" required=""
                       autocomplete="off" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>收货地址
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" value="{{ $data->address }}" name="address" required=""
                       autocomplete="off" class="layui-input" >
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
            //获取 要修改的用户的ID
            var id = $("input[name='id']").val();
            $.ajax({
                type : "PUT", //提交方式
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : '/admin/indent/'+id,//路径
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