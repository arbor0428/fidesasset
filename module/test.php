<?
exit;
include './class/class.DbCon.php';

$sql = "select * from ks_userClass order by uid asc";
$result = mysql_query($sql);
$num = mysql_num_rows($result);

for($i=0; $i<$num; $i++){
	$row = mysql_fetch_array($result);
	$uid = $row['uid'];
	$userNum = $row['userNum'];

	$phone01 = '';

	//신규회원정보
	$psql = "select * from ks_userlist where userNum='$userNum'";
	$presult = mysql_query($psql);
	$pnum = mysql_num_rows($presult);

	if($pnum){
		$prow = mysql_fetch_array($presult);
		$phone01 = $prow['phone01'];

	}else{
		//기존수강정보
		$psql = "select * from zz_classOrder where userNum='$userNum'";
		$presult = mysql_query($psql);
		$pnum = mysql_num_rows($presult);

		if($pnum){
			$prow = mysql_fetch_array($presult);
			$phone01 = $prow['mobile'];
		}
	}

	if($phone01){
		$usql = "update ks_userClass set phone01='$phone01' where uid='$uid'";
		$uresult = mysql_query($usql);
	}
}
?>