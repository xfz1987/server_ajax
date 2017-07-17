<?php
    /*1.接收客户端提交的表单数据
	   php系统预定义的变量
       $_GET array,保存着客户端通过GET方法提交数据
	   $_POST array 保存着客户端通过POST方法提交数据
	   $_REQUEST array 既可以get也可以post
	*/
	//echo var_dump($_REQUEST);
	$id = $_REQUEST["id"];
	$name = $_REQUEST["name"];
	$hiredate = $_REQUEST["hiredate"];
	$salary = $_REQUEST["salary"];
	
	//2.连接数据库
	$conn = mysqli_connect("localhost","root","","gzf_test","3306");
	//echo var_dump($conn);

	//3.将SQL发送到数据库服务器
	//3.1执行编码方式
	mysqli_query($conn,"set names utf8");

	//3.2把表单数据封装如一条SQL语句
	$sql = "insert into emp(id,name,hiredate,salary) values('$id','$name','$hiredate','$salary')";
	//echo $sql;
	$result = mysqli_query($conn,$sql);//DML成功 返回true  DQL成功 返回结果集
	//$result某一时刻最多保存一行记录	

	//4.关闭数据库(仅PHP默认在页面执行完成后自动执行)
	mysqli_close($conn);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" type="text/html" charset="utf-8"/>
	</head>

	<body>
		<h1>新纪录结果</h1>
		<?php
			if($result){
				echo "添加记录成功!";		
			}else{
				echo "添加记录失败!";
			}
		?>
		<hr>
		<a href="emp_all.php">查看所有学生记录</a>

	</body>
</html>
