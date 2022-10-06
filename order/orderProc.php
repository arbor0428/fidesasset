<?
include '../module/login/head.php';
include '../module/class/class.DbCon.php';
include '../module/class/class.Util.php';
include '../module/class/class.Msg.php';

if($type == 'write'){
	$rDate = date('Y-m-d H:i:s');
	$rTime = mktime();


	//로그인한 회원의 과거 수강내역
	$usql = "select * from ks_userClass where userid='$userid' and reFund='' and (payMode!='' || payOk='결제확인') order by uid";
	$uresult = mysql_query($usql);
	$unum = mysql_num_rows($uresult);

	$uArr = Array();

	for($i=0; $i<$unum; $i++){
		$urow = mysql_fetch_array($uresult);
		$uArr[$i] = $urow['programID'];
	}


	//접수기간 및 정원확인
	$pArr = explode(',',$proList);

	$errorChk = '';

	for($i=0; $i<count($pArr); $i++){
		$uid = $pArr[$i];

		//프로그램정보
		$psql = "select * from ks_program where uid='$uid'";
		$presult = mysql_query($psql);
		$prow = mysql_fetch_array($presult);

		$pid = $prow['pid'];
		$title = $prow['title'];
		$aTime01 = $prow['aTime01'];
		$aTime02 = $prow['aTime02'];
		$oTime01 = $prow['oTime01'];
		$oTime02 = $prow['oTime02'];
		$maxNum = $prow['maxNum'];

		//정원확인
		if($maxNum){
			//해당 강좌를 신청한 회원수
			$usql = "select count(*) from ks_userClass where programID='$uid' and (payMode!='' || payOk='결제확인')";
			$uresult = mysql_query($usql);
			$unum = mysql_result($uresult,0,0);

			if($unum > $maxNum){
				if($errorChk)	$errorChk .= "\\n";
				$errorChk .= "[$title] : 정원초과입니다.";
			}
		}

		//신규회원 접수기간확인
		if($oTime01>=$rTime || $oTime02<=$rTime){
			//기존회원 접수기간확인
			if(in_array($pid,$uArr)){
				if($aTime01>=$rTime || $aTime02<=$rTime){
					if($errorChk)	$errorChk .= "\\n";
					$errorChk .= "[$title] : 접수기간이 아닙니다.";
				}

			}else{
				if($errorChk)	$errorChk .= "\\n";
				$errorChk .= "[$title] : 신규접수기간이 아닙니다.";
			}
		}
	}

	if($errorChk){
		Msg::GblMsgBoxParent($errorChk,'');
		exit;
	}




	//이용자정보확인
	$sql = "select * from ks_userlist where userid='$userid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$name = $row['name'];
	$userNum = $row['userNum'];
	$userType = $row['userType'];
	$reduction = $row['reduction'];
	$phone01 = $row['phone01'];

	//감면비율
	$rate = '';

	//온라인에서는 감면 적용안함
//	$userType = '';

	if($userType == '감면대상자'){
		if($reduction == '국민기초생활보장수급(생계/의료)')			$rate = '100';
		else if($reduction == '국민기초생활보장수급(주거/교육)')	$rate = '50';
		else if($reduction == '장애인(1~3급)')								$rate = '50';
		else if($reduction == '장애인(4~6급)')								$rate = '20';
		else if($reduction == '국가보훈대상(본인 및 직계가족)')		$rate = '50';
		else if($reduction == '차상위계층')									$rate = '50';
		else if($reduction == '다자녀가족')									$rate = '50';
		else if($reduction == '경로')											$rate = '50';
		else if($reduction == '직원')											$rate = '40';
	}


	$getDate = date('Y-m-d');
	$gArr = explode('-',$getDate);
	$getTime = mktime(0,0,0,$gArr[1],$gArr[2],$gArr[0]);
	$userip = $_SERVER[REMOTE_ADDR];

	$kcpAmt = 0;

	//결제정보
	if($payAmt == 0){
		$payMode = '현금';
		$payDate = date('Y-m-d H:i:s');
		$payTime = mktime();
		$billNum = '';
		$cashBill = '';
		$payOk = '결제확인';

	}else{
		$payDate = date('Y-m-d H:i:s');
		$payTime = mktime();
	}

	

	$pArr = explode(',',$proList);

	for($i=0; $i<count($pArr); $i++){
		$uid = $pArr[$i];

		//프로그램정보
		$psql = "select * from ks_program where uid='$uid'";
		$presult = mysql_query($psql);
		$prow = mysql_fetch_array($presult);

		$year = $prow['year'];
		$season = $prow['season'];
		$cade01 = $prow['cade01'];
		$period = $prow['period'];
		$eDate01 = $prow['eDate01'];	//교육기간
		$eTime01 = $prow['eTime01'];
		$eDate02 = $prow['eDate02'];
		$eTime02 = $prow['eTime02'];
		$cDate01 = $prow['cDate01'];	//환불불가일
		$cTime01 = $prow['cTime01'];
		$title = $prow['title'];
		$periodID = $prow['periodID'];
		$programID = $prow['uid'];
		$programAmt = $prow['amt'];
		$mTarget = $prow['mTarget'];
		$pid = $prow['pid'];		//기존프로그램

		//개별프로그램 등록시 설정된 수강료
		$etcAmt = ${'etcAmt_'.$uid};
		if($etcAmt)	$programAmt = $etcAmt;

		if($season == '상시' && $cade01 == '휘트니스센터'){
			$fitnessType = $prow["fitnessType"];

			//이용시작일
			$fitnessDate01 = ${'fitnessDate_'.$uid};
			$sArr = explode('-',$fitnessDate01);
			$fitnessTime01 = mktime(0,0,0,$sArr[1],$sArr[2],$sArr[0]);

			//이용종료일
			$fitnessDate02 = Util::lastDate($fitnessDate01,$fitnessType);
			$sArr = explode('-',$fitnessDate02);
			$fitnessTime02 = mktime(23,59,59,$sArr[1],$sArr[2],$sArr[0]);


		}else{
			$fitnessDate01 = '';		//이용시작일
			$fitnessTime01 = '';
			$fitnessDate02 = '';		//이용종료일
			$fitnessTime02 = '';
		}

		$breakDate01 = '';		//중도휴예기간
		$breakTime01 = '';
		$breakDate02 = '';
		$breakTime02 = '';

		//패키지신청
		$package = ${'package_'.$uid};
		if($package == 2)			$programAmt = 50000;
		elseif($package == 3)	$programAmt = 70000;

		//할인금액
		if($rate){
			$saleAmt = round($programAmt * ($rate/100));
			$saleChk = '1';

		}else{
			$saleAmt = 0;
			$saleChk = '';
		}

		$payAmt = $programAmt - $saleAmt;
		$kcpAmt += $payAmt;

		//장바구니ID를 통해 개별프로그램의 알림사항 확인
		$memo = '';
		$cid = ${'cid_'.$uid};
		if($cid){
			$sql = "select * from ks_cartList where uid='$cid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$memo = $row['etcMsg'];
		}

		//기존프로그램수강표시
		if(in_array($pid,$uArr))	$orderType = '1';
		else							$orderType = '';

		$sql = "insert into ks_userClass (userid,name,userNum,phone01,year,season,cade01,period,eDate01,eTime01,eDate02,eTime02,cDate01,cTime01,title,fitnessDate01,fitnessTime01,fitnessDate02,fitnessTime02,periodID,programID,programAmt,mTarget,reduction,health,getDate,getTime,breakDate01,breakTime01,breakDate02,breakTime02,payMode,saleAmt,payAmt,payDate,payTime,billNum,payOk,cashBill,userip,rDate,rTime,package,saleChk,cid,memo,orderType) values ";
		$sql .= "('$userid','$name','$userNum','$phone01','$year','$season','$cade01','$period','$eDate01','$eTime01','$eDate02','$eTime02','$cDate01','$cTime01','$title','$fitnessDate01','$fitnessTime01','$fitnessDate02','$fitnessTime02','$periodID','$programID','$programAmt','$mTarget','$reduction','$health','$getDate','$getTime','$breakDate01','$breakTime01','$breakDate02','$breakTime02','$payMode','$saleAmt','$payAmt','$payDate','$payTime','$billNum','$payOk','$cashBill','$userip','$rDate','$rTime','$package','$saleChk','$cid','$memo','$orderType')";

		$result = mysql_query($sql);

		//장바구니 비우기
		if($cid){
			$csql = "delete from ks_cartList where userid='$userid' and uid='$cid'";
			$cresult = mysql_query($csql);
		}
	}

	$sql = "update ks_userClass set kcpAmt='$kcpAmt' where userid='$userid' and userip='$userip' and rTime='$rTime'";
	$result = mysql_query($sql);

	$sql = "select * from ks_userClass where userid='$userid' and userip='$userip' and rTime='$rTime'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$uid = $row['uid'];


	Msg::GblMsgBoxParent("강좌신청이 접수되었습니다.","location.href='/mypage/order.php?type=view&uid=$uid';");
	exit;
}
?>