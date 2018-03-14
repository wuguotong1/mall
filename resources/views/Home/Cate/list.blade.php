@extends('Home.Layout.home')

@section('main')
    <div class="i_bg">
        <div class="postion">
            <span class="fl">
                <a href="{{url('/')}}"> 首页</a>
                >
                @if(!empty($cates) && !empty($cate))
                <a href="{{url('/cate/'.$cates->id)}}"> {{$cates->type_name}}</a>
                >
                <a href="{{url('/cate/'.$cate->id)}}">{{$cate->type_name}}</a>   </span>
                @endif
        </div>
        <!--Begin 筛选条件 Begin-->
        @if(!empty($cate))
        <div class="content mar_10">
            <table border="0" class="choice" style="width:100%; font-family:'宋体'; margin:0 auto;" cellspacing="0" cellpadding="0">
                <form action="" method="post">
                    <tr>
                        <td>&nbsp; 内存：</td>
                        <td class="td_a" >
                            <a href="{{url('cate/'.$cate->id.'/attr=16G')}}">16G</a>
                            <a href="{{url('cate/'.$cate->id.'/attr=32G')}}">32G</a>
                            <a href="{{url('cate/'.$cate->id.'/attr=64G')}}">64G</a>
                            <a href="{{url('cate/'.$cate->id.'/attr=128G')}}">128G</a>
                    </tr>
                    <tr>
                        <td>&nbsp; 颜色：</td>
                        <td class="td_a" >
                            <a href="{{url('cate/'.$cate->id.'/color=银色')}}"  name="银色">银色</a>
                            <a href="{{url('cate/'.$cate->id.'/color=黑色')}}">黑色</a>
                            <a href="{{url('cate/'.$cate->id.'/color=金色')}}">金色</a>
                    </tr>
                </form>
            </table>
        </div>
        @endif
        <!--End 筛选条件 End-->

        <div class="content mar_20">
            <div class="l_history">
                <div class="his_t">
                    <span class="fl">浏览历史</span>
                    <span class="fr"><a href="#">清空</a></span>
                </div>
                <ul>
                    <li>
                        <div class="img"><a href="#"><img src="{{url('home/images/his_1.jpg')}}" width="185" height="162" /></a></div>
                        <div class="name"><a href="#">Dior/迪奥香水2件套装</a></div>
                        <div class="price">
                            <font>￥<span>368.00</span></font> &nbsp; 18R
                        </div>
                    </li>

                </ul>
            </div>
            <div class="l_list">
                <div class="list_t">
            	<span class="fl list_or">
                	<a href="#" class="now">默认</a>
                    <a href="#">
                    	<span class="fl">销量</span>
                        <span class="i_up">销量从低到高显示</span>
                        <span class="i_down">销量从高到低显示</span>
                    </a>
                    <a href="#">
                    	<span class="fl">价格</span>
                        <span class="i_up">价格从低到高显示</span>
                        <span class="i_down">价格从高到低显示</span>
                    </a>
                    <a href="#">新品</a>
                </span>
                    <span class="fr">共发现120件</span>
                </div>
                <div class="list_c">

                    <ul class="cate_list">
                        @foreach($data as $v)
                        <li>
                            <div class="img"><a href="{{url('/goods/'.$v->id)}}"><img src="{{$v->photo}}" width="210" height="185" /></a></div>
                            <div class="name"><a href="{{url('/goods/'.$v->id)}}">{{$v->goods_title}}</a></div>
                            <div class="price">
                                <font>￥<span>{{$v->new_price}}.00</span></font> &nbsp; {{$v->old_price}}
                            </div>
                            <div class="carbg">
                                <a href="#" class="ss">收藏</a>
                                <a href="#" class="j_car">加入购物车</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <div class="pages" >

                    </div>


</div>
                </div>
            </div>
        </div>
    <script>
        {{--function getColor(obj,id){--}}
            {{--$.get('{{ url('/goods/') }}/'+id,{"color":obj.text},function(data){--}}
                {{--console.log(data);--}}

                {{--// if(data.status == 0){--}}
                {{--//--}}
                {{--//     $(obj).parents("tr").remove();--}}
                {{--//     location.reload(true);--}}
                {{--//--}}
                {{--// }else{--}}
                {{--//     location.reload(true);--}}
                {{--// }--}}
            {{--});--}}
        {{--}--}}
        {{--function getAttr(obj){--}}

        {{--}--}}
    </script>
@endsection