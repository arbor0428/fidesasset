<?
	//관리자수신번호
	$sql = "select * from ks_sms_config order by uid desc limit 1";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$nlist = $row['nlist'];

	$nlistArr = explode(',',$nlist);
	$nlistTot = count($nlistArr);

	unset($dbconn);
	mysql_close();





	//주문자 전화번호
	$call_no = $ohp1.$ohp2.$ohp3;

	//발신번호
	$callback = '1661-2399';






	include "../module/class/.DbConSmsHub.php";


	//업체 아이디
	$SMS_ADMIN = 'jinsung';



	//관리자 포인트 가져오기
	$sql = "select * from ks_user where userid='$SMS_ADMIN'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$point = $row['point'];	//관리자 포인트
	$sms_point = $point / 20;				//전송가능한 수


	$SMS_TIME = date('YmdHis');




	//주문자 문자발송
	if($call_no && $sms_point > 0){
		$msg = '[황금미트]\n주문번호('.$reg_date.')\n상품주문이 완료되었습니다';

		$sql = "insert into SMS_SEND (SCHEDULE_TYPE, SMS_MSG, SAVE_TIME, SEND_TIME, CALLBACK, CALLEE_NO, RESERVED1, RESERVED2) values ";
		$sql .= "('0','$msg','$SMS_TIME','$SMS_TIME','$callback','$call_no','$SMS_ADMIN','$SMS_ADMIN');";
		$result = mysql_query($sql);

		$sms_point -= 1;
	}




	//관리자 수신번호 수
	if($nlistTot > 0 && $sms_point > 0){
		$msg = '['.$oname.']님 상품주문이 접수되었습니다';

		for($i=0; $i<$nlistTot; $i++){
			$call_no = $nlistArr[$i];

			if($call_no){
				$sql = "insert into SMS_SEND (SCHEDULE_TYPE, SMS_MSG, SAVE_TIME, SEND_TIME, CALLBACK, CALLEE_NO, RESERVED1, RESERVED2) values ";
				$sql .= "('0','$msg','$SMS_TIME','$SMS_TIME','$callback','$call_no','$SMS_ADMIN','$SMS_ADMIN');";
				$result = mysql_query($sql);

				$sms_point -= 1;
			}

		}
	}


	$setPoint = $sms_point * 20;


	$sql = "update ks_user set point='$setPoint' where userid='$SMS_ADMIN'";
	$result = mysql_query($sql);
?>