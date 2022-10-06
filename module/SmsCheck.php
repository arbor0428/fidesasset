<?
	include './class/class.DbCon.php';
	include './class/class.Util.php';

	$mobile01 = $_POST['data01'];
	$mobile02 = $_POST['data02'];
	$mobile03 = $_POST['data03'];
	$userip = $_SERVER[REMOTE_ADDR];
	$rTime = $_POST['rtyTime'];

	$sql = "select * from ks_sms_list where mobile01='$mobile01' and mobile02='$mobile02' and mobile03='$mobile03' and userip='$userip' and rTime='$rTime' order by uid desc limit 1";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$okNum = $row['okNum'];

	echo $okNum;
?>