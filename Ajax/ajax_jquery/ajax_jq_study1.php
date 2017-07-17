<?php
	$keywords = $_REQUEST["keywords"];
	$conn = mysqli_connect("localhost","root","","gzf_test","3306");
	$sql = "select pname from product where pname like '%$keywords%'";
	$result = mysqli_query($conn,$sql);
	$pro_list = []
	while(($row = mysqli_fetch_assoc($result)) != null){
		$pro_list[] = $row;	
	}
	$response = "<ul>";
	foreach($pro_list as $v){
		$response .= "<li>$v</li>";
	}
	$response .= "</ul>";	
	echo $response;
?>