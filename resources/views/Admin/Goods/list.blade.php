@extends('admin.layout.index')

@section('content')
    <div class="x-body">
        <div class="layui-row">

        </div>
        <xblock>

            <button class="layui-btn" onclick="x_admin_show('添加用户','{{ url('admin/goods/create') }}',600,800)"><i class="layui-icon"></i>添加</button>
            {{--<span class="x-right" style="line-height:40px">共有数据：88 条</span>--}}
            <form class="layui-form layui-col-md12 x-so" style="width:300px; float:right;" method="get" action="/admin/goods">
                {{csrf_field()}}
                <cite>搜索：</cite>
                <input type="text" name="search"  placeholder="请输入商品名称" autocomplete="off" class="layui-input">
                <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </form>
        </xblock>
        <table class="layui-table">
            <thead>
            <tr>
                <th style="width:50px;">
                    ID
                </th>
                <th style="width:100px;">商品所属分类</th>
                <th>商品名称</th>
                <th>商品颜色</th>
                <th>商品原价</th>
                <th>商品现价</th>
                <th>库存数</th>
                <th>商品属性</th>
                <th>商品描述</th>
                <th>商品图片</th>
                <th>操作</th></tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td>
                        {{ $v['id'] }}
                    </td>
                    <td>{{ $v['type_name'] }}</td>
                    <td>{{ $v['goods_title'] }}</td>
                    <td>{{ $v->detail['color'] }}</td>
                    <td>{{ $v['old_price'] }}</td>
                    <td>{{ $v['new_price'] }}</td>
                    <td>{{ $v->detail['num'] }}</td>
                    <td>{{ $v->detail['attr'] }}</td>
                    <td>{{ $v['desc'] }}</td>
                    <td><img src="{{ $v['photo'] }}" width="50" height="50"></td>

                    <td class="td-manage">
                        <a title="添加详情"  href="{{ url('admin/goods/createdetail/'.$v['id']) }}">
                            <i class="layui-icon">&#xe608;</i>
                        </a>
                        <a title="编辑"  onclick="x_admin_show('编辑','{{url('admin/goods/'.$v['id'].'/edit')}}',600,600)" href="javascript:;">
                            <i class="layui-icon">&#xe642;</i>
                        </a>
                        <a title="删除" onclick="member_del(this,'{{ $v['id'] }}')" href="javascript:;">
                            <i class="layui-icon">&#xe640;</i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="page" style="float:right; display:inline; margin-top:8px;">
        <div>
            <div class="text-right" style="margin-top:1px;">
                {!! $data->appends(['search'=>$search])->render() !!}
            </div>
        </div>
    </div>
    </div>
    <script>
        layui.use(['form','laydate','layer'], function(){
            var laydate = layui.laydate;
            var form = layui.form;
            var layer = layui.layer;

            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });

            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
            });

            //监听提交
            form.on('submit(sreach)', function(data){
                // console.log(11111);
                // return false;layui-layer2
                $('layui').remove();
            });


        });

        /*商品-删除*/
        function member_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                //发异步删除数据
                // $.post('URL地址'.'携带的参数',成功后的闭包函数)
                $.post('{{ url('admin/goods/') }}/'+id,{"_token":"{{csrf_token()}}","_method":"delete","id":id},function(data){

                    if(data.status == 0){

                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                        location.reload(true);
                    }else{
                        layer.msg('删除失败!',{icon:1,time:1000});
                        location.reload(true);
                    }
                });

            });
        }

        function delAll (argument) {

            //var data = tableCheck.getData();
            //   获取选中的记录,获取记录的id
            var ids =   [];

            $('.layui-form-checked').not('.header').each(function(i,v){
                ids.push($(v).attr('data-id'));
            })
            console.log(ids);

            $.get('/admin/user/del',{"ids":ids},function(data){
                if(data.status == 0){
                    layer.msg('删除成功', {icon: 1});
                    $(".layui-form-checked").not('.header').parents('tr').remove();
                    location.reload(true);
                }else{
                    layer.msg('删除失败', {icon: 1});
                    location.reload(true);
                }
            })

            // layer.confirm('确认要删除吗？'+data,function(index){
            //     //捉到所有被选中的，发异步进行删除
            // });
        }
    </script>

@endsection