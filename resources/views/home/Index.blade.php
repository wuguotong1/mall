@extends('Home.Layout.home')

@section('main')
    <!--Begin Menu Begin-->
    <div class="menu_bg">
        <div class="menu">
            <!--Begin 商品分类详情 Begin-->
            <div class="nav">
                <div class="nav_t">全部商品分类</div>
            </div>
            <!--End 商品分类详情 End-->
            <ul class="menu_r">
                <li><a href="Index.html">首页</a></li>
                <li><a href="Food.html">美食</a></li>
                <li><a href="Fresh.html">生鲜</a></li>
                <li><a href="HomeDecoration.html">家居</a></li>
                <li><a href="SuitDress.html">女装</a></li>
                <li><a href="MakeUp.html">美妆</a></li>
                <li><a href="Digital.html">数码</a></li>
                <li><a href="GroupBuying.html">团购</a></li>
            </ul>
            <div class="m_ad">中秋送好礼！</div>
        </div>
    </div>
    <!--End Menu End-->
    <div class="i_bg">
        <div class="content">
            <div class="cate_nav">
            </div>
            <!--Begin Banner Begin-->
            <div class="nban">
                <div class="top_slide_wrap">
                    <ul class="slide_box bxslider">
                        <!-- 轮播图 -->
                        @foreach($carousel as $key=>$value)
                        <li><img src="{{$value->path}}" width="977" height="401"></li>
                        @endforeach
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
            <!--End Banner End-->
        </div>
        <div class="content mar_15">
            <ul class="cate">
                <li><a href="CategoryList.html"><img src="home/images/ca_1.jpg" width="295" height="220"></a></li>
                <li><a href="CategoryList.html"><img src="home/images/ca_2.jpg" width="295" height="220"></a></li>
                <li><a href="CategoryList.html"><img src="home/images/ca_3.jpg" width="295" height="220"></a></li>
                <li><a href="CategoryList.html"><img src="home/images/ca_4.jpg" width="295" height="220"></a></li>
            </ul>
        </div>
        <!--End 热卖爆款商品 End-->
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
                        <!-- 推荐位 -->
                        @foreach($recom as $key=>$value)
                        <li class="featureBox">
                            <div class="box">
                                <div class="h_icon"><img src="/home/images/hot.png" width="50" height="50"></div>
                                <div class="imgbg">
                                    <a href="#"><img src="{{$value->recom_thumb}}" width="160" height="136"></a>
                                </div>
                                <div class="name">
                                    <a href="#">
                                        <h2>{{$value->goods->goods_title}}</h2>
                                        {{$value->goods->desc}}
                                    </a>
                                </div>
                                <div class="price">
                                    <font>￥<span>{{$value->goods->new_price}}</span></font> &nbsp; 26R
                                </div>
                            </div>
                        </li>
                        @endforeach
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