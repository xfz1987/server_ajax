<?php
   $sql = "select id,name,hiredate hd,salary sal from emp";
   $conn = mysqli_connect("localhost","root","","gzf_test","3306");
   //设置编码方式（php不知道数据库返回的数据编码方式）
   mysqli_query($conn,"set names utf8");
   $result = mysqli_query($conn,$sql);
   if(!$result){
	  echo "数据库错误！";
	  mysqli_close($conn);
	  exit(0);//终止当前页面的执行
   }
   
	$empList = [];
	/*从数据库申请获取下一行记录  
	  $row = mysqli_fetch_assoc($result);
	  当$row为空时则说明到数据的最后一行了
	*/
	while(($row = mysqli_fetch_assoc($result)) != null){
		$empList[] = $row;
	}
	mysqli_close($conn);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" type="text/html" charset="utf-8"/>
	</head>

	<body>
		<h1>员工列表</h1>
		<table border="1" width="500">
			<thead>
				<tr>
					<th>员工编号</th>
					<th>员工姓名</th>
					<th>入职日期</th>
					<th>基本工资</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($empList as $emp){
				?>
				<tr>
				<?php
					foreach($emp as $value){
				?>
					<td align="center">
				<?php
					echo $value;
				?>
					</td>
				<?php
					}
				?>
					<td align="center">
						<a href="emp_update_query.php?id=<?php echo $emp["id"];?>">修改</a>
						<a href="emp_delete.php?id=<?php echo $emp["id"];?>">删除</a>
					</td>
				<?php
					}
				?>
			</tbody>
		</table>
	</body>
</html>
