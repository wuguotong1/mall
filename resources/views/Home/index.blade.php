@extends('Home.Layout.home')

@section('main')
    <!--Begin Menu Begin-->
<div class="menu_bg">
    <div class="menu">
        <!--Begin 商品分类详情 Begin-->    
        <div class="nav">
            <div class="nav_t">全部商品分类</div>
            <div class="leftNav">
                <ul>      
                    <li>
                        <div class="fj">
                            <span class="n_img"><span></span><img src="/home/images/nav1.png" /></span>
                            <span class="fl">进口食品、生鲜</span>
                        </div>
                        <div class="zj">
                            <div class="zj_l">
                                <div class="zj_l_c">
                                    <h2>零食 / 糖果 / 巧克力</h2>
                                    <a href="#">坚果</a>|
                                </div>
                            </div>
                            <div class="zj_r">
                                <a href="#"><img src="/home/images/n_img1.jpg" width="236" height="200" /></a>
                                <a href="#"><img src="/home/images/n_img2.jpg" width="236" height="200" /></a>
                            </div>
                        </div>
                    </li>
                </ul>            
            </div>
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
<div class="i_bg bg_color">
    <div class="i_ban_bg">
        <!--Begin Banner Begin-->
        <div class="banner">        
            <div class="top_slide_wrap">
                <ul class="slide_box bxslider">
                    @foreach($carousel as $key=>$value)
                    <li><img src="{{$value->path}}" width="740" height="401" /></li>
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
        <div class="inews">
            <div class="news_t">
                <span class="fr"><a href="#">更多 ></a></span>新闻资讯
            </div>
            <ul>
                <li><span>[ 特惠 ]</span><a href="#">掬一轮明月 表无尽惦念</a></li>
                <li><span>[ 公告 ]</span><a href="#">好奇金装成长裤新品上市</a></li>
                <li><span>[ 特惠 ]</span><a href="#">大牌闪购 · 抢！</a></li>
                <li><span>[ 公告 ]</span><a href="#">发福利 买车就抢千元油卡</a></li>
                <li><span>[ 公告 ]</span><a href="#">家电低至五折</a></li>
            </ul>
            <div class="charge_t">
                话费充值<div class="ch_t_icon"></div>
            </div>
            <form>
            <table border="0" style="width:205px; margin-top:10px;" cellspacing="0" cellpadding="0">
              <tr height="35">
                <td width="33">号码</td>
                <td><input type="text" value="" class="c_ipt" /></td>
              </tr>
              <tr height="35">
                <td>面值</td>
                <td>
                    <select class="jj" name="city">
                      <option value="0" selected="selected">100元</option>
                      <option value="1">50元</option>
                      <option value="2">30元</option>
                      <option value="3">20元</option>
                      <option value="4">10元</option>
                    </select>
                    <span style="color:#ff4e00; font-size:14px;">￥99.5</span>
                </td>
              </tr>
              <tr height="35">
                <td colspan="2"><input type="submit" value="立即充值" class="c_btn" /></td>
              </tr>
            </table>
            </form>
        </div>
    </div>
    <!--Begin 热门商品 Begin-->
    <div class="content mar_10">
        <div class="h_l_img">
            <div class="img"><img src="/home/images/l_img.jpg" width="188" height="188" /></div>
            <div class="pri_bg">
                <span class="price fl">￥53.00</span>
                <span class="fr">16R</span>
            </div>
        </div>
        <div class="hot_pro">           
            <div id="featureContainer">
                <div id="feature">
                    <div id="block">
                        <div id="botton-scroll">
                            <ul class="featureUL">
                            @foreach($recom as $key=>$value)
                                <li class="featureBox">
                                    <div class="box">
                                        <div class="h_icon"><img src="/home/images/hot.png" width="50" height="50"></div>
                                        <div class="imgbg">
                                            <a href="#"><img src="{{$value->recom_thumb}}" width="160" height="136"></a>
                                        </div>                                        
                                        <div class="name">
                                            <a href="#">
                                            <h2>{{$value->name}}</h2>
                                            {{$value->desc}}
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
                    <a class="h_prev" href="javascript:void();">Previous</a>
                    <a class="h_next" href="javascript:void();">Next</a>
                </div>
            </div>
        </div>
    </div>
    <!--Begin 限时特卖 Begin-->
    <div class="i_t mar_10">
        <span class="fl">限时特卖</span>
        <span class="i_mores fr"><a href="#">更多</a></span>
    </div>
    <div class="content">
        <div class="i_sell">
            <div id="imgPlay">
                <ul class="imgs" id="actor">
                    <li><a href="#"><img src="/home/images/tm_r.jpg" width="211" height="357" /></a></li>
                </ul>
                <div class="previ">上一张</div>
                <div class="nexti">下一张</div>
            </div>        
        </div>
        <div class="sell_right">
            <div class="sell_1">
                <div class="s_img"><a href="#"><img src="/home/images/tm_1.jpg" width="185" height="155" /></a></div>
                <div class="s_price">￥<span>89</span></div>
                <div class="s_name">
                    <h2><a href="#">沙宣洗发水</a></h2>
                    倒计时：<span>1200</span> 时 <span>30</span> 分 <span>28</span> 秒
                </div>
            </div>
            
            
        </div>
    </div>
    <!--End 限时特卖 End-->
    <div class="content mar_20">
        <img src="/home/images/mban_1.jpg" width="1200" height="110" />
    </div>
    <!--Begin 进口 生鲜 Begin-->
    <div class="i_t mar_10">
        <span class="floor_num">1F</span>
        <span class="fl">进口 <b>·</b> 生鲜</span>                
        <span class="i_mores fr"><a href="#">进口咖啡</a>&nbsp; &nbsp; &nbsp; <a href="#">进口酒</a>&nbsp; &nbsp; &nbsp; <a href="#">进口母婴</a>&nbsp; &nbsp; &nbsp; <a href="#">新鲜蔬菜</a>&nbsp; &nbsp; &nbsp; <a href="#">新鲜水果</a></span>
    </div>
    <div class="content">
        <div class="fresh_left">
            <div class="fre_ban">
                <div id="imgPlay1">
                    <ul class="imgs" id="actor1">
                        <li><a href="#"><img src="/home/images/fre_r.jpg" width="211" height="286" /></a></li>
                    </ul>
                    <div class="prevf">上一张</div>
                    <div class="nextf">下一张</div> 
                </div>   
            </div>
            <div class="fresh_txt">
                <div class="fresh_txt_c">
                    <a href="#">进口水果</a>
                </div>
            </div>
        </div>
        <div class="fresh_mid">
            <ul>
                <li>
                    <div class="name"><a href="#">新鲜美味  进口美食</a></div>
                    <div class="price">
                        <font>￥<span>198.00</span></font> &nbsp; 26R
                    </div>
                    <div class="img"><a href="#"><img src="/home/images/fre_1.jpg" width="185" height="155" /></a></div>
                </li>
            </ul>
        </div>
        <div class="fresh_right">
            <ul>
                <li><a href="#"><img src="/home/images/fre_b1.jpg" width="260" height="220" /></a></li>
                <li><a href="#"><img src="/home/images/fre_b2.jpg" width="260" height="220" /></a></li>
            </ul>
        </div>
    </div>    
    <!--End 进口 生鲜 End-->
    
    <div class="content mar_20">
        <img src="/home/images/mban_1.jpg" width="1200" height="110" />
    </div>
    
<!--Begin 猜你喜欢 Begin-->
<div class="i_t mar_10">
    <span class="fl">猜你喜欢</span>
</div>    
<div class="like">          
    <div id="featureContainer1">
        <div id="feature1">
            <div id="block1">
                <div id="botton-scroll1">
                    <ul class="featureUL">
                        @foreach($recom as $key=>$value)
                                <li class="featureBox">
                                    <div class="box">
                                        <div class="imgbg">
                                            <a href="#"><img src="{{$value->recom_thumb}}" width="160" height="136"></a>
                                        </div>                                        
                                        <div class="name">
                                            <a href="#">
                                            <h2>{{$value->name}}</h2>
                                            {{$value->desc}}
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
<!--End 猜你喜欢 End-->
@endsection