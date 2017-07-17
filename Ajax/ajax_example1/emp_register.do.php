<?php
	sleep(5);
	$id = $_REQUEST["id"];
	$conn = mysqli_connect("localhost","root","","gzf_test","3306");
	$sql = "select count(1) len from emp where id=$id";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	if($row["len"] == 1){
		echo 1;//员工编号已存在
	}else{
		echo 0;//员工编号已被占用
	}
?>