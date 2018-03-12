@extends('admin.layout.index')


@section('content')
<!-- 显示错误 -->

    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">

          <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='{{ url('Admin/welcome') }}' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
          </div>
        </div>
    </div>
    <div class="page-content-bg"></div>

@endsection