<?php
	/*返回用户最近几个月的消费信息*/
	header("Content-Type:application/json;charset=UTF-8");
	//$user_name = $_REQUEST["user_name"];

	$output = [];
	$output[] = ["key"=>"3月","value"=>"3000.00"];
	$output[] = ["key"=>"4月","value"=>"1000.00"];
	$output[] = ["key"=>"5月","value"=>"2000.00"];
	$output[] = ["key"=>"6月","value"=>"3500.00"];
	$output[] = ["key"=>"7月","value"=>"500.00"];
	$output[] = ["key"=>"8月","value"=>"0.00"];
	$output[] = ["key"=>"9月","value"=>"1200.00"];

	echo json_encode($output);
?>