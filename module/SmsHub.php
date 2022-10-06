<?
if($SMS_ADMIN && $_SERVER[REMOTE_ADDR] == '106.246.92.237'){

	//발신번호
	$callback = '02-351-3017';


	//관리자 포인트 가져오기
	$sql = "select * from ks_user where userid='$SMS_ADMIN'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$point = $row['point'];			//관리자 포인트
	$sms_point = $point / 20;		//전송가능한 수

	$point_set = false;	//포인트 재설정여부




	$SMS_TIME = date('YmdHis');



	if($sms_point > 0 && $call_no){
		$SMS_MSG = "[은평문화재단] 인증번호는 ".$okNum." 입니다.";

		if($call_no){
			$sql = "insert into SMS_SEND (SCHEDULE_TYPE, SMS_MSG, SAVE_TIME, SEND_TIME, CALLBACK, CALLEE_NO, RESERVED1, RESERVED2, RESERVED3, RESERVED5) values ";
			$sql .= "('0','$SMS_MSG','$SMS_TIME','$SMS_TIME','$callback','$call_no','$SMS_ADMIN','ok','$pid','');";
			$result = mysql_query($sql);

			$sms_point -= 1;
			$point_set = true;
		}
	}










	//문자를 전송하여 관리자 포인트를 재설정해야 하는 경우.
	if($point_set){
		$setPoint = $sms_point * 20;

		$sql = "update ks_user set point='$setPoint' where userid='$SMS_ADMIN'";
		$result = mysql_query($sql);
	}


}
?>