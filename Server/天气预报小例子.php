<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>未来三天全国天气预报</title>
	</head>
	<body>
		<h2>未来三天全国天气预报</h2>
		<h3>达内科技，转自中国气象局</h3>
		<hr/>
		<?php
			$url = 'http://www.weather.com.cn/index/zxqxgg1/wlstyb.shtml';
			/*
				PHP语言中的 file_get_contents($filename) 函数可以一次性读取并返回指定文件中的所有内容，
				* 参数 $filename 除了可以是服务器端的某个文件名，还可以是任意合法的URL
				* 利用此函数可以实现在PHP服务器端读取任意互联网上任意网站公开的页面中的内容。
			*/
			$str = file_get_contents($url);
			/*
			  通过深入的分析$str中的内容，发现天气预报的主体内容全部处于下述div中：
              <div class="content_doc">
                  <h3>标题</h3>
                  <div class="content_section_topbar clearfix">发布时间和来源，以及字体选择</div>
                  <p></p>...<p></p>
              </div>
            上述那些<p>标签中的内容即是天气预报的主体
           */
           $reg = '/<div class="content_doc"><h3>(.*)<\/h3><div class="content_section_topbar clearfix">(.*)<\/div>(.*)<\/div>/iU';  //i忽略大小写 U非贪婪匹配
           preg_match($reg, $str, $matches);
           echo $matches[3];
		?>
	</body>
</html>