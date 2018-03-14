@extends('admin.Layout.index')

@section('content')
<a href="/admin/carousel" class="layui-btn layui-btn-normal" style="margin-left:20px; margin-top:20px;">返回列表页</a>
<div class="x-body">
  <form id="adv_form" class="layui-form" action="/admin/carousel" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="layui-form-item">
          <label for="title" class="layui-form-label">
              <span class="x-red">*</span>标题
          </label>
          <div class="layui-input-inline">
              <input type="text" name="title" class="layui-input">
          </div>
      </div>
      <div class="layui-form-item">
            <label for="L_art_editor" class="layui-form-label">
                <span class="x-red">*</span>缩略图
            </label>
            <div class="layui-input-inline">
                <input type="file" id="file_upload" name="file_upload">
            </div>
            <script type="text/javascript">
                $(function () {
                    $("#file_upload").change(function () {
                        uploadImage();
                    });
                });
                function uploadImage() {
                    //判断是否有选择上传文件
                    var imgPath = $("#file_upload").val();
                    if (imgPath == "") {
                        alert("请选择上传图片！");
                        return;
                    }
                    //判断上传文件的后缀名
                    var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                    if (strExtension != 'jpg' && strExtension != 'gif'
                        && strExtension != 'png' && strExtension != 'bmp') {
                        alert("请选择图片文件");
                        return;
                    }
                    //将整个表单打包进formData
                    var formData = new FormData($('#adv_form')[0]);
                    $.ajax({
                        type: "POST",
                        url: "/carousel/uploads",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        contentType: false,
                        processData: false,
                        async:true,
                        cache:false,
                        success: function(data) {
                            $('#thumb').attr('src',data);
                            $('#path').val(data);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert("上传失败，请检查网络后重试");
                        }
                    });
                }
            </script>
        </div>
        <div class="layui-form-item">
            <label for="L_art_tag" class="layui-form-label">
                <span class="x-red">*</span>预览
            </label>
            <div class="layui-input-block">
                <input type="hidden" name="path" id="path" value="">
                {{--上传成功后显示上传图片--}}
                <img src="" id="thumb" alt="" style="width:100px;">
            </div>
        </div>

      <div class="layui-form-item">
          <label class="layui-form-label"><span class="x-red">*</span>状态</label>
          <div class="layui-input-block">
            <input type="radio" name="status" lay-skin="primary" value="0" title="隐藏" checked>
            <input type="radio" name="status" lay-skin="primary" value="1" title="显示">
          </div>
      </div>
      
      <div class="layui-form-item">
          <label for="L_repass" class="layui-form-label"></label>
          <button  class="layui-btn" lay-filter="add">确定</button>
          <button type="reset" class="layui-btn layui-btn-warm">重置</button>
      </div>
  </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
      var form = layui.form
      ,layer = layui.layer;
    
      //监听提交
      form.on('submit(add)', function(data){
        console.log(data);
        //发异步，把数据提交给php
        layer.alert("增加成功", {icon: 6},function () {
            // 获得frame索引
            var index = parent.layer.getFrameIndex(window.name);
            //关闭当前frame
            parent.layer.close(index);
        });
        return false;
      });
      
    });
</script>
@endsection