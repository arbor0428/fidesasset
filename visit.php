<?
$refel = $_SERVER[HTTP_REFERER];	//이전url
$nurl = $_SERVER[HTTP_HOST];	//현재접속url
$rurl = $_SERVER[SERVER_NAME];	//실제서버url
$uip = $_SERVER[REMOTE_ADDR];	//접속아이피


if(!strpos(strtolower($refel),$nurl)){
	$reg_date = mktime();
	$datey = date('Y',$reg_date);
	$datem = date('m',$reg_date);
	$dated = date('d',$reg_date);

	$sql = "insert into tb_visit_log (reg_date,refel,nurl,uip,datey,datem,dated) values ('$reg_date','$refel','$nurl','$uip','$datey','$datem','$dated')";
	$result = mysql_query($sql);
}
?>


<!-- 방문자 카운터
<?
	//총방문자
	$sql = "select count(*) from tb_visit_log";
	$result = mysql_query($sql);
	$visit_tot = mysql_result($result,0,0);
	$visit_tot = number_format($visit_tot).'명';

	//오늘방문자
	$datey = date('Y');
	$datem = date('m');
	$dated = date('d');
	$sql = "select count(*) from tb_visit_log where datey='$datey' and datem='$datem' and dated='$dated'";
	$result = mysql_query($sql);
	$visit_today = mysql_result($result,0,0);
	$visit_today = number_format($visit_today).'명';
?>
/방문자 카운터 -->