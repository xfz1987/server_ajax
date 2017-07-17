<?php
	//我的订单查询列表
	header("Content-Type:application/json;charset=UTF-8");
	$user_name = $_REQUEST["user_name"];
	$order_state = (int)$_REQUEST["order_state"];
	
	//分页处理
	$page_num = @$_REQUEST["page_num"];//@符号表示抑制错误提示
	$page_num = empty($page_num) ? 1 : $page_num;//如果前台没有传来页号,默认显示第一页内容
	$page_size = 5;//每页最多显示5条记录
	
	$conn = mysqli_connect("localhost","root","","jd","3306");
	mysqli_query($conn,"set names utf8");

	//获得总页数
	$sql = "select count(*) len from jd_orders where user_name='$user_name'";
	if($order_state != 1){
		$sql .= " and order_state=$order_state";
	}

	$len = mysqli_query($conn,$sql);
	//echo $sql."<br>";
	$row_count = mysqli_fetch_assoc($len)["len"];
	$page_count = ceil($row_count/$page_size);
	//echo $row_count."<br>";
	//echo $page_count."<br>";
	
	//获得订单相关信息
	$start = ($page_num - 1) * $page_size;
	$sql = "select * from jd_orders where user_name='$user_name'";//分页处理
	
	if($order_state != 1){
		$sql .= " and order_state=$order_state";
	}

	$sql .= " limit $start,$page_size";

	$result = mysqli_query($conn, $sql);
	$output = [];  //用于保存用户所有订单的二维数组
	while(($row=mysqli_fetch_assoc($result))!==NULL){
		$oid = $row["order_id"];  //查看指定订单编号所购买的商品的信息
		$sql="SELECT * FROM jd_products WHERE product_id IN ( SELECT product_id FROM jd_order_product_detail WHERE order_id=$oid )";
		$productResult = mysqli_query($conn, $sql);
		$products = [];
		while(($p=mysqli_fetch_assoc($productResult))!==NULL){
			$products[] = $p;
		}
		$row["products"] = $products; //获取当前订单对应的所有产品
		$output[] = $row;  //把当前订单保存入订单数组
	}
	
	//关闭数据库
	mysqli_close($conn);

	//封装输出内容
	$final_output = [
		"pageCount" => $page_count,
		"pageNum" => $page_num,
		"data" => $output
	];

	//以JSON格式向客户端输出查询的订单列表
	echo json_encode($final_output);

?>