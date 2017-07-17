drop database if exists jd;
create database jd;
use jd;
create table product(
    pro_id int primary key auto_increment,
    pro_name varchar(50) not null,
    pro_price double(5,2),
    pro_photo varchar(100),
    pro_date date,
    pro_desc varchar(100)
);
create table jd_user(
    user_id int primary key auto_increment,
    user_name varchar(50) not null,
    user_photo varchar(100),
    user_level varchar(2) not null,
    user_address varchar(50)
);
create table comment(
    c_id int primary key auto_increment,
    user_id int not null,
    pro_id int not null,
    c_time date not null,
    c_txt varchar(200)
);
create index pro_index on product(pro_id);
create index user_index on jd_user(user_id);
create index comment_index on comment(pro_id,user_id);

