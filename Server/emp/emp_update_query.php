<?php
	$id = $_REQUEST["id"];
	$conn = mysqli_connect("localhost","root","","gzf_test","3306");
	mysqli_query($conn,"set names utf8");
	$sql = "select * from emp where id=$id";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$name = $row["name"];
	$hiredate = $row["hiredate"];
	$salary = $row["salary"];
	mysqli_close($conn);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" type="text/html" charset="utf-8"/>
	</head>

	<body>
		<h1>修改员工[<?php echo $name;?>]的信息</h1>
		<form action="emp_update.do.php" method="post">
			<!--id隐藏-->
			<input type="hidden" name="id" value="<?php echo $id;?>"/><br/>
			员工姓名:<input type="text" name="name"  value="<?php echo $name;?>"/><br/>
			入职日期:<input type="text" name="hiredate" value="<?php echo $hiredate;?>"/><br/>
			基本工资:<input type="text" name="salary" value="<?php echo $salary;?>"/><br/>
			<input type="submit" value="保存"/>
			<input type="reset" value="取消"/>
		</form>
	</body>
</html>
