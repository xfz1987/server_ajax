<?php
/*返回所有省份的编号和名称*/
	$conn = mysqli_connect("localhost","root","","gzf_test","3306");
	mysqli_query($conn,"set names utf8");
	$sql = "select pid,pname from province";
	$result = mysqli_query($conn,$sql);
	$pro_list = [];
	while(($row = mysqli_fetch_assoc($result)) != null){
		$pro_list[] = $row;
	}
	mysqli_close($conn);
	//转换为XML字符串
	$xml = "<?xml version='1.0' encoding='UTF-8' standalone='yes' ?>";
	$xml .= "<province-list>";
	foreach($pro_list as $pro){
		$xml .= "<province pid='".$pro["pid"]."'>";
		$xml .= "<pname>".$pro["pname"]."</pname>";
		$xml .= "</province>";
	}
	$xml .= "</province-list>";
	//php默认向客户端输出的数据为text/html类型，需要重新设置成text/xml
	header("Content-Type:text/xml");
	echo $xml;
?>



