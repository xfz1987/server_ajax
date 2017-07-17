<?php
    //设置响应输出头
	header("Content-Type:application/json;charset=UTF-8");
	$dishes = [];
	$dishes[] = ["dno"=>101,"dname"=>"香辣肉丝"];
	$dishes[] = ["dno"=>102,"dname"=>"锅包肉"];
	$dishes[] = ["dno"=>103,"dname"=>"糖醋排骨"];	
	//将数组转换为JSON
	echo json_encode($dishes);
?>