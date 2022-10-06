<?
exit;
include './class/class.DbCon.php';

$sql = "select * from ks_userClass where uid=2";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$rowArr = Array('userid','name','userNum','phone01','year','season','cade01','period','eDate01','eTime01','eDate02','eTime02','cDate01','cTime01','title','fitnessDate01','fitnessTime01','fitnessDate02','fitnessTime02','periodID','programID','programAmt','mTarget','reduction','health','getDate','getTime','breakDate01','breakTime01','breakDate02','breakTime02','payMode','saleAmt','payAmt','payDate','payTime','kcpAmt','billNum','cashBill','cashBillNum','payOk','paynum','cardName','bankname','depositor','account','va_date','cash_yn','cash_authno','vaDate','vaTime','reFund','reAmt','reEtc','reUse','reDate','reTime','reMemo','reMsg','memo','payMemo','backName','backBank','backAccount','upfile01','realfile01','billName','userip','rDate','rTime','device','package','newAmt','newNum','newCard','saleChk','cid','multiChk','orderType');

foreach($rowArr as $k => $v){
	echo $v.' = '.$row[$v].'<br>';
}

$startTime = mktime(0,0,0,12,1,2019);

$sql = "select * from zz_classOrder where sTime>=$startTime order by uid asc";
$result = mysql_query($sql);
$num = mysql_num_rows($result);

for($i=0; $i<$num; $i++){
	$row = mysql_fetch_array($result);
	$title = $row['title'];


	//프로그램정보
	$psql = "select * from ks_program where title='$title'";
	$presult = mysql_query($psql);
	$pnum = mysql_num_rows($presult);

	if($pnum){
		$prow = mysql_fetch_array($presult);
		$periodID = $prow['periodID'];


		//프로그램 기간정보
		$esql = "select * from ks_programPeriod where uid='$periodID'";
		$eresult = mysql_query($esql);
		$erow = mysql_fetch_array($eresult);


		//수강등록정보설정
		$userid = '';
		$name = $row['name'];
		$userNum = $row['userNum'];
		$phone01 = '';
		$year = $prow['year'];
		$season = $prow['season'];
		$cade01 = $prow['cade01'];
		$period = $prow['period'];
		$eDate01 = $row['sDate'];
		$eTime01 = $row['sTime'];
		$eDate02 = $row['eDate'];
		$eTime02 = $row['eTime'];
		$cDate01 = $erow['cDate01'];
		$cTime01 = $erow['cTime01'];
	//	$title = $row['title'];
		$fitnessDate01 = '';
		$fitnessTime01 = 0;
		$fitnessDate02 = '';
		$fitnessTime02 = 0;
	//	$periodID = $prow['periodID'];
		$programID = $prow['uid'];
		$programAmt = $row['amt'];
		$mTarget = $prow['mTarget'];
		$reduction = '';
		$health = '';
		$getDate = $row['pDate'];
		$getTime = $row['pTime'];
		$breakDate01 = '';
		$breakTime01 = 0;
		$breakDate02 = '';
		$breakTime02 = 0;
		$payMode = '현금';
		$saleAmt = 0;
		$payAmt = $row['amt'];
		$payDate = $row['pDate'];
		$payTime = $row['pTime'];
		$kcpAmt = '';
		$billNum = '';
		$cashBill = '미발행';
		$cashBillNum = '';
		$payOk = '결제확인';
		$paynum = '';
		$cardName = '';
		$bankname = '';
		$depositor = '';
		$account = '';
		$va_date = '';
		$cash_yn = '';
		$cash_authno = '';
		$vaDate = '';
		$vaTime = '';
		$reFund = '';
		$reAmt = '';
		$reEtc = '';
		$reUse = '';
		$reDate = '';
		$reTime = 0;
		$reMemo = '';
		$reMsg = '';
		$memo = '';
		$payMemo = '';
		$backName = '';
		$backBank = '';
		$backAccount = '';
		$upfile01 = '';
		$realfile01 = '';
		$billName = '';
		$userip = '106.246.92.237';
		$rDate = $row['pDate'];
		$rTime = $row['pTime'];
		$device = '';
		$package = '';
		$newAmt = '';
		$newNum = '';
		$newCard = '';
		$saleChk = '';
		$cid = '';
		$multiChk = '';
		$orderType = '';

		$osql = "insert into ks_userClass (userid,name,userNum,phone01,year,season,cade01,period,eDate01,eTime01,eDate02,eTime02,cDate01,cTime01,title,fitnessDate01,fitnessTime01,fitnessDate02,fitnessTime02,periodID,programID,programAmt,mTarget,reduction,health,getDate,getTime,breakDate01,breakTime01,breakDate02,breakTime02,payMode,saleAmt,payAmt,payDate,payTime,kcpAmt,billNum,cashBill,cashBillNum,payOk,paynum,cardName,bankname,depositor,account,va_date,cash_yn,cash_authno,vaDate,vaTime,reFund,reAmt,reEtc,reUse,reDate,reTime,reMemo,reMsg,memo,payMemo,backName,backBank,backAccount,upfile01,realfile01,billName,userip,rDate,rTime,device,package,newAmt,newNum,newCard,saleChk,cid,multiChk,orderType) values ";
		$osql .= "('$userid','$name','$userNum','$phone01','$year','$season','$cade01','$period','$eDate01','$eTime01','$eDate02','$eTime02','$cDate01','$cTime01','$title','$fitnessDate01','$fitnessTime01','$fitnessDate02','$fitnessTime02','$periodID','$programID','$programAmt','$mTarget','$reduction','$health','$getDate','$getTime','$breakDate01','$breakTime01','$breakDate02','$breakTime02','$payMode','$saleAmt','$payAmt','$payDate','$payTime','$kcpAmt','$billNum','$cashBill','$cashBillNum','$payOk','$paynum','$cardName','$bankname','$depositor','$account','$va_date','$cash_yn','$cash_authno','$vaDate','$vaTime','$reFund','$reAmt','$reEtc','$reUse','$reDate','$reTime','$reMemo','$reMsg','$memo','$payMemo','$backName','$backBank','$backAccount','$upfile01','$realfile01','$billName','$userip','$rDate','$rTime','$device','$package','$newAmt','$newNum','$newCard','$saleChk','$cid','$multiChk','$orderType')";
		$oresult = mysql_query($osql);

	}else{
		echo $title.'<br>';
	}
}
?>