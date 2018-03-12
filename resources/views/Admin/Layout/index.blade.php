<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>后台登录-X-admin2.0</title>
  <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8">
    <meta http-equiv="Cache-Control" content="no-siteapp">

    <link rel="shortcut icon" href="/admin/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/admin/css/font.css">
  <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script type="text/javascript" src="/admin/js/jquery-3.2.1.min.js"></script>
    {{--<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>--}}
    <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>

</head>
<body>
    <!-- 顶部开始 -->
    <div class="container">
<<<<<<< HEAD
        <div class="logo"><a href="./index.html">X-admin v2.0</a></div>
=======
        <div class="logo"><a href="/index.html">X-admin v2.0</a></div>
>>>>>>> 8492db054f3f00b06c58ef141e5feff8c9a16249
        <div class="left_open">
            <i title="展开左侧栏" class="iconfont">&#xe699;</i>
        </div>
        <ul class="layui-nav left fast-add" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;">+新增</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <dd><a onclick="x_admin_show('资讯','http://www.baidu.com')"><i class="iconfont">&#xe6a2;</i>资讯</a></dd>
              <dd><a onclick="x_admin_show('图片','http://www.baidu.com')"><i class="iconfont">&#xe6a8;</i>图片</a></dd>
               <dd><a onclick="x_admin_show('用户','http://www.baidu.com')"><i class="iconfont">&#xe6b8;</i>用户</a></dd>
            </dl>
          </li>
        </ul>
        <ul class="layui-nav right" lay-filter="">
          <li class="layui-nav-item">
            <a href="javascript:;">admin</a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
              <dd><a onclick="x_admin_show('个人信息','http://www.baidu.com')">个人信息</a></dd>
              <dd><a onclick="x_admin_show('切换帐号','http://www.baidu.com')">切换帐号</a></dd>
<<<<<<< HEAD
              <dd><a href="./login.html">退出</a></dd>
=======
              <dd><a href="/login.html">退出</a></dd>
>>>>>>> 8492db054f3f00b06c58ef141e5feff8c9a16249
            </dl>
          </li>
          <li class="layui-nav-item to-index"><a href="/">前台首页</a></li>
        </ul>

    </div>
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
     <!-- 左侧菜单开始 -->
    <div class="left-nav">
      <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b8;</i>
<<<<<<< HEAD
                    <cite>用户管理</cite>
=======
                    <cite>会员管理</cite>
>>>>>>> 8492db054f3f00b06c58ef141e5feff8c9a16249
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
<<<<<<< HEAD
                        <a href="{{ url('admin/list') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>前台用户</cite>
=======
                        <a _href="member-list.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>会员列表</cite>
>>>>>>> 8492db054f3f00b06c58ef141e5feff8c9a16249

                        </a>
                    </li >
                    <li>
<<<<<<< HEAD
                        <a href="{{ url('admin/user') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>后台用户</cite>

                        </a>
                    </li>
=======
                        <a _href="member-del.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>会员删除</cite>

                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont">&#xe70b;</i>
                            <cite>会员管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a _href="xxx.html">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>会员列表</cite>

                                </a>
                            </li >
                            <li>
                                <a _href="xx.html">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>会员删除</cite>

                                </a>
                            </li>
                            <li>
                                <a _href="xx.html">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>等级管理</cite>

                                </a>
                            </li>

                        </ul>
                    </li>
>>>>>>> 8492db054f3f00b06c58ef141e5feff8c9a16249
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
<<<<<<< HEAD
                    <cite>分类管理</cite>
=======
                    <cite>订单管理</cite>
>>>>>>> 8492db054f3f00b06c58ef141e5feff8c9a16249
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
<<<<<<< HEAD
                        <a href="{{ url('admin/cate') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>分类列表</cite>
                        </a>
                    </li >
                    <li>
                        <a href="{{ url('admin/cate/create ') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>添加分类</cite>
=======
                        <a _href="order-list.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>订单列表</cite>
>>>>>>> 8492db054f3f00b06c58ef141e5feff8c9a16249
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe726;</i>
<<<<<<< HEAD
                    <cite>商品管理</cite>
=======
                    <cite>管理员管理</cite>
>>>>>>> 8492db054f3f00b06c58ef141e5feff8c9a16249
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
<<<<<<< HEAD
                        <a href="{{ url('admin/goods') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>商品列表</cite>
                        </a>
                    </li >
                    <li>
                        <a href="{{ url('admin/goods/create') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>添加商品</cite>
                        </a>
                    </li >

                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe723;</i>
                    <cite>广告管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="/admin/advert">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>推荐位列表</cite>
                        </a>
                    </li >
                    <li>
                        <a href="/admin/carousel">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>轮播图列表</cite>
=======
                        <a _href="admin-list.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>管理员列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="admin-role.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>角色管理</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="admin-cate.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>权限分类</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="admin-rule.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>权限管理</cite>
>>>>>>> 8492db054f3f00b06c58ef141e5feff8c9a16249
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6ce;</i>
<<<<<<< HEAD
                    <cite>系统配置</cite>
=======
                    <cite>网站配置管理</cite>
>>>>>>> 8492db054f3f00b06c58ef141e5feff8c9a16249
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
<<<<<<< HEAD
                        <a _href="echarts1.html">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>系统配置列表</cite>
                        </a>
                    </li >

=======
                        <a _href="{{ url('admin/config/create') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>添加网站配置</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="{{ url('admin/config') }}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>网站配置列表</cite>
                        </a>
                    </li>
>>>>>>> 8492db054f3f00b06c58ef141e5feff8c9a16249
                </ul>
            </li>
        </ul>
      </div>
    </div>
    <!-- <div class="x-slide_left"></div> -->
    <!-- 左侧菜单结束 -->
    <!-- 右侧主体开始 -->
<<<<<<< HEAD
 <div class="page-content">

        @section('content')


        @show
    </div>
<div class="page-content-bg"></div>
=======

        @section('content')
        <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
          <ul class="layui-tab-title">
            <li>我的桌面</li>
          </ul>
          <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='{{ url('admin/welcome') }}' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
          </div>
        </div>
        </div>
        <div class="page-content-bg"></div>
        @show

>>>>>>> 8492db054f3f00b06c58ef141e5feff8c9a16249
    <!-- 右侧主体结束 -->
    <!-- 中部结束 -->
    <!-- 底部开始 -->
    <div class="footer">
        <div class="copyright">Copyright ©2017 x-admin v2.3 All Rights Reserved</div>
    </div>
<<<<<<< HEAD
   
=======
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
>>>>>>> 8492db054f3f00b06c58ef141e5feff8c9a16249
</body>
</html>