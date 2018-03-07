@extends('admin.layout.index')

@section('content')
    <div class="x-body">
        <form class="layui-form" action="{{ url('admin/cate') }}" method="post">
            <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="x-red">*</span>父级分类
                </label>
                <div class="layui-inline">
                    {{ csrf_field() }}
                    <select name="pid">
                        <option value="0">请选择一级分类</option>
                        @foreach($cateone as $v)
                            <option value="{{ $v->id }}">{{ $v->type_name }}</option>
                        @endforeach
                    </select>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*不选为顶级分类
                </div>

            </div>
            <div class="layui-form-item">
                <label for="L_cate_name" class="layui-form-label">
                    <span class="x-red">*</span>分类名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_cate_name" name="type_name" required=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>


            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button  class="layui-btn" lay-filter="add" lay-submit="">
                    添加分类
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
    <script>var _hmt = _hmt || []; (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();</script>
@endsection