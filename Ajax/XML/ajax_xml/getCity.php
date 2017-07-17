<?php
	$pid = $_REQUEST["pid"];
	$conn = mysqli_connect("localhost","root","","gzf_test","3306");
	mysqli_query($conn,"set names utf8");
	$sql = "select cid,cname from city where provinceid=$pid";	
	$result = mysqli_query($conn,$sql);
	$city_list = [];
	while(($row = mysqli_fetch_assoc($result)) != null){
		$city_list[] = $row;
	}
	mysqli_close($conn);
	
	//转换为XML字符串
	$xml = "<?xml version='1.0' encoding='UTF-8' standalone='yes'?>";
	$xml .= "<city-list provinceid='$pid'>";
	foreach($city_list as $city){
		$xml .= "<city cid='".$city["cid"]."'>";
		$xml .= "<cname>".$city["cname"]."</cname>";
		$xml .= "</city>";
	}
	$xml .= "</city-list>";
	//php默认向客户端输出的数据为text/html类型，需要重新设置成text/xml
	header("Content-Type:text/xml");
	echo $xml;
?>


