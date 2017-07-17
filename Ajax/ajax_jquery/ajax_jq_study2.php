<?php
	$id = $_REQUEST["id"];
	$conn = mysqli_connect("localhost","root","","gzf_test","3306");
	$sql = "select count(1) len from emp where id=$id";
	$result = mysqli_query($conn,$sql);
	$len = mysqli_fetch_assoc($result)["len"];
	if($len == 0){
	    echo 0;//数据库没有
	}else{
		echo 1;//数据库已经存在
	}
?>