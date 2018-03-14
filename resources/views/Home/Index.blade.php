@extends('Home.Layout.home')

@section('main')

    <!--start 分类菜单 start-->
    <div class="i_bg">
        <div class="content">
            <div class="cate_nav">
                @foreach($cates as $v)
                    <dl>
                        <dt><a href="#">{{$v->type_name}}</a></dt>
                        @foreach($v['paths'] as $m)
                            <dd><a href="{{url('/cate/'.$m->id)}}">{{$m->type_name}}</a></dd>
                        @endforeach
                    </dl>
                @endforeach
            </div>
            <!--End 分类菜单 End-->
            <!--Start 轮播图 Start-->
            <div class="nban">
                <div class="top_slide_wrap">
                    <ul class="slide_box bxslider">
                        <li><img src="home/images/nban.jpg" width="977" height="401" /></li>
                        <li><img src="home/images/nban.jpg" width="977" height="401" /></li>
                        <li><img src="home/images/nban.jpg" width="977" height="401" /></li>
                    </ul>
                    <div class="op_btns clearfix">
                        <a href="#" class="op_btn op_prev"><span></span></a>
                        <a href="#" class="op_btn op_next"><span></span></a>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                //var jq = jQuery.noConflict();
                (function(){
                    $(".bxslider").bxSlider({
                        auto:true,
                        prevSelector:jq(".top_slide_wrap .op_prev")[0],nextSelector:jq(".top_slide_wrap .op_next")[0]
                    });
                })();
            </script>
        </div>
        <!--End 轮播图 End-->
        <!--Start 分类图 Start-->
        <div class="content mar_15">
            <ul class="cate">
                <li><a href="CategoryList.html"><img src="home/images/ca_1.jpg" width="295" height="220" /></a></li>
                <li><a href="CategoryList.html"><img src="home/images/ca_2.jpg" width="295" height="220" /></a></li>
                <li><a href="CategoryList.html"><img src="home/images/ca_3.jpg" width="295" height="220" /></a></li>
                <li><a href="CategoryList.html"><img src="home/images/ca_4.jpg" width="295" height="220" /></a></li>
            </ul>
        </div>
        <!--End 分类图 End-->
        <!--Begin 热卖爆款商品 Begin-->
        <div class="i_t mar_10">
            <span class="fl">热卖爆款商品</span>
            <span class="fr">TOP .10</span>
        </div>
        <div class="like">
            <div id="featureContainer1">
                <div id="feature1">
                    <div id="block1">
                        <div id="botton-scroll1">
                            <ul class="featureUL">
                                <li class="featureBox">
                                    <div class="box">
                                        <div class="imgbg">
                                            <a href="#"><img src="home/images/bk_1.jpg" width="160" height="136" /></a>
                                        </div>
                                        <div class="name">
                                            <a href="#">
                                                <h2>德国进口</h2>
                                                德亚全脂纯牛奶200ml*48盒
                                            </a>
                                        </div>
                                        <div class="price">
                                            <font>￥<span>189</span></font> &nbsp; 26R
                                        </div>
                                    </div>
                                </li>
                                <li class="featureBox">
                                    <div class="box">
                                        <div class="imgbg">
                                            <a href="#"><img src="home/images/bk_2.jpg" width="160" height="136" /></a>
                                        </div>
                                        <div class="name">
                                            <a href="#">
                                                <h2>iphone 6S</h2>
                                                Apple/苹果 iPhone 6s Plus公开版
                                            </a>
                                        </div>
                                        <div class="price">
                                            <font>￥<span>5288</span></font> &nbsp; 25R
                                        </div>
                                    </div>
                                </li>
                                <li class="featureBox">
                                    <div class="box">
                                        <div class="imgbg">
                                            <a href="#"><img src="home/images/bk_3.jpg" width="160" height="136" /></a>
                                        </div>
                                        <div class="name">
                                            <a href="#">
                                                <h2>倩碧特惠组合套装</h2>
                                                倩碧补水组合套装8折促销
                                            </a>
                                        </div>
                                        <div class="price">
                                            <font>￥<span>368</span></font> &nbsp; 18R
                                        </div>
                                    </div>
                                </li>
                                <li class="featureBox">
                                    <div class="box">
                                        <div class="imgbg">
                                            <a href="#"><img src="home/images/bk_4.jpg" width="160" height="136" /></a>
                                        </div>
                                        <div class="name">
                                            <a href="#">
                                                <h2>品利特级橄榄油</h2>
                                                750ml*4瓶装组合 西班牙原装进口
                                            </a>
                                        </div>
                                        <div class="price">
                                            <font>￥<span>280</span></font> &nbsp; 30R
                                        </div>
                                    </div>
                                </li>
                                <li class="featureBox">
                                    <div class="box">
                                        <div class="imgbg">
                                            <a href="#"><img src="home/images/bk_5.jpg" width="160" height="136" /></a>
                                        </div>
                                        <div class="name">
                                            <a href="#">
                                                <h2>品利特级橄榄油</h2>
                                                750ml*4瓶装组合 西班牙原装进口
                                            </a>
                                        </div>
                                        <div class="price">
                                            <font>￥<span>280</span></font> &nbsp; 30R
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <a class="l_prev" href="javascript:void();">Previous</a>
                    <a class="l_next" href="javascript:void();">Next</a>
                </div>
            </div>
        </div>
        <!--End 热卖爆款商品 End-->
        <!--Begin 宝宝洗护 Begin-->
        <div class="i_t mar_10">
            <span class="fl t_color">宝宝洗护</span>
            <span class="i_mores fr"><a href="#">营养品</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">孕妈背带裤</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">儿童玩具</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">婴儿床</a>&nbsp; &nbsp; | &nbsp; &nbsp;<a href="#">喂奶器</a></span>
        </div>
        <div class="content">
            <div class="bb_ban">
                <div id="imgPlayba">
                    <ul class="imgs" id="actorba">
                        <li><a href="#"><img src="home/images/bb_ban.jpg" width="228" height="418" /></a></li>
                        <li><a href="#"><img src="home/images/bb_ban.jpg" width="228" height="418" /></a></li>
                        <li><a href="#"><img src="home/images/bb_ban.jpg" width="228" height="418" /></a></li>
                    </ul>
                    <div class="prevba">上一张</div>
                    <div class="nextba">下一张</div>
                </div>
            </div>
            <div class="milk_right">
                <ul>
                    <li>
                        <div class="img"><a href="#"><img src="home/images/pro1.jpg" width="185" height="155" /></a></div>
                        <div class="name"><a href="#">Topfer特福芬 德国原装进口</a></div>
                        <div class="price">
                            <font>￥<span>260.00</span></font> &nbsp; 20R
                        </div>
                    </li>
                    <li>
                        <div class="img"><a href="#"><img src="home/images/pro2.jpg" width="185" height="155" /></a></div>
                        <div class="name"><a href="#">Topfer特福芬 德国原装进口</a></div>
                        <div class="price">
                            <font>￥<span>260.00</span></font> &nbsp; 20R
                        </div>
                    </li>
                    <li>
                        <div class="img"><a href="#"><img src="home/images/pro3.jpg" width="185" height="155" /></a></div>
                        <div class="name"><a href="#">Topfer特福芬 德国原装进口</a></div>
                        <div class="price">
                            <font>￥<span>260.00</span></font> &nbsp; 20R
                        </div>
                    </li>
                    <li>
                        <div class="img"><a href="#"><img src="home/images/pro4.jpg" width="185" height="155" /></a></div>
                        <div class="name"><a href="#">Topfer特福芬 德国原装进口</a></div>
                        <div class="price">
                            <font>￥<span>260.00</span></font> &nbsp; 20R
                        </div>
                    </li>
                    <li>
                        <div class="img"><a href="#"><img src="home/images/pro5.jpg" width="185" height="155" /></a></div>
                        <div class="name"><a href="#">Topfer特福芬 德国原装进口</a></div>
                        <div class="price">
                            <font>￥<span>260.00</span></font> &nbsp; 20R
                        </div>
                    </li>
                    <li>
                        <div class="img"><a href="#"><img src="home/images/pro6.jpg" width="185" height="155" /></a></div>
                        <div class="name"><a href="#">Topfer特福芬 德国原装进口</a></div>
                        <div class="price">
                            <font>￥<span>260.00</span></font> &nbsp; 20R
                        </div>
                    </li>
                    <li>
                        <div class="img"><a href="#"><img src="home/images/pro7.jpg" width="185" height="155" /></a></div>
                        <div class="name"><a href="#">Topfer特福芬 德国原装进口</a></div>
                        <div class="price">
                            <font>￥<span>260.00</span></font> &nbsp; 20R
                        </div>
                    </li>
                    <li>
                        <div class="img"><a href="#"><img src="home/images/pro8.jpg" width="185" height="155" /></a></div>
                        <div class="name"><a href="#">Topfer特福芬 德国原装进口</a></div>
                        <div class="price">
                            <font>￥<span>260.00</span></font> &nbsp; 20R
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection