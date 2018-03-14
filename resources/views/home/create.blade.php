@extends('home.layout.index')

@section('content')
<table border="0" width="990px" align="center" cellpadding="2" cellspacing="0">
  <tbody><tr>
    <td width="230" valign="top" height="100"><br>
    <a href="/home/index">
    	<img src="/admin/images/logo.jpg" width="80" height="80" border="0" alt="返回首页">
    </a>
</td>
    <td height="100" valign="middle"><center style="margin-top:20px;">
    	<font style=" font-size:15px; font-weight:bold; letter-spacing:2px;" color="#CC0000">
    		<span id="tou">特惠淘--客户评论</span> 
    </font>
</center>
        <font color="#000000" style="font-size:13px; line-height:300%;">
        </font>
        <p style="margin-left:10px; margin-top:10px; margin-right:10px; margin-bottom:5px; width: 680px; height: 30px; padding-top:5px;">
        	<font color="#000000" style="font-size:13px; line-height:300%;">尊敬的用户，如果您有什么问题或建议，请及时向我们反馈，以便我们更好地为您服务~　</font>
        </p>
    </td>
    </tr>
</tbody>
</table>

<table width="990px" cellpadding="0" cellspacing="0" border="0">
	<tbody>
		<tr>
        <td height="3" style=" background-color:#009933">
        </td>
    </tr>
</tbody>
</table>

    <table name="table" width="990px" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#f5fcff" style="border-left:1px solid #D1D1D1; border-right:1px solid #D1D1D1">
  <tbody>
  	<tr>
      <td width="220" valign="top">
     <div id="left" style="margin-left:5px; padding-top:20px; background-color:#f5fcff"> 
     <div class="tu-title3"><a href="#" class="a1">联 系 我 们</a></div> <br> 
<div class="left_movie" style="margin-top:-10px;">
   <ul id="tu_list2"><li style="height:2px"></li>
<li>电&nbsp; 话：<br> 010-88888888 <br>010-82899999</li><br>
   <li>&nbsp;服务投诉热线：   <br>010-82893558</li><br>
   <li>&nbsp;客服QQ：   <br>&nbsp;<a href="http://sighttp.qq.com/msgrd?v=1&amp;uin=610712776&amp;site=易方达医药网&amp;menu=yes" target="blank">61077777</a>&nbsp; <a href="http://sighttp.qq.com/msgrd?v=1&amp;uin=583374524&amp;site=易方达医药网&amp;menu=yes" target="blank">5555556</a></li><br>
   <li style=" border-bottom:0px solid #cccccc;">&nbsp;邮&nbsp; 箱：<a href="mailto:info@tht.com">info@tht.com</a></li>
  </ul>
  <br> 
  </div></div>
    </td>
    <td width="786" valign="top">
    <div style="width:786px; margin:auto; margin-top:5px;background-color:#f5fcff">
    <div style="margin-top:5px; margin-bottom:10px; width:780; margin:auto; font-size:13px; background-color:#f5fcff; line-height:27px;">



    <form action="/home/index" name="table" method="post">
    	{{csrf_field()}}
    <table border="0" cellpadding="5" cellspacing="1" style=" margin-left:30px; margin-bottom:2px; margin-top:10px; width: 629px;">
    	<tbody>		
    		<tr>
    			<th width="70px" align="right">主 &nbsp;题</th>
    			<td class="style1">&nbsp;
    				<input name="title" value="{{old('title')}}" style="width:350px;">&nbsp;
    				<font color="red">
    				</font>
    			</td>
    		</tr>
    	<tr>
    <th width="70px" align="right" style="margin-right:5px">评&nbsp; 论</th>
    	<td class="style1">&nbsp;
    				<input name="comment" value="{{old('comment')}}" style="width:350px;">&nbsp;
    				<font color="red">
    				</font>
    			</td>
   				 </tr>
   		<tr>
   <th width="70px" align="right" style="margin-right:5px" >用户名</th>
   		<td class="style1">&nbsp;<input name="uid"　value="{{old('uid')}}"  style="width:350px;">&nbsp;
   			<font color="red">
   			</font>
       <font color="red"></font>
    </td>
   </tr>
   <tr>
   <th width="70px" align="right" style="margin-right:5px" >商品名</th>
   		<td class="style1">&nbsp;<input name="item"　value="{{old('item')}}"  style="width:350px;">&nbsp;
   			<font color="red">
   			</font>
       <font color="red"></font>
    </td>
   </tr>

   <tr>
   <th width="70px" align="right" style="margin-right:5px" >商品ID</th>
   		<td class="style1">&nbsp;<input name="gid"　value="{{ $gid }}"  style="width:350px;">&nbsp;
   			<font color="red">
   			</font>
       <font color="red"></font>
    </td>
   </tr>

   <tr align="center">
	   <td colspan="2" height="25px">
		   <input type="submit" value="提交" >
		   <input type="reset" value="重置">
	   	</td>
   							</tr>
    					</tbody>
					</table>  
					</form> 
   				 </div>
   			 </div>
        	</td>
  		</tr>
	</tbody>
</table>
@endsection