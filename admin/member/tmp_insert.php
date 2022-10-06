<?
exit;
include "../../module/class/class.DbCon.php";

$userArr = Array('김미화'=>'muse','우종필'=>'pil616','백종록'=>'bjr5799','허진광'=>'jk0947','박영배'=>'stagepark','박종연'=>'jyp','김병준'=>'jin99min','나화정'=>'hwajungna','김성은'=>'art_sound','고려민'=>'mingosss','권봉찬'=>'kbc','김안나'=>'hue','김주형'=>'itkim','신연민'=>'min','김주열'=>'normal1','유윤미'=>'yoom','이찬'=>'ichan','김보연'=>'boyeon88','박경숙'=>'sook7071','윤예림'=>'yerim20','김성희'=>'ddream','석주연'=>'skjy','김시철'=>'kisich','박진'=>'parkjin','최지영'=>'cjiyeong','하영인'=>'younginha');

foreach($userArr as $k => $v){
	$mtype = 'R';
	$userid = $v;
	$pwd = '1234';
	$name = $k;
	$userip = $_SERVER['REMOTE_ADDR'];
	$reg_date = mktime();

	$sql = "insert into tb_member (mtype,userid,pwd,name,userip,reg_date) values ('$mtype','$userid','$pwd','$name','$userip','$reg_date')";
	$result = mysql_query($sql);
}
?>