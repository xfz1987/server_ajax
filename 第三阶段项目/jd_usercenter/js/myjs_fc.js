//我的京东导航效果
$("#main .nav li a").click(function(){
	//判断:如果当前点击元素已经是current就不再处理
	if(!$(this).hasClass("current")){
		//先将当前是current的元素对应的容器隐藏，然后去掉current类
		$("#" + $("#main .nav li a.current").attr("id") + "Container").hide();
		$("#main .nav li a.current").removeClass("current");
		//处理当前点击的元素
		$(this).addClass("current");
		$("#" + $(this).attr("id") + "Container").show();//找到对应的显示容器
	}
});


//订单状态:正式开发中应该是从数据库中读取
var orderState = ["","全部状态","等待付款","等待发货","派货中","订单完成","已删除"];

/**页面加载完成时，获取订单信息:默认第一页，全部状态**/
$(function(){
	loadOrders(1, 1);
});

//根据页码、订单状态，获取订单信息
function loadOrders(pageNo, orderState_curr){
	//先清空tbody中所有的内容
	$("#orderContainer table tbody").html("");
	//清除已有的分页信息
	$("#orderContainer .pager").html("");
	$.getJSON("user-order-list.php?user_name=丁当&page_num=" + pageNo + "&order_state=" + orderState_curr, function(obj){
		var pageCount = obj.pageCount;
		var data = obj.data;
		//显示所有的订单
		for(var i=0,len=data.length;i<len;i++){
			var order = data[i];
			var html = "<tr class='orderHeader'>"
					  +    "<td colspan='6'>"
					  +	       "<span>订单编号：" + order.order_num + "</span>"
					  +        "<a href='" + order.shop_url + "'>" + order.shop_name + "</a>"
					  +    "</td>"
				      +"</tr>"
					  +"<tr class='orderBody'>"
					  +	   "<td>";
			
			for(var j=0,len2=order.products.length;j<len2;j++){
				var p = order.products[j];
				html +=		   "<img src='" + p.product_img + "' title='" + p.product_name + "'>";
			}

			html +=        "</td>"
					+	   "<td>" + order.user_name + "</td>"
					+      "<td>￥" + order.price + "<br>" + order.payment_mode + "</td>"
					+	   "<td>" + order.submit_time.replace("T","<br>") + "</td>"
					+      "<td>" + orderState[order.order_state] + "</td>"
					+      "<td>"
					+	      "<a href='javascript:void(0)'>查看</a><br>"
					+		  "<a href='javascript:void(0)'>确认收货</a><br>"
					+		  "<a href='javascript:void(0)'>取消订单</a><"
					+         "</td>"
					+"</tr>";
			$("#orderContainer table tbody").append(html);
		}

		//显示分页条
		for(var k=1,len3=pageCount;k<=len3;k++){
			var linkOrSpan = null,
			    li = null;				
			if(k ==  obj.pageNum){
				linkOrSpan = $("<span>" + k + "</span>");
				li = $("<li class='current'></li>");
			}else{
				linkOrSpan = $("<a href='javascript:void(0)'>" + k + "</a>");
				linkOrSpan.click(function(){
					loadOrders($(this).html(),orderState_curr);

				});
				li = $("<li></li>");
			}			
			$("#orderContainer .pager").append(li.append(linkOrSpan));
		}
	});
}

$("#sel_order_state").change(function(){
	var state = $("#sel_order_state>option:selected").html();
	for(var i=1,len=orderState.length;i<len;i++){
		if(state == orderState[i]){
			var index = i;
			break;
		}
	}
	loadOrders(1, index);//每次改变状态后，应该以第一页开始显示
});

/*页面加载完成后，向服务器请求当前用户消费统计信息，输出在Canvas图形中*/
$(function(){
	//$.getJSON('user-statistic.php?user_name=丁当', function(arr){
		            var arr = [
                {"key":"1月","value":"500.00"},
                {"key":"2月","value":"1700.00"},
                {"key":"3月","value":"3000.00"},
                {"key":"3月","value":"3000.00"},
                {"key":"4月","value":"1000.00"},
                {"key":"5月","value":"2000.00"},
                {"key":"6月","value":"3500.00"},
                {"key":"7月","value":"500.00"},
                {"key":"8月","value":"0.00"},
                {"key":"9月","value":"1200.00"}
            ];
		var chart = new FusionCharts({
			type: 'column3d',//column3d  column2d  pie2d   pie3d
			renderAt: 'statContainer',
			width: '800',
			height: '600',
			dataFormat: 'json',
			dataSource:{
				chart:{},
				data:arr
			}
		});
		chart.render('statisticContainer'); //渲染
	//});
});









