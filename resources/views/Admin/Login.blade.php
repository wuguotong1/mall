<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/xadmin.css') }}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('admin/lib/layui/layui.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ asset('admin/js/xadmin.js') }}"></script>

</head>
<body class="login-bg">

    <div class="login">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @if(is_object($errors))
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @else
                        <li>{{ $errors }}</li>
                    @endif
                </ul>
            </div>
        @endif

            {{--@if (!empty(session('msg')))--}}
                {{--<div class="alert alert-danger">--}}
                    {{--<ul>--}}
                            {{--<li>{{ session('msg') }}</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--@endif--}}

        <div class="message">{{ $title }}</div>
        <div id="darkbannerwrap"></div>

        <form method="post" class="layui-form" action="{{ url('admin/dologin') }}" >
            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
            {{ csrf_field() }}
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input"  value="{{ old('username') }}">
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input name="code" lay-verify="required" placeholder="验证码"  type="text" class="layui-input" style="height:36px;width:120px;float:left;">
            {{--<input name="code" lay-verify="required" placeholder="验证码"  type="text" class="layui-input" >--}}
            <img style="width:120px;float:right" src="{{ url('admin/vcode') }}" onclick="this.src='{{ url('admin/vcode') }}?'+Math.random()" alt="">

            {{--<a onclick="javascript:re_captcha();">--}}
                {{--<img src="{{ URL('/code/captcha/1') }}" id="127ddf0de5a04167a9e427d883690ff6">--}}
            {{--</a>--}}

            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >

        </form>
    </div>
    <script type="text/javascript">
        function re_captcha() {
            $url = "{{ URL('/code/captcha') }}";
            $url = $url + "/" + Math.random();
            document.getElementById('127ddf0de5a04167a9e427d883690ff6').src = $url;
        }
    </script>
    <script>



    </script>


    <!-- 底部结束 -->
    <script>
    //百度统计可去掉
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
      var s = document.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>
</html>