drop table zz_member;

create table zz_member (
	uid int(11) PRIMARY KEY auto_increment,
	year  varchar(5),
	userNum varchar(50),
	name varchar(50),
	mobile varchar(50),
	email01 varchar(50),
	email02 varchar(50),
	bDate varchar(50),
	bTime int(11),
	zipcode  varchar(5),
	addr01 varchar(255)
);

drop table zz_classOrder;

create table zz_classOrder (
	uid int(11) PRIMARY KEY auto_increment,
	userNum varchar(50),
	name varchar(50),
	mobile varchar(50),
	title varchar(255),
	pDate varchar(50),
	pTime int(11),
	amt int(11),
	sDate varchar(50),
	sTime int(11),
	eDate varchar(50),
	eTime int(11)
);