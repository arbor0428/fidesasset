<?
include '../module/login/head.php';
include '../module/class/class.DbCon.php';
include '../module/class/class.Util.php';
include '../module/class/class.Msg.php';
include '../module/class/class.FileUpload.php';
include '../module/file_filtering.php';

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
		Msg::GblMsgBoxParent($msg);
		exit;
	}

	//기존회원인지확인
	$oldUser = '';
	$oldUserNum = '';
	$chkTxt = $phone01;
	$chkTxt = str_replace('-','',$chkTxt);
	$chkTxt = str_replace(' ','',$chkTxt);
	$sql = "select * from zz_member where name='$name' and bDate='$bDate' and replace(phone01,'-','')='$chkTxt'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num){
		$row = mysql_fetch_array($result);
		$oldUser = $row['uid'];
		$oldUserNum = $row['userNum'];
	}
}


//가입시 기존회원정보를 불러왔거나 로그인 후 정보수정일 경우
if($userNum){
	$sql = "select * from ks_userlist where userNum='$userNum'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$uid = $row['uid'];
	$reductionData = $row['reduction'];

	$type = 'edit';
}




	$chkList01 = '';
	for($i=0; $i<count($chkList01Arr); $i++){
		if($chkList01)	$chkList01 .= ',';
		$chkList01 .= $chkList01Arr[$i];
	}

	$chkList02 = '';
	for($i=0; $i<count($chkList02Arr); $i++){
		if($chkList02)	$chkList02 .= ',';
		$chkList02 .= $chkList02Arr[$i];
	}





if($type == 'write' || $type == 'edit'){
	if($userType == '일반'){
		$reduction = '';
	}

	//파일업로드
	include 'fileChk.php';

	//생년월일
	$bArr = explode('-',$bDate);
	$bTime = mktime(0,0,0,$bArr[1],$bArr[2],$bArr[0]);

	//주차권발급
	if($car == '')	$carNum = '';

	//비고
//	if($memo)	$memo = Util::textareaEncodeing($memo);

	//질병 및 건강상태
	$health = '';
	$healthBabyChk = '';
	$healthEtcChk = '';
	for($i=0; $i<count($healthList); $i++){
		$healthTxt = $healthList[$i];

		if($healthTxt == '임산부')	$healthBabyChk = true;
		if($healthTxt == '기타')		$healthEtcChk = true;

		if($health)	$health .= ',';
		$health .= $healthTxt;
	}

	if(!$healthBabyChk)	$healthBaby = '';		//임산부를 선택하지 않았을 경우 임신주차수 정보를 삭제
	if(!$healthEtcChk)		$healthEtc = '';		//기타를 선택하지 않았을 경우 기타정보를 삭제


	//연락처2 관계
	if($phone02Sel != '직접입력')	$phone02Txt = $phone02Sel;


	if($type == 'write'){
		//가입상태(승인)
		if($userType == '일반')	$status = 1;
		else							$status = 2;

		//$status = 1;

		//접수일
		$gArr = explode('-',$getDate);
		$gH = date('H');
		$gM = date('i');
		$gS = date('s');
		$getTime = mktime($gH,$gM,$gS,$gArr[1],$gArr[2],$gArr[0]);

		//기존회원
		if($oldUser){
			$sql = "update zz_member set userid='$userid' where uid='$oldUser'";
			$result = mysql_query($sql);
			$userOrder = '';
			$userNum = $oldUserNum;

		}else{
			$sql = "select max(userOrder) from ks_userlist";
			$result = mysql_query($sql);
			$max = mysql_result($result,0,0);
			$userOrder = $max + 1;

			$userNum = sprintf('%08d',$userOrder);
		}

		//생년월일
		$bArr = explode('-',$bDate);
		$bTime = mktime(0,0,0,$bArr[1],$bArr[2],$bArr[0]);

		//차량보유
		if($car == '')	$carNum = '';

		//비고
//		if($memo)	$memo = Util::textareaEncodeing($memo);


		$rDate = date('Y-m-d H:i:s');
		$rTime = mktime();

		$sql = "insert into ks_userlist (status,userid,pwd,name,userNum,userOrder,sex,bDate,bTime,userType,car,carNum,zipcode,addr01,addr02,bank,accName,account,email01,email02,phone01,phone01Txt,phone02,phone02Txt,memo,reduction,upfile01,realfile01,upfile02,realfile02,cok,cokPost,cokSms,cokEmail,cokPhone,health,healthBaby,healthEtc,joinType,getDate,getTime,rDate,rTime,kcbNo,kcbName,kcbBdate,kcbSex,kcbMobile) values ";
		$sql .= "('$status','$userid','$pwd','$name','$userNum','$userOrder','$sex','$bDate','$bTime','$userType','$car','$carNum','$zipcode','$addr01','$addr02','$bank','$accName','$account','$email01','$email02','$phone01','$phone01Txt','$phone02','$phone02Txt','$memo','$reduction','$arr_new_file[1]','$real_name[1]','$arr_new_file[2]','$real_name[2]','$cok','$cokPost','$cokSms','$cokEmail','$cokPhone','$health','$healthBaby','$healthEtc','$joinType','$getDate','$getTime','$rDate','$rTime','$kcbNo','$kcbName','$kcbBdate','$kcbSex','$kcbMobile')";
		$result = mysql_query($sql);

		if($status == '1'){
			Msg::GblMsgBoxParent("가입이 완료되었습니다.","location.href='/';");
			exit;
		}else{
			Msg::GblMsgBoxParent("가입신청이 완료되었습니다.\\n관리자 승인 후 로그인 및 서비스 이용이 가능합니다.","location.href='/';");
			exit;
		}



	}elseif($type == 'edit'){
		$editDate = date('Y-m-d H:i:s');
		$editTime = mktime();

		$logoutChk = false;
/*
		//감면대상자 정보가 변경된 경우 미승인처리
		if($DBuserType != $userType || $DBreduction != $reduction){
			//가입상태(승인)
			if($userType == '일반')	$status = 1;
			else							$status = 2;

			$logoutChk = true;
		}
*/

		

		$sql = "update ks_userlist set ";
		$sql .= "userid='$userid', ";
		if($status){
			$sql .= "status='$status', ";
		}
		if($status != '3'){
			$sql .= "pwd='$pwd', ";
		}
		$sql .= "name='$name', ";
		$sql .= "sex='$sex', ";
		$sql .= "bDate='$bDate', ";
		$sql .= "bTime='$bTime', ";
		$sql .= "userType='$userType', ";
		$sql .= "car='$car', ";
		$sql .= "carNum='$carNum', ";
		$sql .= "zipcode='$zipcode', ";
		$sql .= "addr01='$addr01', ";
		$sql .= "addr02='$addr02', ";
		$sql .= "bank='$bank', ";
		$sql .= "accName='$accName', ";
		$sql .= "account='$account', ";
		$sql .= "email01='$email01', ";
		$sql .= "email02='$email02', ";
		$sql .= "phone01='$phone01', ";
		$sql .= "phone01Txt='$phone01Txt', ";
		$sql .= "phone02='$phone02', ";
		$sql .= "phone02Txt='$phone02Txt', ";
//		$sql .= "memo='$memo', ";
		$sql .= "reduction='$reduction', ";
		$sql .= "upfile01='$arr_new_file[1]',";
		$sql .= "realfile01='$real_name[1]',";
		$sql .= "upfile02='$arr_new_file[2]',";
		$sql .= "realfile02='$real_name[2]',";
		$sql .= "cok='$cok', ";
		$sql .= "cokPost='$cokPost', ";
		$sql .= "cokSms='$cokSms', ";
		$sql .= "cokEmail='$cokEmail', ";
		$sql .= "cokPhone='$cokPhone', ";
		$sql .= "health='$health', ";
		$sql .= "healthBaby='$healthBaby', ";
		$sql .= "healthEtc='$healthEtc', ";
		$sql .= "joinType='$joinType' ";
		$sql .= " where uid=$uid";
		$result = mysql_query($sql);

		if($status=='3'){
			Msg::GblMsgBoxParent("회원탈퇴가 신청되었습니다.","location.href='/module/login/logout_proc.php';");
			exit;
		}

		if($logoutChk){
			Msg::GblMsgBoxParent("회원정보가 수정되었으며 관리자 승인 후 서비스 이용이 가능합니다.","location.href='/module/login/logout_proc.php';");
			exit;
		}else{
			Msg::GblMsgBoxParent("회원정보 수정이 정상 처리되었습니다.","location.href='/';");
			exit;
		}
	}



}elseif($type == 'del'){
	$sql = "select * from ks_userlist where uid='$uid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$upfile01 = $row['upfile01'];
	if($upfile01){
		$UPLOAD_DIR = '../upfile/user/';
		@unlink($UPLOAD_DIR.$upfile01);
	}

	$sql = "delete from ks_userlist where uid='$uid'";
	$result = mysql_query($sql);

	Msg::goKorea('up_index.php');
	exit;

}
?>