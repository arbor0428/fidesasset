create table ks_cart (
	uid int(11) PRIMARY KEY auto_increment,
	userid varchar(50),
	ip varchar(50),
	pid int(11),
	gdate int(11),
	gdata01 varchar(50),
	gdata02 varchar(50),
	gdata03 varchar(50),
	gdata04 varchar(50),
	gdata05 varchar(50),
	gdata06 varchar(50),
	gdata07 varchar(50),
	gdata08 varchar(50),
	gdata09 text,
	gea int(11),
	mdate int(11),
	mdata01 varchar(50),
	mdata02 varchar(50),
	mdata03 varchar(50),
	mdata04 varchar(50),
	mdata05 text,
	mea int(11),
	reg_date int(11)
);