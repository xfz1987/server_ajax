<?php
    /*根据客户端传递过来的id，返回其对应的工资*/
	$id = $_REQUEST["id"];
	$conn = mysqli_connect("localhost","root","","gzf_test","3306");
	$sql = "select salary from emp where id=$id";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	if($row == null){//id不存在
		echo -1;
	}else{
		echo $row["salary"];
	}
	mysqli_close($conn);
?>
