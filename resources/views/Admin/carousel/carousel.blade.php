@extends('admin.Layout.index')

@section('content')
 <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">广告管理</a>
        <a>
          <cite>轮播图列表</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <a href="/admin/carousel/create" class="layui-btn"><i class="layui-icon"></i>添加</a>

        <form class="layui-form layui-col-md12 x-so" style="width:300px; float:right;" method="get" action="/admin/carousel">
        {{csrf_field()}}
          <cite>搜索：</cite>
          <input type="text" name="search"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>

      </xblock>
      <div style="height:345px;">
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>标题</th>
            <th>图片</th>
            <th style="width:180px;">加入时间</th>
            <th style="width:120px;">状态</th>
            <th>操作</th>
        </thead>
        <tbody>
        @foreach($data as $key => $value)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="{{$value->id}}"><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$value->id}}</td>
            <td>{{$value->title}}</td>
            <td style="width:130px; padding:1px;">&nbsp;&nbsp;
              <img src="{{$value->path}}" title="{{$value->title}}" style="height:70px; width:180px;">
            </td>
            <td>{{$value->created_at}}</td>
            <td class="td-status">
            @if($value->status == 0)
              <span class="layui-btn layui-btn-normal layui-btn-mini layui-btn-disabled">已停用</span>
			      @else
              <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
            </td>
            @endif

            <td class="td-manage">
            @if($value->status == 0)
              <a onclick="member_start(this,'{{ $value->id }}')" href="javascript:;" data-id="{{ $value->status }}" title="启用">
                <i class="layui-icon">&#xe62f;</i>
              </a>
            @else
              <a onclick="member_stop(this,'{{ $value->id }}')" href="javascript:;" data-id="{{ $value->status }}" title="停用">
                <i class="layui-icon">&#xe601;</i>
              </a>
            @endif
            &nbsp;&nbsp;
              <a href="/admin/carousel/{{$value->id}}/edit" title="编辑">
                <i class="layui-icon">&#xe642;</i>
              </a>
            &nbsp;&nbsp;
              <a onclick="carousel_del(this,'{{ $value->id }}')" href="javascript:;" title="删除">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
      <div>
          <span class="x-right" style="float:left; display:inline; margin-top:8px;">共有数据：{{$count}} 条</span>
      </div>
      
      <div class="page" style="float:right; display:inline; margin-top:8px;">
          <div class="text-right" style="margin-top:1px;">
            {!! $data->appends(['search'=>$search])->render() !!}
          </div>
      </div>
    </div>
    <script>
       /*轮播图-停用*/
      function member_stop(obj,id){
      	  // 获取当前轮播图状态
          var status = $(obj).attr('data-id');
          layer.confirm('确认要停用吗？',function(index){
              if($(obj).attr('title')=='停用'){
                //发异步把用户状态进行更改
                $.ajax({
                      type : "GET", //提交方式
                      url : '/change',//路径
                      data : {"id":id,"status":status},//数据，这里使用的是Json格式进行传输
                      dataType : "Json",
                      success : function(result) {//返回数据根据结果进行相应的处理
                      	$(obj).attr('title','启用')
		                  $(obj).find('i').html('&#xe62f;');

		                  $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
		                  layer.msg('已停用!',{icon: 5,time:1000});
		                  location.reload();
                      }
                });
              }
          });
      }

      /*轮播图-启用*/
      function member_start(obj,id){
      	// 获取当前轮播图状态
        var status = $(obj).attr('data-id');
      	layer.confirm('确认要启用吗？',function(index){
      	   if($(obj).attr('title')=='启用'){
      	   	//发异步把用户状态进行更改
      	   	$.ajax({
	              type : "GET", //提交方式
	              url : '/change',//路径
	              data : {"id":id,"status":status},//数据，这里使用的是Json格式进行传输
	              dataType : "Json",
	              success : function(result) {//返回数据根据结果进行相应的处理
	              	$(obj).attr('title','停用')
	                $(obj).find('i').html('&#xe601;');

	                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
	                layer.msg('已启用!',{icon: 6,time:1000});
	                location.reload();
                  }
            });
           }
        });
      }

      /*用户-删除*/
      function carousel_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){

              //发异步删除数据
              $.post('{{ url('admin/carousel/') }}/'+id,{"_token":"{{csrf_token()}}","_method":"delete","id":id},function(data){
                  if(data.status == 0){
                      $(obj).parents("tr").remove();
                      layer.msg('已删除!',{icon:1,time:1000});
                      location.reload(true);
                  }else{
                      layer.msg('删除失败!',{icon:1,time:1000});
                      parent.location.reload(true);
                  }
              });
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }
      /*轮播图的批量删除*/
      function delAll (argument) {
          var ids =   [];
          $('.layui-form-checked').not('.header').each(function(i,v){
             ids.push($(v).attr('data-id'));
          })
          //执行ajax
          $.get('/carousel/dellall',{"ids":ids},function(data){
              if(data.status == 0){
                  layer.msg('删除成功', {icon: 1});
                  $(".layui-form-checked").not('.header').parents('tr').remove();
                  document.location="/admin/carousel";
              }else{
                  layer.msg('删除失败', {icon: 1});
                  location.reload(true);
              }
          });
      }
    </script>
@endsection