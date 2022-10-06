<?
if($bSucc == ''){
	//카드승인번호
	$billNum = $app_no;

	$sql = "select * from ks_programEtcTmp where userip='$userip' and rTime='$rTime' order by uid";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$uid = $row['pid'];
	$payAmt = $row['kcpAmt'];
	$saleAmt = $row['saleAmt'];
	$payMode = $row['payMode'];

	$payDate = date('Y-m-d H:i:s');
	$payTime = mktime();

	if($payMode == '가상계좌')	$payOk = '입금대기';
	else									$payOk = '결제확인';

	$cashBill = '';

	/*
		kcpAmt = 전자결제금액
		paynum = KCP 거래번호
		bankname = 계좌이체(거래은행), 가상계좌(입금은행)
		depositor = 가상계좌(입금자)
		account = 가상계좌(입금액)
		va_date = 가상계좌(입금기한)
		cash_yn = 현금영수증(사용여부)
		cash_authno = 현금영수증(승인번호)
	*/


	$sql = "update ks_programEtc set ";
	$sql .= "payMode='$payMode',";
	$sql .= "payDate='$payDate',";
	$sql .= "payTime='$payTime',";
	$sql .= "payAmt='$payAmt',";
	$sql .= "saleAmt='$saleAmt',";
	$sql .= "billNum='$billNum',";
	$sql .= "cashBill='$cashBill',";
	$sql .= "payOk='$payOk',";
	$sql .= "paynum='$paynum',";	
	$sql .= "cardName='$card_name',";
	$sql .= "bankname='$bankname',";
	$sql .= "depositor='$depositor',";
	$sql .= "account='$account',";
	$sql .= "va_date='$va_date',";
	$sql .= "cash_yn='$cash_yn',";
	$sql .= "cash_authno='$cash_authno',";
	$sql .= "vaDate='$vaDate',";
	$sql .= "vaTime='$vaTime'";
	$sql .= " where uid='$uid'";
	$result = mysql_query($sql);
}
?>