<?php
   $id = $_REQUEST["id"];
   $name = $_REQUEST["name"];
   $hiredate = $_REQUEST["hiredate"];
   $salary = $_REQUEST["salary"];
   $conn = mysqli_connect("localhost","root","","gzf_test","3306");
   //设置编码方式（php不知道数据库返回的数据编码方式）
   mysqli_query($conn,"set names utf8");
   $sql = "update emp set name='$name',hiredate='$hiredate',salary=$salary where id=$id";
   echo $sql;
   $result = mysqli_query($conn,$sql);
   mysqli_close($conn);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" type="text/html" charset="utf-8"/>
	</head>

	<body>
		<h1>修改员工信息执行结果:</h1>
		<hr>
		<?php
			if($result){
				echo "修改成功!";	
			}else{
				echo "修改成功!";
			}
		?>
		<hr>
		<a href="emp_all.php">查看所有学生记录</a>
	</body>
</html>
