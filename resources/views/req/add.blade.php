<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="/req/insert" method="post">
		{{csrf_field()}}
		用户:<input type="text" name="uname" value="{{old('uname')}}"><br><br>
		邮箱:<input type="text" name="email" value="{{old('email')}}"><br><br>
		电话:<input type="text" name="phone" value="{{old('phone')}}"><br><br>
		地址:<input type="text" name="address" value="{{old('address')}}"><br><br>
		<input type="submit" value="提交"><br><br>
	</form>
</body>
</html>