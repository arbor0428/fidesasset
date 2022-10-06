<?
include '../module/login/head.php';
include '../module/class/class.DbCon.php';
include '../module/class/class.Msg.php';


if($type == 'write'){
	$sql = "select count(*) from tb_member where userid='$userid'";
	$result = mysql_query($sql);
	$record_cnt = mysql_result($result,0,0);

	if($record_cnt == 0){
		$sql = "select count(*) from ks_userlist where userid='$userid'";
		$result = mysql_query($sql);
		$record_cnt = mysql_result($result,0,0);
	}


	//가입된 아이디 중복확인 및 관리자 아이디와 중복확인
	if($record_cnt > 0){
		$msg = "사용할 수 없는 아이디입니다.";
		Msg::backMsg($msg);
		exit;
	}

	$status = '';
	$mtype = '';
	$team = '';
	$pos = '';
	$userip = $_SERVER[REMOTE_ADDR];
	$rDate = date('Y-m-d H:i:s');
	$rTime = mktime();


	$sql = "insert into tb_member (status,mtype,userid,pwd,name,pnum,team,pos,mobile01,mobile02,mobile03,email01,email02,userip,rDate,rTime) values ";
	$sql .= "('$status','$mtype','$userid','$pwd','$name','$pnum','$team','$pos','$mobile01','$mobile02','$mobile03','$email01','$email02','$userip','$rDate','$rTime')";
	$result = mysql_query($sql);
?>

<script language='javascript'>
parent.$(".multiBox_close").click();
parent.GblMsgBox("강사등록신청이 접수되었습니다.\n관리자 승인 후 로그인 및 서비스 이용이 가능합니다.","");
</script>

<?
}
?>