@extends('admin.layout.index')
@section('style')


@endsection
@section('content')
    <div class="x-body">
        <form id="art_form" class="layui-form" action="{{ url('admin/goods/storeDetail') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="gid" value="{{ $id }}">
            <div class="layui-form-item">
                <label for="L_art_title" class="layui-form-label">
                    <span class="x-red">*</span>商品数目
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_art_title" name="num" required=""
                           autocomplete="off" class="layui-input">

                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_art_editor" class="layui-form-label">
                    <span class="x-red">*</span>商品颜色
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_art_editor" name="color" required=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_art_editor" class="layui-form-label">
                    <span class="x-red">*</span>商品容量
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_art_editor" name="attr" required=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">
                    <span class="x-red">*</span>商品描述
                </label>
                <div class="layui-input-block">
                    <textarea name="content" placeholder="请输入内容" class="layui-textarea"></textarea>
                </div>
            </div>

            {{--<div class="layui-form-item">--}}
            {{--<label for="L_pass" class="layui-form-label">--}}
            {{--<span class="x-red">*</span>商品详情描述--}}
            {{--</label>--}}
            {{--<div class="layui-input-block">--}}
            {{--<textarea name="contents" placeholder="请输入内容" class="layui-textarea"></textarea>--}}
            {{--</div>--}}
            {{--</div>--}}


            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button  class="layui-btn" lay-filter="add" lay-submit="">
                    增加详情
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