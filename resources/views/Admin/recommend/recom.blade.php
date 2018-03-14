@extends('admin.Layout.index')

@section('content')
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">广告管理</a>
        <a>
          <cite>推荐位列表</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <a href="/admin/advert/add" class="layui-btn"><i class="layui-icon"></i>添加</a>

        <form class="layui-form layui-col-md12 x-so" style="width:300px; float:right;" method="get" action="/admin/advert">
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
            <th style="width:60px;">排序</th>
            <th>商品分类</th>
            <th>商品名称</th>
            <th>商品图片</th>
            <th>商品描述</th>
            <th>加入时间</th>
            <th>状态</th>
            <th>操作</th>
        </thead>
        <tbody>
        @foreach($data as $key=>$value)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id="{{$value->id}}"><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$value->id}}</td>
            <td style="height:45px;">
            	<div style="background-color:#99CCFF; margin-bottom:10px; width:50px; border-radius:15px; @if($value->sort == 1) display:none @endif">
            	  <a href="javascript:;" onclick="changeSort(this,{{$value->id}})" sort="{{$value->sort}}" mark="1">
              		<i class="layui-icon">&#xe619;</i>
              		<span>上移</span>
            	  </a>
            	</div>
            	<div style="background-color:#FFCC99; width:50px; border-radius:15px; @if($value->sort == $count) display:none @endif">
            	  <a href="javascript:;" onclick="changeSort(this,{{$value->id}})" sort="{{$value->sort}}" mark="0">
              		<i class="layui-icon">&#xe61a;</i>
              		<span>下移</span>
            	  </a>
            	</div>
            </td>

            <td>{{$value->cate['type_name']}}</td>
 
            <td>{{$value->name}}</td>
            <td style="width:120px; padding:1px;">&nbsp;&nbsp;
              <img src="{{$value->recom_thumb}}" >
            </td>
            <td>{{ $value->desc }}</td>
            <td>{{ $value->created_at }}</td>
			
            <td class="td-status">
            @if($value->status == 0)
              <span class="layui-btn layui-btn-normal layui-btn-mini layui-btn-disabled">已停用</span>
			      @else
              <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
            </td>
			      @endif
			
            <td class="td-manage">
            @if($value->status == 1)
              <a onclick="member_stop(this,'{{ $value->id }}')" href="javascript:;" data-id="{{ $value->status }}" title="停用">
                <i class="layui-icon">&#xe601;</i>
              </a>
			   @else
   			  <a onclick="member_start(this,'{{ $value->id }}')" href="javascript:;" data-id="{{ $value->status }}" title="启用">
                 <i class="layui-icon">&#xe62f;</i>
               </a>
			   @endif
              <a href="/admin/advert/edit/{{$value->id}}" title="编辑">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <a href="/admin/advert/delete/{{$value->id}}" title="删除">
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
        <div>
          <div class="text-right" style="margin-top:1px;">
		    	{!! $data->appends(['search'=>$search])->render() !!}
		    </div>
        </div>
      </div>
    </div>
    <script>
       /*推荐位-停用*/
      function member_stop(obj,id){
      	  // 获取当前用户状态
          var status = $(obj).attr('data-id');
          layer.confirm('确认要停用吗？',function(index){
              if($(obj).attr('title')=='停用'){
                //发异步把用户状态进行更改
                $.ajax({
                      type : "GET", //提交方式
                      url : '/admin/advert/change',//路径
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

      /*推荐位-启用*/
      function member_start(obj,id){
      	// 获取当前用户状态
        var status = $(obj).attr('data-id');
      	layer.confirm('确认要启用吗？',function(index){
      	   if($(obj).attr('title')=='启用'){
      	   	//发异步把用户状态进行更改
      	   	$.ajax({
	              type : "GET", //提交方式
	              url : '/admin/advert/change',//路径
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

      /*修改排序-向上*/
      function changeSort(obj,id){
         //获取当前推荐位的排序
         var sort = $(obj).attr('sort');
         var mark = $(obj).attr('mark');
         //发送ajax修改这个排序
         $.post('/advert/sort',{'sort':sort,'mark':mark,'id':id,'_token':"{{csrf_token()}}"},function(data){
             if(data.status == 0){
               //修改成功
               layer.msg(data.mag,{icon:6,time:1000});
               location.reload();
             }else{
               layer.msg(data.msg,{icon:5,time:1000});
               location.reload();
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
      /*推荐位的批量删除*/
      function delAll (argument) {
          var ids =   [];
          $('.layui-form-checked').not('.header').each(function(i,v){
             ids.push($(v).attr('data-id'));
          })

          $.get('/admin/advert/delall',{"ids":ids},function(data){
              if(data.status == 0){
                  layer.msg('删除成功', {icon: 1});
                  $(".layui-form-checked").not('.header').parents('tr').remove();
                  document.location="/admin/advert/index";
              }else{
                  layer.msg('删除失败', {icon: 1});
                  location.reload(true);
              }
          });
      }
    </script>
@endsection