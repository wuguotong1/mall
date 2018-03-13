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
    		<span id="tou">特惠淘--客户反馈中心</span> 
    </font>
</center>
        <font color="#000000" style="font-size:13px; line-height:300%;">
        </font>
        <p style="margin-left:10px; margin-top:10px; margin-right:10px; margin-bottom:5px; width: 680px; height: 30px; padding-top:5px;">
        	<font color="#000000" style="font-size:13px; line-height:300%;">尊敬的用户，如果您有什么问题或建议，请及时向我们反馈，以便我们更好地为您服务。　</font>
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



    <form action="/feedback" method="post" name="feedback">
    	{{csrf_field()}}
    <table border="0" cellpadding="5" cellspacing="1" style=" margin-left:30px; margin-bottom:2px; margin-top:10px; width: 629px;">
    	<tbody>		
    		<tr>
    			<th width="70px" align="right">主 &nbsp;题</th>
    			<td class="style1">&nbsp;
    				<input name="title" type="text" id="zhuti" style="width:350px;">&nbsp;
    				<font color="red">
    				</font>
    			</td>
    		</tr>
    	<tr>
    <th width="70px" align="right" style="margin-right:5px">内&nbsp; 容</th>
    	<td class="style1">&nbsp;
    		<textarea name="content" rows="8" cols="20" id="neirong"  style="height:122px;width:350px;"></textarea><font color="red">&nbsp;</font>
    	</td>
    </tr>
   
     
    <tr>
    	<th width="70px" align="right" style="margin-right:5px">省 &nbsp;份</th>
    		<td class="style1">&nbsp;
    			<select name="address" id="shengfen">
					<option value="">请选择</option>
					<option value="北京">北京</option>
					<option value="上海">上海</option>
					<option value="天津">天津</option>
					<option value="重庆">重庆</option>
					<option value="黑龙江">黑龙江</option>
					<option value="吉林">吉林</option>
					<option value="辽宁">辽宁</option>
					<option value="河北">河北</option>
					<option value="河南">河南</option>
					<option value="山西">山西</option>
					<option value="陕西">陕西</option>
					<option value="内蒙古">内蒙古</option>
					<option value="甘肃">甘肃</option>
					<option value="宁夏">宁夏</option>
					<option value="青海">青海</option>
					<option value="新疆">新疆</option>
					<option value="西藏">西藏</option>
					<option value="四川">四川</option>
					<option value="云南">云南</option>
					<option value="贵州">贵州</option>
					<option value="广西">广西</option>
					<option value="广东">广东</option>
					<option value="福建">福建</option>
					<option value="海南">海南</option>
					<option value="湖南">湖南</option>
					<option value="湖北">湖北</option>
					<option value="江苏">江苏</option>
					<option value="浙江">浙江</option>
					<option value="江西">江西</option>
					<option value="山东">山东</option>
					<option value="安徽">安徽</option>
					<option value="香港">香港</option>
					<option value="澳门">澳门</option>
					<option value="台湾">台湾</option>

				</select>&nbsp;&nbsp;<font color="red"></font>
   			 </td>
    		</tr>
   		<tr>
   <th width="70px" align="right" style="margin-right:5px">联系人</th>
   		<td class="style1">&nbsp;<input name="contact" type="text" id="lianxiren"  style="width:350px;">&nbsp;
   			<font color="red">
   			</font>
       <font color="red"></font>
    </td>
   </tr>
   <tr>
   <th width="70px" align="right" style="margin-right:5px">电 &nbsp;话</th>
   <td class="style1">
   &nbsp;<input name="phone" type="text" id="dianhua"  style="width:350px;">&nbsp;&nbsp;<font color="red"></font>
    </td>
   </tr>
   <tr>
   <th width="70px" align="right" style="margin-right:5px">E-mail</th>
   <td class="style1">
   &nbsp;<input name="email" type="text" id="email"  style="width:350px;" placeholder="请务必留下邮箱，我们将以邮箱的方式回复您..."><font color="red">&nbsp;*</font>
   </td>
   </tr>

   <tr align="center">
	   <td colspan="2" height="25px">
		   <input type="submit" value="提交" >&nbsp;&nbsp;&nbsp;&nbsp;
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