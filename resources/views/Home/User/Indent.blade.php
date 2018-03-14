@extends('home.layout.user')

@section('main')

            <div class="m_right">
                <p></p>
                <div class="mem_tit">我的订单</div>
                <table border="0" class="order_tab" style="width:930px; text-align:center; margin-bottom:30px;" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="20%">订单号</td>
                        <td width="25%">下单时间</td>
                        <td width="15%">订单总金额</td>
                        <td width="25%">订单状态</td>
                        <td width="15%">操作</td>
                    </tr>
                    @foreach($data as $v)
                        <tr>
                            <td><font color="#ff4e00">{{$v->number}}</font></td>
                            <td>{{$v->created_at}}</td>
                            <td>￥{{ ($v->goods_price)*$v->goods_num+$v->carriage }}</td>
                            <td><?php if($v->status == 0){echo '待发货';}elseif($v->status == 1){echo '已发货';}else{echo '已收货';} ?></td>
                            <td><a href="#" style="border:1px solid #ccc;border-radius:5px;padding:3px;background:#eee">确认收货</a> </td>
                        </tr>
                    @endforeach
                </table>





            </div>
        </div>
@endsection