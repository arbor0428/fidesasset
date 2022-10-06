<?
	$kcpAmt = $good_mny;
	$rDate = date('Y-m-d H:i:s');
	$rTime = mktime();


	//로그인한 회원의 과거 수강내역
	$usql = "select * from ks_userClass where userid='$userid' and reFund='' order by uid";
	$uresult = mysql_query($usql);
	$unum = mysql_num_rows($uresult);

	$uArr = Array();

	for($i=0; $i<$unum; $i++){
		$urow = mysql_fetch_array($uresult);
		$uArr[$i] = $urow['programID'];
	}

	//가을학기 앞서가는 코딩 고급반 A/B처리
	if(in_array(121,$uArr)){
		$uArr[] = 122;
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
		$season = $prow['season'];
		$cade01 = $prow['cade01'];
		$aTime01 = $prow['aTime01'];
		$aTime02 = $prow['aTime02'];
		$oTime01 = $prow['oTime01'];
		$oTime02 = $prow['oTime02'];
		$maxNum = $prow['maxNum'];


		if($season == '상시' && $cade01 == '휘트니스센터'){
		}else{
			//정원확인
			if($maxNum){
				//해당 강좌를 신청한 회원수
	//			$usql = "select count(*) from ks_userClass where programID='$uid' and reFund='' and (payMode='단말기' || payMode='신용카드' || payMode='현금' || payMode='현금' || payAmt=0 || payOk='결제확인')";
				$usql = "select count(*) from ks_userClass where programID='$uid' and reFund='' and (payMode!='' || payOk='결제확인')";
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
	}


	if($errorChk == ''){

		//감면비율
		$rate = '';

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
		$rDate = date('Y-m-d H:i:s');
		$rTime = mktime();

		//결제정보
		if($payAmt == 0){
			$payMode = '';
			$payAmt = '';
			$payDate = '';
			$payTime = '';
			$billNum = '';
			$cashBill = '';

		}else{
			$payDate = $getDate;
			$payTime = $getTime;
		}

		$pArr = explode(',',$proList);

		//kcp용 변수
		$bask_cntx = count($pArr);	//장바구니 상품갯수
		$good_info = '';
		$chr30 = chr(30);
		$chr31 = chr(31);

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
			$yoilList = $prow["yoilList"];				//강좌요일
			$oneAmt = $prow['oneAmt'];
			$eduNum = $prow['eduNum'];
			$eDate01 = $prow['eDate01'];	//교육기간
			$eTime01 = $prow['eTime01'];
			$eDate02 = $prow['eDate02'];
			$eTime02 = $prow['eTime02'];
			$cDate01 = $prow['cDate01'];	//환불불가일
			$cTime01 = $prow['cTime01'];
			$title = $prow['title'];
			$periodID = $prow['periodID'];
			$programUid = $prow['uid'];
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
				//수강신청일을 기준으로 지난 교육을 제외한 남은 교육횟수
				$realNum = Util::classOrderChk($eTime01,$eTime02,$yoilList,$getTime);

				//남은 교육횟수 * 프로그램 회당단가
				if($realNum < $eduNum)	$programAmt = $realNum * $oneAmt;

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
			if($rateChk == $uid){
				$saleAmt = round($programAmt * ($rate/100));
				$saleChk = '1';
				$payAmt = $programAmt - $saleAmt;
			}else{
				$saleAmt = 0;
				$saleChk = '';
				$payAmt = $programAmt;
			}

			

			//장바구니ID를 통해 개별프로그램의 알림사항 확인
			$memo = '';
			$cid = ${'cid_'.$uid};
			if($cid){
				$sql = "select * from ks_cartList where uid='$cid'";
				$result = mysql_query($sql);
				$row = mysql_fetch_array($result);
				$memo = $row['etcMsg'];
				$etcAmt = $row['etcAmt'];
				if($etcAmt)	$payAmt = $etcAmt;
			}

			//기존프로그램수강표시
			if(in_array($pid,$uArr))	$orderType = '1';
			else							$orderType = '';

			$sql = "insert into ks_userClass_tmp (userid,name,userNum,phone01,year,season,cade01,period,eDate01,eTime01,eDate02,eTime02,cDate01,cTime01,title,fitnessDate01,fitnessTime01,fitnessDate02,fitnessTime02,periodID,programID,programAmt,mTarget,reduction,health,getDate,getTime,breakDate01,breakTime01,breakDate02,breakTime02,payMode,saleAmt,payAmt,payDate,payTime,kcpAmt,billNum,cashBill,userip,rDate,rTime,device,package,saleChk,cid,memo,orderType) values ";
			$sql .= "('$userid','$name','$userNum','$phone01','$year','$season','$cade01','$period','$eDate01','$eTime01','$eDate02','$eTime02','$cDate01','$cTime01','$title','$fitnessDate01','$fitnessTime01','$fitnessDate02','$fitnessTime02','$periodID','$programUid','$programAmt','$mTarget','$reduction','$health','$getDate','$getTime','$breakDate01','$breakTime01','$breakDate02','$breakTime02','$payMode','$saleAmt','$payAmt','$payDate','$payTime','$kcpAmt','$billNum','$cashBill','$userip','$rDate','$rTime','$UserOS','$package','$saleChk','$cid','$memo','$orderType')";

			$result = mysql_query($sql);

			$seq = $i + 1;
			if($good_info)	$good_info .= $chr30;
			$good_info .= 'seq='.$seq.$chr31.'ordr_numb='.$uid.$chr31.'good_name='.$uid.$chr31.'good_cntx=1'.$chr31.'good_amtx='.$payAmt;
		}
	}
?>
