<?php
	//设置响应输出头
	header("Content-Type:application/json;charset=UTF-8");
	$conn = mysqli_connect("localhost","root","","gzf_test","3306");
	mysqli_query($conn,"set names utf8");
	if($_REQUEST == null){
		$sql = "select cid,uname,content,pubtime from comments";	
	}else{
		$cid = $_REQUEST["cid"];
		$sql = "select cid,uname,content,pubtime from comments where cid=$cid";
	}	
	$result = mysqli_query($conn,$sql);
	$comment_list = [];
	if($result){
		while(($row = mysqli_fetch_assoc($result)) != null){
			$comment_list[] = $row;
		}
		echo json_encode($comment_list);
	}else{
		echo "服务器出错，请联系管理员";
	}
?>