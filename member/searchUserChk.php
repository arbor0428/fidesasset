<?
	include "../module/class/class.DbCon.php";
	include "../module/class/class.Util.php";
	include "../module/class/class.Msg.php";


	$sql = "select * from ks_userlist where name='$sname' and bDate='$suserNum' and replace(phone01,'-','')='$suserMobile'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num){
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$userid = $row["userid"];
		$name = $row["name"];
		$userNum = $row["userNum"];
		$sex = $row["sex"];
		$bDate = $row["bDate"];
		$userType = $row["userType"];
		$car = $row["car"];
		$carNum = $row["carNum"];
		$zipcode = $row["zipcode"];
		$addr01 = $row["addr01"];
		$addr02 = $row["addr02"];
		$email01 = $row["email01"];
		$email02 = $row["email02"];
		$phone01 = $row["phone01"];
		$phone01Txt = $row["phone01Txt"];
		$phone02 = $row["phone02"];
		$phone02Txt = $row["phone02Txt"];
		$memo = $row["memo"];
		$reduction = $row["reduction"];
		$upfile01 = $row["upfile01"];
		$realfile01 = $row["realfile01"];
		$cok = $row["cok"];
		$cokPost = $row["cokPost"];
		$cokSms = $row["cokSms"];
		$cokEmail = $row["cokEmail"];
		$cokPhone = $row["cokPhone"];
		$health = $row["health"];
		$healthBaby = $row["healthBaby"];
		$healthEtc = $row["healthEtc"];
		$joinType = $row["joinType"];
		$getDate = $row["getDate"];

		if($userid){
			echo ("<script language='javascript'>alert('아이디가 발급된 회원입니다.');</script>");
			exit;

		//인증번호 확인
		}else{
			$sql = "select * from ks_sms_list where userid='$uid' and okNum='$sokNum'";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);

			if($num == 0){
				echo ("<script language='javascript'>alert('인증번호를 확인해 주시기 바랍니다.');</script>");
				exit;
			}
		}

?>

<script language='javascript'>
	form01 = parent.document.frm_search;
	form01.sname.value = '';
	form01.suserNum.value = '';

	form02 = parent.document.FRM;
	form02.name.value = "<?=$name?>";
	form02.userNum.value = "<?=$userNum?>";
	parent.$('#userNumTxt').text('<?=$userNum?>');

	//성별
	if('<?=$sex?>' == '남'){
		parent.$('#squaredThree1').click();
		parent.$('#squaredThree1').prop('checked', true);
	}else if('<?=$sex?>' == '여'){
		parent.$('#squaredThree2').click();
		parent.$('#squaredThree2').prop('checked', true);
	}

	form02.bDate.value = "<?=$bDate?>";

	//회원구분
	if('<?=$userType?>' == '일반'){
		parent.$('#squaredThree3').click();
		parent.$('#squaredThree3').prop('checked', true);
	}else if('<?=$userType?>' == '감면대상자'){
		parent.$('#squaredThree4').click();
		parent.$('#squaredThree4').prop('checked', true);
	}

	//주차권발급
	if('<?=$car?>' == ''){
		parent.$('#cT1').click();
		parent.$('#cT1').prop('checked', true);
	}else if('<?=$car?>' == '예'){
		parent.$('#cT2').click();
		parent.$('#cT2').prop('checked', true);
		parent.$('#carNum').val("<?=$carNum?>");
	}	

	form02.zipcode.value = "<?=$zipcode?>";
	form02.addr01.value = "<?=$addr01?>";
	form02.addr02.value = "<?=$addr02?>";
	form02.email01.value = "<?=$email01?>";
	form02.email02.value = "<?=$email02?>";
	form02.phone01.value = "<?=$phone01?>";
	form02.phone01Txt.value = "<?=$phone01Txt?>";
	form02.phone02.value = "<?=$phone02?>";
	form02.phone02Txt.value = "<?=$phone02Txt?>";

	//비고
/*
	memo = "<?=$memo?>";
	memo = memo.replace(/<BR\s?\/?>/g,"\n");
	memo = memo.replace(/&quot;/g,"\"");
	parent.$('#memo').val(memo);
*/

	//감면구분
	parent.$("#reduction").val("<?=$reduction?>").attr("selected", "selected");

	//대상자 자료제공
	if('<?=$cok?>' == ''){
		parent.$('#sT7').click();
		parent.$('#sT7').prop('checked', true);
	}else{
		parent.$('#sT8').click();
		parent.$('#sT8').prop('checked', true);
	}


	//선호채널
	if('<?=$cokPost?>'){
		parent.$('#cC1').click();
		parent.$('#cC1').prop('checked', true);
	}

	if('<?=$cokSms?>'){
		parent.$('#cC2').click();
		parent.$('#cC2').prop('checked', true);
	}

	if('<?=$cokEmail?>'){
		parent.$('#cC3').click();
		parent.$('#cC3').prop('checked', true);
	}

	if('<?=$cokPhone?>'){
		parent.$('#cC4').click();
		parent.$('#cC4').prop('checked', true);
	}

	//질병 및 건강상태
	health = "<?=$health?>";
	healthArr = health.split(',');
	
	for(i=0; i<healthArr.length; i++){
		healthTxt = healthArr[i];
		if(healthTxt == '심장질환')									parent.$('#sT1').prop('checked', true);
		else if(healthTxt == '고혈압 및 당뇨')					parent.$('#sT2').prop('checked', true);
		else if(healthTxt == '전염성피부병 및 호흡기질환')	parent.$('#sT3').prop('checked', true);
		else if(healthTxt == '임산부')								parent.$('#sT4').prop('checked', true);
		else if(healthTxt == '기타')									parent.$('#sT5').prop('checked', true);
	}

//	form02.healthBaby.value = "<?=$healthBaby?>";
//	form02.healthEtc.value = "<?=$healthEtc?>";
	form02.joinType.value = "<?=$joinType?>";

	//접수일
	parent.$('#getDateTxt').text('<?=$getDate?>');
	form02.getDate.value = "<?=$getDate?>";

	parent.$('.IdPwd_close').click();
</script>

<?
		exit;


	}else{
		$msg = '일치하는 회원정보가 없습니다';
?>

<script language='javascript'>
	alert('<?=$msg?>');
</script>

<?
		exit;
	}


	unset($dbconn);

	
?>