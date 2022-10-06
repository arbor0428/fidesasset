<?
	include './class/class.DbCon.php';
	include './class/class.Util.php';

	$pid = $_POST['pid'];
	$mobile01 = $_POST['data01'];
	$mobile02 = $_POST['data02'];
	$mobile03 = $_POST['data03'];

	$okNum = Util::MakeOkNumber();
	$userip = $_SERVER[REMOTE_ADDR];
	$rDate = date('Y-m-d H:i:s');
	$rTime = $_POST['rtyTime'];

//	$okNum = '123456';

	$sql = "insert into ks_sms_list (pid,mobile01,mobile02,mobile03,okNum,userip,rDate,rTime) values ('$pid','$mobile01','$mobile02','$mobile03','$okNum','$userip','$rDate','$rTime')";
	$result = mysql_query($sql);


	mysql_close($dbconn);
	unset($db);
	unset($dbconn);

	$SMS_ADMIN = 'efac';
	$call_no = $mobile01.$mobile02.$mobile03;

	//sms 데이터베이스 접속
	include './class/class.DbConSmsHub.php';
	include './SmsHub.php';


	echo 'ok';
?>