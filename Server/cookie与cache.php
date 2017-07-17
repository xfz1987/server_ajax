<?php
    setcookie("age","22");//服务器向客户端发送一个cookie
	header("Cache-Control:no-cache");//告诉浏览器不要缓存
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" type="text/html" charset="utf-8"/>
	</head>

	<body>
		<h1>cookie使用</h1>

		<script>
			document.cookie = "name=shit";
		</script>
	</body>
</html>