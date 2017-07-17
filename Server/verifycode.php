<?php
//注意:此文加开头和结尾不能有任何字符输出！包括空白字符，因为要向客户端输出图片

//设置响应消息头的内容类型为图片
header("Content-Type:image/png");
//设置响应消息头，告诉浏览器不能缓存，因为这个图片是验证码，一直在变动的，不应该应用缓存
header("Cache-Control:no-cache");

//预定义图片的宽和高
$w = 100;
$h = 40;

//在服务器的内存中创建一幅图片
$img = imagecreate($w,$h);

//为图片分配一个颜色，作为背景色
imagecolorallocate($img,rand(20,160),rand(20,160),rand(20,160));

//在图片上绘制随机字符
$src = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
for($i=0;$i<4;$i++){
	$c = $src[rand(1,strlen($src)-1)];//字符串长度 strlen(字符串)
	$color = imagecolorallocate($img,rand(50,170),rand(50,170),rand(50,170));
	imagestring($img,5,10+$i*20,10,$c,$color);//图片,字体大小(1~5)，文字放到图片中x坐标值，文字放到图片中y坐标值，画在图片上的字符,字符颜色
}

//向客户端输出图片
imagepng($img);

//销毁内存中的图片
imagedestory($img);
?>