SET NAMES UTF8;

DROP DATABASE IF EXISTS jd;
CREATE DATABASE jd CHARSET UTF8;
USE jd;

-- --------------------------------------------------------

--
-- 表的结构 `jd_orders`
--

CREATE TABLE IF NOT EXISTS `jd_orders` (
  `order_id` int(11) NOT NULL,
  `order_num` varchar(10) NOT NULL,
  `shop_name` varchar(40) NOT NULL,
  `shop_url` varchar(100) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `price` decimal(16,2) NOT NULL,
  `payment_mode` varchar(10) NOT NULL,
  `submit_time` varchar(20) NOT NULL,
  `order_state` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='订单表';

--
-- 转存表中的数据 `jd_orders`
--

INSERT INTO `jd_orders` (`order_id`, `order_num`, `shop_name`, `shop_url`, `user_name`, `price`, `payment_mode`, `submit_time`, `order_state`) VALUES
(1, '9545709796', 'BROWNE FOX旗舰店', 'http://mall.jd.com/index-119003.html', '丁当', '21.90', '在线支付', '2015-5-30T13:40:20', 2),
(2, '9195223439', '京东自营', 'http://mall.jd.com', '丁当', '24.80', '货到付款', '2015-5-10T15:20:20', 3),
(3, '9545656843', '京东自营', 'http://mall.jd.com', '丁当', '22.90', '在线支付', '2015-05-05T9:14:20', 3),
(4, '9130907509', '京东自营', 'http://mall.jd.com', '丁当', '3567.50', '在线支付', '2015-04-23T9:14:20', 3);

-- --------------------------------------------------------

--
-- 表的结构 `jd_order_product_detail`
--

CREATE TABLE IF NOT EXISTS `jd_order_product_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jd_order_product_detail`
--

INSERT INTO `jd_order_product_detail` (`id`, `order_id`, `product_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 3, 4),
(5, 4, 5),
(6, 4, 3);

-- --------------------------------------------------------

--
-- 表的结构 `jd_products`
--

CREATE TABLE IF NOT EXISTS `jd_products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_url` varchar(100) NOT NULL,
  `product_img` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `jd_products`
--

INSERT INTO `jd_products` (`product_id`, `product_name`, `product_url`, `product_img`) VALUES
(1, '【限量秒杀】男士时尚韩版腰带加宽针扣潮商务皮带azkz A款针扣咖啡色', 'http://item.jd.com/1540292153.html', 'img/prod1.jpg'),
(2, 'BROWNE FOX通用皮带打孔器打孔针打孔冲子皮带冲子ZD-111 银色', 'http://item.jd.com/1604745360.html', 'img/prod2.jpg'),
(3, '阿迪达斯（adidas）男士健发强根去屑洗发露 220ml', 'http://item.jd.com/1070276.html', 'img/prod3.jpg'),
(4, '金士顿（Kingston） DT 101G2 8GB U盘 红色 经典之作', 'http://item.jd.com/1070276.html', 'img/prod4.jpg'),
(5, '苹果(Apple) iPhone 5s (A1518) 16GB 金色 移动4G手机', 'http://item.jd.com/1023433.html', 'img/prod5.jpg');


--
-- Indexes for table `jd_orders`
--
ALTER TABLE `jd_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `jd_order_product_detail`
--
ALTER TABLE `jd_order_product_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jd_products`
--
ALTER TABLE `jd_products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jd_orders`
--
ALTER TABLE `jd_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jd_order_product_detail`
--
ALTER TABLE `jd_order_product_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `jd_products`
--
ALTER TABLE `jd_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
