CREATE TABLE province(
	pid INT,
	pname VARCHAR(16),
	PRIMARY KEY(pid)
);
INSERT INTO province(pid, pname) VALUES
(10, '北京市'),
(20, '上海市'),
(30, '河北省'),
(40, '浙江省');

CREATE TABLE city(
	cid INT AUTO_INCREMENT,
	cname VARCHAR(16),
	provinceid INT,
	PRIMARY KEY(cid)
);
INSERT INTO city(cid,cname,provinceid) VALUES
(NULL,'东城区',10),
(NULL,'西城区',10),
(NULL,'海淀区',10),
(NULL,'朝阳区',10),
(NULL,'浦东区',20),
(NULL,'浦西区',20),
(NULL,'闵行区',20),
(NULL,'金山区',20),
(NULL,'石家庄市',30),
(NULL,'廊坊市',30),
(NULL,'唐山市',30),
(NULL,'秦皇岛市',30),
(NULL,'承德市',30),
(NULL,'杭州市',40),
(NULL,'宁波市',40),
(NULL,'台州市',40),
(NULL,'温州市',40),
(NULL,'绍兴市',40),
(NULL,'嘉兴市',40);
SELECT * FROM province;
SELECT * FROM city;
