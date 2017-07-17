<?php
	header("Content-Type:text/plain");
	$uname = $_REQUEST["uname"];
	$content = $_REQUEST["content"];
	$pubtime = $_REQUEST["pubtime"];
	$conn = mysqli_connect("localhost","root","","gzf_test","3306");
	mysqli_query($conn,"set names utf8");
	$sql = "insert into comments(cid,uname,content,pubtime) values(null,'$uname','$content',$pubtime)";
	$result = mysqli_query($conn,$sql);
	if($result){
		echo mysqli_insert_id($conn);
	}else{
		echo -1;
	}
	mysqli_close($conn);
?>