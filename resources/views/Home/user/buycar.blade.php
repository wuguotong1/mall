@extends('Home.Layout.home')

@section('main')
<div class="i_bg">  
    <div class="content mar_20">
    	<img src="/home/images/img1.jpg" />        
    </div>
    <!--Begin 第一步：查看购物车 Begin -->
    <div class="content mar_20">
    	<table border="0" class="car_tab" style="width:1200px; margin-bottom:50px;" cellspacing="0" cellpadding="0">
          <tr>
            <td class="car_th" width="490">商品名称</td>
            <td class="car_th" width="140">描述</td>
            <td class="car_th" width="150">购买数量</td>
            <td class="car_th" width="130">小计</td>
            <td class="car_th" width="140">返还积分</td>
            <td class="car_th" width="150">操作</td>
          </tr>
          @foreach($data as $key=>$value)
          <tr>
            <td>
            	<div class="c_s_img"><img src="{{$value->goodsCar->photo}}" width="73" height="73"></div>
                {{$value->goodsCar->goods_title}}
            </td>
            <td align="center">{{$value->goodsCar->desc}}</td>
            <td align="center">
            	<div class="c_num">
                  <input type="button" value="" onclick="jianUpdate1(jq(this));" class="car_btn_1">
                	<input type="text" value="{{$value->num}}" name="" class="car_ipt" uid="{{$value->uid}}" gid="{{$value->gid}}">  
                  <input type="button" value="" onclick="addUpdate1(jq(this));" class="car_btn_2">
              </div>
            </td>
            <td align="center" style="color:#ff4e00;" name="sum[]">￥{{$value->price*$value->num}}</td>
            <td align="center">26R</td>
            <td align="center">
              <a onclick="del(jq(this));" car-id="{{$value->id}}">删除</a>&nbsp; &nbsp;
              <a href="#" onclick="collect(jq(this))">加入收藏</a>
            </td>
          </tr>
          @endforeach
          <script>
              /*删除商品*/
              function del(del){
                var id = del.attr('car-id');
                //发送Ajax
                $.get('/buycar/del',{"id":id},function(data){
                    if(data.status == 1){
                        location.reload();
                    }else{
                        location.reload();
                    }
                })
              }
              /*添加商品收藏*/
              function collect(collect){
                var uid = collect.parent().prev().prev().prev().find(".car_ipt").attr('uid');
                var gid = collect.parent().prev().prev().prev().find(".car_ipt").attr('gid');
                //发送Ajax
                $.get('/buycar/collect',{"uid":uid,"gid":gid},function(data){
                    if(data.status == 1){
                        alert(data.msg);
                        location.reload();
                    }else{
                        alert(data.msg);
                        location.reload();
                    }
                });
              }
              /*增加商品数量*/
              function addUpdate1(jia){
                var uid = jia.parent().find(".car_ipt").attr('uid');
                var gid = jia.parent().find(".car_ipt").attr('gid');
                var c = jia.parent().find(".car_ipt").val();
                c = parseInt(c) + 1;
                //发送Ajax
                $.get('/buycar/num',{"uid":uid,"c":c,"gid":gid},function(data){
                    if(data.status == 1){
                        jia.parent().find(".car_ipt").val(c);
                        location.reload();
                    }
                });
              }
              /*减少商品数量*/
              function jianUpdate1(jian){
                var uid = jian.parent().find(".car_ipt").attr('uid');
                var gid = jian.parent().find(".car_ipt").attr('gid');   
                var c = jian.parent().find(".car_ipt").val();
                if(c==1){    
                  c=1;    
                }else{    
                  c=parseInt(c)-1;
                  //发送Ajax
                  $.get('/buycar/num',{"uid":uid,"c":c,"gid":gid},function(data){
                      if(data.status == 1){
                          jian.parent().find(".car_ipt").val(c);
                          location.reload();
                      }
                  });    
                }
              }
          </script>

          <tr height="70">
          	<td colspan="6" style="font-family:'Microsoft YaHei'; border-bottom:0;">
            	<label class="r_rad">
                <input type="checkbox" name="clear">
              </label>
            	<label class="r_txt">清空购物车</label>
              <span class="fr">商品总价：
              	<b style="font-size:22px; color:#ff4e00;" name="summ">￥2098</b>
              </span>
            </td>
          </tr>

          <tr valign="top" height="120">
          	<td colspan="6" align="right">
            	<a href="#">
            		<img src="/home/images/buy1.gif">
            	</a>&nbsp; &nbsp; 
            	<a href="#">
            		<img src="/home/images/buy2.gif">
            	</a>
            </td>
          </tr>
        </table>
    </div>
	<!--End 第一步：查看购物车 End--> 
@endsection