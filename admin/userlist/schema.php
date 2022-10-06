drop table ks_userlist;
create table ks_userlist (
	uid int(11) PRIMARY KEY auto_increment,
	status char(1) default '',
	userid varchar(50),
	pwd varchar(50),
	name varchar(50),
	userNum varchar(50),
	userOrder int(11),
	sex varchar(5),
	bDate varchar(30),
	bTime int(11),
	userType varchar(100),
	car varchar(5),
	carNum varchar(50),
	zipcode varchar(5),
	addr01 varchar(100),
	addr02 varchar(100),
	email01 varchar(50),
	email02 varchar(50),
	phone01 varchar(50),
	phone01Txt varchar(50),
	phone02 varchar(50),
	phone02Txt varchar(50),
	memo text,
	reduction varchar(50),
	upfile01 varchar(100),
	realfile01 varchar(100),
	cok varchar(5),
	cokPost varchar(30),
	cokSms varchar(30),
	cokEmail varchar(30),
	cokPhone varchar(30),
	health text,
	healthBaby varchar(30),
	healthEtc varchar(50),
	joinType varchar(100),
	getDate varchar(30),
	getTime int(11),
	rDate varchar(50),
	rTime int(11)
);