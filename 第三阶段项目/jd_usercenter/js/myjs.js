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
	$.getJSON("user-statistic.php?user_name=丁当",function(arr){
		drawStat(arr);
	})
});

/*根据统计信息绘制曲线图*/
function drawStat(data){
	var canvas = document.getElementById("statCanvs");
	var padding = 80; //canvas内容内边距
	var ch = canvas.height;//高
	var cw = canvas.width;//宽	
	var or = {x:padding, y:ch - padding};//原点
	var br = {x:cw - padding, y:ch - padding};//x轴的右端点
	var lt = {x:padding, y:padding};//y轴的上端点
	
	//获得2D上下文对象
	var ctx = canvas.getContext("2d");
	
	//绘制x坐标轴
	ctx.beginPath();
	ctx.moveTo(or.x,or.y);//将画笔先移动到原点
	ctx.lineTo(br.x,br.y);//画出x轴
	ctx.stroke();//绘制轮廓
	//绘制y坐标轴
	ctx.moveTo(or.x,or.y);
	ctx.lineTo(lt.x,lt.y);
	ctx.stroke();
	
	//绘制x轴箭头
	ctx.beginPath()
	ctx.moveTo(br.x,br.y);
	ctx.lineTo(br.x-5,br.y-5);
	ctx.lineTo(br.x-5,br.y+5);
	ctx.fill();
	//绘制y轴箭头
	ctx.beginPath();
	ctx.moveTo(lt.x,lt.y);
	ctx.lineTo(lt.x+5,lt.y+5);
	ctx.lineTo(lt.x-5,lt.y+5);
	ctx.fill();

	//绘制x轴的刻度线
	//刻度数: 数据的数量-1：因为原点也是也数量呀
	//每一个刻度的宽度: (总宽度 - 2padding - 适应值)/刻度数
	ctx.beginPath();
	var avgWidth = Math.floor((cw - 2 * padding - 50)/(data.length - 1));			
	for(var i=0,len=data.length;i<len;i++){
		if(i > 0 ){
			ctx.moveTo(or.x + i * avgWidth, or.y);	
			ctx.lineTo(or.x + i * avgWidth, or.y - 10);
		}
		//填上文字
		ctx.font = "16px SimHei";
		ctx.textBaseline = "top";
		ctx.fillText(data[i].key, or.x + i * avgWidth - 10, or.y + 5);
	}
	ctx.stroke();
	
	//绘制y轴的刻度线
	//获取y轴数据的最大值
	ctx.beginPath();
	var avgHeight = Math.floor((ch - 2 * padding - 50)/(data.length - 1));
	var max = 0;
	for(var i=0,len=data.length;i<len;i++){
		var temp = parseInt(data[i].value)
		max = temp > max ? temp : max;	
		ctx.moveTo(or.x, or.y - i * avgHeight);
		ctx.lineTo(or.x + 10, or.y - i * avgHeight);
		
		
	}
	
	//y轴填上文字
	var avgValue = Math.floor(max/(data.length - 1));
	for(var i=0,len=data.length;i<len;i++){
		ctx.font = "16px SimHei";
		ctx.fillText(avgValue * i,or.x - 30, or.y - i * avgHeight - 8);
	}
	ctx.stroke();

	//开始画折线图
	for(var i=0,len=data.length;i<len;i++){
		//画圆形
		ctx.fillStyle = "blue";
		ctx.beginPath();
		ctx.arc(or.x + i * avgWidth, or.y - (parseInt(data[i].value)/avgValue) * avgHeight, 4, 0, Math.PI*2);
		ctx.fill();

		//画折线图
		ctx.beginPath();
		if(i < len - 1){
			ctx.moveTo(or.x + i * avgWidth, or.y - (parseInt(data[i].value)/avgValue) * avgHeight);
			ctx.lineTo(or.x + (i+1) * avgWidth, or.y - (parseInt(data[i+1].value)/avgValue) * avgHeight);
		}
		
		//填写文字
		ctx.font = "16px SimHei";
		ctx.textBaseline = "bottom";
		ctx.fillText(data[i].value, or.x + i * avgWidth, or.y - (parseInt(data[i].value)/avgValue) * avgHeight, 
			or.y - (parseInt(data[i].value)/avgValue) * avgHeight);
		ctx.stroke();
	}
}

/*幸运抽奖*/
//加载圆盘和指针
$(function(){
	var asImgReady = false;
	var pinImgReady = false;
	var asImg = new Image();
	asImg.src = "img/as.png";//图片属于异步Ajax的加载，需要时间，所以需要onload判断是否加载完成
	asImg.onload = function(){//onload是异步方法，所以判断必须放在onload里面，在外面永远都是false
		asImgReady = true;
		if(pinImgReady){//问问下一张图片有没有加载完毕
			initLottery();
		}
	}
	var pinImg = new Image();
	pinImg.src = "img/pin.png";
	pinImg.onload = function(){
		pinImgReady = true;
		//如果两张图片同时加载完成后，改变按钮的相关处理
		if(asImgReady){//问问上一张图片有没有加载完毕
			initLottery();
		}
	};
	/*只有一个判断能生效，所以两张图片都要询问对方是否加载完成*/

	function initLottery(){
		//绘制Canvas
		var canvas = $("#loteryCanvas").get(0);
		var ctx = canvas.getContext("2d");
		var cw = canvas.width;//600
		var ch = canvas.height;//600
		var asw = asImg.width;//圆盘的宽
		var ash = asImg.height;//圆盘的高
		var pw = pinImg.width;//指针的宽
		var ph = pinImg.height;//自侦的高
		//设置画布的位移，使其旋转轴心为画布的中心
		ctx.translate(cw/2,ch/2);
		ctx.drawImage(asImg,-asw/2,-ash/2);//将图片的中心移动到画布的中心
		ctx.drawImage(pinImg,-pw/2+10,-ph/2-10);//指针图片中心不精确，自己微调一下
		//给按钮添加样式和事件
		var isClicked = false;
		$("#lotteryContainer button").html("开始抽奖").css("color","red").click(function(){
			$(this).html("正在抽奖").css("color","blue");
			if(!isClicked){
				isClicked = true;
				var duration = (Math.random()*15 + 5) * 1000;
				var startTime = new Date().getTime();
				var angle = 0;
				//var timer = setInterval(repaint,10);
				var ti = 10;
				setTimeout(repaint,ti);
				var currTime = 0;
				function repaint(){
					currTime = new Date().getTime();
					if(currTime > (startTime + duration)){
						$("#lotteryContainer button").html("开始抽奖").css("color","red");
						isClicked = false;
						return;
					}
					//清除画布内容
					ctx.clearRect(-cw/2,-ch/2,cw,ch);
					ctx.drawImage(asImg,-asw/2,-ash/2);
					angle += 5 * Math.PI/180;
					ctx.rotate(angle);
					ctx.drawImage(pinImg,-pw/2+10,-ph/2-10);//圆盘不动，指针动
					ctx.rotate(-angle);//全部转回去
					setTimeout(repaint,ti++);
				}
			}
		});
	}
});








