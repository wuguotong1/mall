@extends('Admin.Layout.index')
@section('content')
<div class="x-nav">
    <span class="layui-breadcrumb">
      <a href="">首页</a>
      <a href="">网站配置管理</a>
      <a>
        <cite>网站配置列表</cite></a>
    </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
      <i class="layui-icon" style="line-height:30px">ဂ</i>
    </a>
</div>
<div class="x-body" style="height:300px;">
  <div class="layui-row">
  </div>
  <form action="{{ url('admin/config/changecontent') }}" method="post">
    {{ csrf_field() }}
    <table class="layui-table">
      <thead>
        <tr>
          <th style="width:20px;">排序</th>
          <th style="width:20px;">ID</th>
          <th style="width:100px;">标题</th>
          <th style="width:100px;">名称</th>
          <th style="width:420px;">内容</th>
          <th style="width:50px;">操作</th></tr>
      </thead>
      <tbody>
      @foreach($data as $v)
        <tr>
          <td>
            <div class="layui-input-inline">
              <input onchange="changeOrder(this,{{ $v->conf_id }})" style="width: 40px;" type="text" id="L_cate_name" name="cate_order" value="{{ $v->conf_order }}" class="layui-input">
            </div>
          </td>
          <input type="hidden" value="{{ $v->conf_id}}" name="conf_id[]">
          <td>{{ $v->conf_id}}</td>
          <td>{{ $v->conf_title }}</td>
          <td>{{ $v->conf_name}}</td>
          <td>{!! $v->conf_content !!}</td>
          @if($v->field_type == 'img')
              <input type="hidden" value="{{ $v->conf_content }}" name="conf_content[]">
          @endif
          <td class="td-manage">
            <a title="编辑"  onclick="x_admin_show('编辑','{{url('admin/config/'.$v->conf_id.'/edit')}}',600,400)" href="javascript:;">
              <i class="layui-icon">&#xe642;</i>
            </a>
            <a title="删除" onclick="member_del(this,'{{ $v->conf_id }}')" href="javascript:;">
              <i class="layui-icon">&#xe640;</i>
            </a>
          </td>
        </tr>
      @endforeach
      <tr>
        <td colspan="6">
          <button class="layui-btn" lay-filter="add" lay-submit="">添加</button>
        </td>
      </tr>
      </tbody>
    </table>
  </form>
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
      form.on('submit(add)', function(data){
          // console.log(11111);
          // return false;
      });

  });

  //修改排序
  /*
  * @param obj 当前的文本框元素
  * @param id  当前分类记录的ID
  * */
  function changeOrder(obj,id) {
      // 文本框的值，也就是排序值
      var order = $(obj).val();
      //通过ajax 修改记录的排序
      $.post('/admin/cate/changeorder',{'order':order,'id':id,'_token':"{{ csrf_token() }}"},function(data){
          if(data.status == 0){
              // 修改成功
              layer.msg(data.msg,{icon: 6,time:1000});
              // 刷新页面
              location.reload();
          }else{
              layer.msg(data.msg,{icon: 5,time:1000});
          }
      });
  }
  
   /*用户-停用*/
  function member_stop(obj,id){
      // 获取当前用户状态
      var status = $(obj).attr('data-id');
      layer.confirm('确认要停用吗？',function(index){
          if($(obj).attr('title')=='启用'){

            //发异步把用户状态进行更改
              $.ajax({
                  type : "GET", //提交方式
                  url : '/admin/user/changestate',//路径
                  data : {"id":id,"status":status},//数据，这里使用的是Json格式进行传输
                  dataType : "Json",
                  success : function(result) {//返回数据根据结果进行相应的处理
                    if(result.status == 0){
                        $(obj).attr('title','停用')
                        $(obj).find('i').html('&#xe62f;');

                        $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                        layer.msg('已停用!',{icon: 5,time:1000});
                    }else{
                        layer.msg('状态修改失败!',{icon: 5,time:1000});
                    }

                  }
              });
          }else{
              if(result.status == 0){
                  $(obj).attr('title','启用')
                  $(obj).find('i').html('&#xe601;');

                  $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                  layer.msg('已启用!',{icon: 5,time:1000});
              }else{
                  layer.msg('状态修改失败!',{icon: 5,time:1000});
              }

          }
          
      });
  }

  /*用户-删除*/
  function member_del(obj,id){
      layer.confirm('确认要删除吗？',function(index){
          //发异步删除数据
          // $.post('URL地址'.'携带的参数',成功后的闭包函数)
          $.post('{{ url('admin/config/') }}/'+id,{"_token":"{{csrf_token()}}","_method":"delete","id":id},function(data){
              //console.log(data);
              if(data.status == 0){
                  $(obj).parents("tr").remove();
                  layer.msg('已删除!',{icon:1,time:1000});
                  //刷新父页面
                  location.reload(true);
              }else{
                  layer.msg('删除失败!',{icon:1,time:1000});
                  location.reload(true);
              }
          });

      });
  }

  function delAll (argument) {
    //   获取选中的记录,获取记录的id
    var ids =   [];

      $('.layui-form-checked').not('.header').each(function(i,v){
         ids.push($(v).attr('data-id'));
      })
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
  }
</script>
    
@endsection