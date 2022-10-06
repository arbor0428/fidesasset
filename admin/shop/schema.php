create table ks_product (
	uid int(11) PRIMARY KEY auto_increment,
	cade01 varchar(100),
	cade02 varchar(100),
	title varchar(100),
	icon varchar(100),
	oprice int(11),
	price int(11),
	baeja char(1),
	main varchar(10),
	upfile01 varchar(100),
	ment text,
	reg_date int(11)
);


cade01	//대분류
cade02	//소분류
title		//상품명
icon		//아이콘
oprice	//할인전가격
price		//판매가격
baeja		//신부(혼주)한복 배자여부
main부	//상품표시
upfile01	//이미지
ment		//상세설명

