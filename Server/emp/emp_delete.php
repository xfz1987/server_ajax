<?php
	$id = $_REQUEST["id"];
	$sql = "delete from emp where id=$id";
	$conn = mysqli_connect("localhost","root","","gzf_test","3306");
	$result = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" type="text/html" charset="utf-8"/>
	</head>

	<body>
		<h1>删除操作执行结果:</h1>
		<?php
			if($result){
				echo "成功";
			}else{
				echo "失败";
			}	
		?>
		<hr>
		<a href="emp_all.php">返回学生列表</a>
	</body>
</html>
