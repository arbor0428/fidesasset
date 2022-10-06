<?
If($GBL_USERID==""){
	echo("<script language=javascript>");
	echo(" alert('선택한 메뉴는 로그인이 필요한 메뉴입니다. 로그인을 해 주십시오');");
	echo("	location.href = '/?next_url=".$PHP_SELF."';");
	echo("</script>");
	exit();
}
?>