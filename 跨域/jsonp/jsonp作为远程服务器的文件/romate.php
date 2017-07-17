<?php
	sleep(5);
	$sname=$_REQUEST['sname'];
	$createFun = $_REQUEST["callback"];
	$conn=mysqli_connect("localhost","root","","web1504","3306");
	$result = mysqli_query($conn, "select score from student where sname='$sname'");
	$row = mysqli_fetch_assoc($result);
	$date = $createFun."(".json_encode($row).")";
	echo $date;
?>