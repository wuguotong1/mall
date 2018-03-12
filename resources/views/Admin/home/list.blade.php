@extends('Admin.Layout.index')

@section('content')

   <div class="x-body">
      <div class="layui-row">
         <form class="layui-form layui-col-md12 x-so" >
          <div class="layui-inline">
            <select name="num">
              <option value="5" @if($request['num'] == 5)  selected  @endif>5
              </option>
              <option value="10" @if($request['num'] == 10)  selected @endif>10
              </option>
              <option value="15" @if($request['num'] == 15)  selected  @endif>15
              </option>
              <option value="20" @if($request['num'] == 20)  selected  @endif>20
              </option>
            </select>
          </div>
            <input class="layui-input" placeholder="开始日" name="start" id="start">
            <input class="layui-input" placeholder="截止日" name="end" id="end">
            <input type="text" name="keywords1" value="{{$request->keywords1}}" placeholder="请输入用户名" class="layui-input">
            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
         </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加用户','{{url('admin/list/create')}}',600,400)"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：{{$dataa}} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i>1</div>
            </th>
            <th>ID</th>
            <th>用户名</th>
            <th>昵称</th>
            <th>性别</th>
            <th>年龄</th>
            <th>手机</th>
            <th>邮箱</th>
            <th>QQ</th>
            <th>状态</th>
            <th>操作</th></tr>
        </thead>
        <tbody>
        @foreach ($data as $k=>$v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{ $v->id }}'>
              <i class="layui-icon">&#xe605;</i>
              </div>
            </td>
            <td>{{$v->id}}</td>
            <td>{{$v->username}}</td>
            <td>{{$v->users->nikename}}</td>
            <td>{{$v->users->sex}}</td>
            <td>{{$v->users->age}}</td>
            <td>{{$v->users->phone}}</td>
            <td>{{$v->users->email}}</td>
            <td>{{$v->users->QQ}}</td>

            <td class="td-status">
            @if($v->status == 0)
              <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
            @else
              <span class="layui-btn layui-btn-normal layui-btn-mini layui-btn-disabled">已禁用</span>
            @endif
            </td>

            <td class="td-manage">
            @if($v->status == 0)
              <a onclick="member_stop(this,'{{$v->id}}')" href="javascript:;"  title="禁用" data-id="{{ $v->status }}">
                <i class="layui-icon">&#xe601;</i>
              </a>
            @else 
              <a onclick="member_open(this,'{{$v->id}}')" href="javascript:;"  title="启用" data-id="{{ $v->status }}">
                <i class="layui-icon">&#xe601;</i>
              </a>  
            @endif
              <a title="编辑"  onclick="x_admin_show('编辑','{{url('admin/list/'.$v->id.'/edit')}}',600,400)" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <a onclick="x_admin_show('修改密码','{{url('admin/xgmm/'.$v->id.'')}}',600,400)" title="修改密码" href="javascript:;">
                <i class="layui-icon">&#xe631;</i>
              </a>
              <a title="删除" onclick="member_del(this,'{{$v->id}}')" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
        {!! $data->appends($request->all())->render() !!}
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
        // 获取当前用户状态
        var status = $(obj).attr('data-id');
        layer.confirm('确认要停用吗？',function(index){
          if($(obj).attr('title')=='禁用'){
              //发异步把用户状态进行更改
                $.ajax({
                  type : "GET", //提交方式
                  url : '/admin/list/changestate',//路径
                  data : {"id":id,"status":status},//数据，这里使用的是Json格式进行传输
                  dataType : "Json",
                  success : function(result) {
                  //返回数据根据结果进行相应的处理
                    $(obj).attr('title','启用')
                    $(obj).find('i').html('&#xe62f;');

                    $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已禁用');
                    layer.msg('已禁用!',{icon: 5,time:1000});
                    location.reload();
                  }
              });
            } 
        });
      }

      /*用户-启用*/
      function member_open(obj,id){

          // 获取当前用户状态
          var status = $(obj).attr('data-id');
          layer.confirm('确认要启用吗？',function(index){

              if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
               $.ajax({
                  type : "GET", //提交方式
                  url : '/admin/list/changestate',//路径
                  data : {"id":id,"status":status},//数据，这里使用的是Json格式进行传输
                  dataType : "Json",
                  success : function(result) {
                  //返回数据根据结果进行相应的处理
                     $(obj).attr('title','禁用')
                     $(obj).find('i').html('&#xe62f;');

                     $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已启用');
                     layer.msg('已启用!',{icon: 6,time:1000});
                     location.reload();
                  }
               });
            } 
         });
      }

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              // $.post('URL地址'.'携带的参数',成功后的闭包函数)
              $.post('{{ url('admin/list/') }}/'+id,{"_token":"{{csrf_token()}}","_method":"delete","id":id},function(data){
                  if(data.status == 0){
                      $(obj).parents("tr").remove();
                      layer.msg('已删除!',{icon:1,time:1000});
                      location.reload(true);
                      location.href = '/admin/list';
                  }else{
                      layer.msg('删除失败!',{icon:1,time:1000});
                      location.reload(true);
                      location.href = '/admin/list';
                  }
              });

          });
      }


      /*用户-批量删除*/
      function delAll (argument) {
        //var data = tableCheck.getData();
        //   获取选中的记录,获取记录的id
        var ids = [];
          $('.layui-form-checked').not('.header').each(function(i,v){
             ids.push($(v).attr('data-id'));
          })
        console.log(ids);

          $.get('/admin/qtpl',{"ids":ids},function(data){
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
  </body>
</html>
@endsection
