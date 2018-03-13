@extends('admin.layout.index')

@section('css')
<link rel="stylesheet" type="text/css" href="/fulei/css/page_page.css">
@endsection

@section('content')
<!DOCTYPE html>
<html>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a>
          <cite>{{$title}}</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      
      <xblock>
        <button class="layui-btn layui-btn-info"><i class="layui-icon"></i>评论列表</button>
        
        <span class="x-right" style="line-height:40px">共有 {{$count}} 条评论</span>
      </xblock>
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so" action="/admin/index" method="get">
          
          <input type="text" name="search"  placeholder="请搜索任意字段" autocomplete="off" class="layui-input" value="{{$search or ''}}" style="margin-left:850px">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <table class="layui-table">
        <thead>
          <tr>
             <tr>
                        <th  class="sorting_asc" style="width: 25px;">评论ID</th>
                        <th  class="sorting_asc" style="width: 25px;">用户名</th>
                        <th  class="sorting_asc" style="width: 60px;">商品名</th>
                        <th  class="sorting_asc" style="width: 50px;">评论标题</th>
                        <th  class="sorting_asc" style="width: 140px;">评论内容</th>
                        <th  class="sorting_asc" style="width: 100px;">评论时间</th>
                        <th  class="sorting_asc" style="width: 18px;">评分</th>
                        <th  class="sorting" style="width: 210px;text-align:center">操作</th> 
                    </tr></tr>
        </thead>
        <tbody>
          @foreach($data as $key=>$v)
                    <tr>
                        <td>{{ $v->id }}</td>
                        <td>{{ $v->uid }}</td>
                        <td>{{ $v->item }}</td>
                        <td>{{ $v->title }}</td>
                        <td>{{ $v->comment }}</td>
                        <td>{{ $v->created_at }}</td>
                        <td>{{ $v->rate }}</td>
                        <td>
            <form action="/admin/index/{{$v->id}}" method="post" style="display:inline">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <input type="submit"  value="删除" class="layui-btn layui-btn-danger">
    </form>

    <a href="/admin/index/{{$v->id}}/edit" class="layui-btn layui-btn-warning">修改</a>

    <form action="/admin/index/{{$v->id}}" method="get" style="display:inline">
        <input type="submit" class="layui-btn layui-btn-info" value="查看并回复">
    </form>
    </td>
          </tr>
@endforeach
        </tbody>
      </table>


      <div class="page" >
       {!! $data->render() !!}
      </div>

    </div>
    <script>
      layui.use('laydate', function(){
        var laydate = layui.laydate;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

       /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要停用吗？',function(index){

              if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

              }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
              }
              
          });
      }

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }



      function delAll (argument) {

        var data = tableCheck.getData();
  
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>

@endsection






