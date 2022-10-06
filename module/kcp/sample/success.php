<?
if($bSucc == ''){

/*
	//카드승인번호
	$billNum = $app_no;

	kcpAmt = 전자결제금액
	paynum = KCP 거래번호
	app_no = 카드승인번호
	bankname = 계좌이체(거래은행), 가상계좌(입금은행)
	depositor = 가상계좌(입금자)
	account = 가상계좌(입금액)
	va_date = 가상계좌(입금기한)
	cash_yn = 현금영수증(사용여부)
	cash_authno = 현금영수증(승인번호)
*/



	$sql = "select * from ks_order_tmp where reg_date='$reg_date' order by uid desc limit 1";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$userid = $row['userid'];
	$oname = $row['oname'];
	$ozip1 = $row['ozip1'];
	$ozip2 = $row['ozip2'];
	$ozipcode = $row['ozipcode'];
	$oaddr1 = $row['oaddr1'];
	$oaddr2 = $row['oaddr2'];
	$otel1 = $row['otel1'];
	$otel2 = $row['otel2'];
	$otel3 = $row['otel3'];
	$ohp1 = $row['ohp1'];
	$ohp2 = $row['ohp2'];
	$ohp3 = $row['ohp3'];
	$oemail = $row['oemail'];

	$pname = $row['pname'];
	$pzip1 = $row['pzip1'];
	$pzip2 = $row['pzip2'];
	$pzipcode = $row['pzipcode'];
	$paddr1 = $row['paddr1'];
	$paddr2 = $row['paddr2'];
	$ptel1 = $row['ptel1'];
	$ptel2 = $row['ptel2'];
	$ptel3 = $row['ptel3'];
	$php1 = $row['php1'];
	$php2 = $row['php2'];
	$php3 = $row['php3'];

	$ment = $row['ment'];
	$paymode = $row['paymode'];
	$result_price = $row['result_price'];
	$ship_price = $row['ship_price'];
	$ship_mode = $row['ship_mode'];
	$amt = $row['amt'];
	$saleTxt = $row['saleTxt'];
	$sale_price = $row['sale_price'];
	$coupon_price = $row['coupon_price'];
	$coupon = $row['coupon'];
	$point = $row['point'];
	$status = $row['status'];
	$ip = $row['ip'];


	$status = '결제완료';

	

	//주문자 정보를 저장한다.
	$sql = "insert into ks_order (userid,oname,ozip1,ozip2,ozipcode,oaddr1,oaddr2,otel1,otel2,otel3,ohp1,ohp2,ohp3,oemail,pname,pzip1,pzip2,pzipcode,paddr1,paddr2,ptel1,ptel2,ptel3,php1,php2,php3,ment,paymode,result_price,ship_price,ship_mode,amt,saleTxt,sale_price,coupon_price,coupon,point,status,ip,reg_date,billNum,kcpAmt,paynum,app_no,bankname,depositor,vaccount,va_date,cash_yn,cash_authno) ";
	$sql .= "values ('$userid','$oname','$ozip1','$ozip2','$ozipcode','$oaddr1','$oaddr2','$otel1','$otel2','$otel3','$ohp1','$ohp2','$ohp3','$oemail','$pname','$pzip1','$pzip2','$pzipcode','$paddr1','$paddr2','$ptel1','$ptel2','$ptel3','$php1','$php2','$php3','$ment','$paymode','$result_price','$ship_price','$ship_mode','$amt','$saleTxt','$sale_price','$coupon_price','$coupon','$point','$status','$ip','$reg_date','$billNum','$kcpAmt','$paynum','$app_no','$bankname','$depositor','$account','$va_date','$cash_yn','$cash_authno')";

	$result = mysql_query($sql);




	//적립금을 사용한 경우
	if($point > 0){
		//사용자 적립금 사용내역등록
		$pmsg = '['.$reg_date.'] 주문사용';
		$sql = "insert into ks_point (userid,ptype,point,ment,reg_date) values ('$userid','U','$point','$pmsg','$reg_date')";
		$result = mysql_query($sql);

		//사용자 적립금차감
		$sql = "update ks_userlist set point = point - $point where userid='$userid'";
		$result = mysql_query($sql);
	}


	//회원일 경우 결제금액의 2%적립
	if($userid && $userid != '_guest' && $userid != '비회원'){
		$addPoint = round($amt * 0.02);

		//사용자 적립금 사용내역등록
		$pmsg = '['.$reg_date.'] 주문적립';
		$sql = "insert into ks_point (userid,ptype,point,ment,reg_date) values ('$userid','O','$addPoint','$pmsg','$reg_date')";
		$result = mysql_query($sql);

		//사용자 적립금 적립
		$sql = "update ks_userlist set point = point + $addPoint where userid='$userid'";
		$result = mysql_query($sql);
	
	}



	//주문내역을 저장한다.
	$sql01 = "select * from ks_order_list_tmp where userid='$userid' and code='$reg_date' order by uid";
	$result01 = mysql_query($sql01);
	$num01 = mysql_num_rows($result01);

	for($i=0; $i<$num01; $i++){
		$row01 = mysql_fetch_array($result01);

		$pid = $row01['pid'];					//제품UID
		$puserid = $row01['puserid'];					//제품UID
		$pcade01 = $row01['pcade01'];	//분류
		$pcade02 = $row01['pcade02'];	//분류
		$ptitle = $row01['ptitle'];				//제품명
		$pdate = $row01['pdate'];				//행사일
		$pea = $row01['pea'];					//수량
		$price01 = $row01['price01'];		//상품가격
		$price02 = $row01['price02'];		//옵션가
		$price03 = $row01['price03'];		//(상품가격+옵션가) * 수량

		

		$sql02 = "insert into ks_order_list (userid,code,pid,puserid,pcade01,pcade02,ptitle,pdate,pea,price01,price02,price03,gdata01,gdata02,gdata03,gdata04,gdata05,gdata06,gdata07,gdata08,gdata09,mdata01,mdata02,mdata03,mdata04,mdata05,bdata01,bdata02,bdata03,bdata04,bdata05,bdata06,bdata07,cdata01,cdata02,cdata03,cdata04,cdata05,cdata06,cdata07,etc01,etc02,etc03,etc04) values ('$userid','$reg_date','$pid','$puserid','$pcade01','$pcade02','$ptitle','$pdate','$pea','$price01','$price02','$price03','$gdata01','$gdata02','$gdata03','$gdata04','$gdata05','$gdata06','$gdata07','$gdata08','$gdata09','$mdata01','$mdata02','$mdata03','$mdata04','$mdata05','$bdata01','$bdata02','$bdata03','$bdata04','$bdata05','$bdata06','$bdata07','$cdata01','$cdata02','$cdata03','$cdata04','$cdata05','$cdata06','$cdata07','$etc01','$etc02','$etc03','$etc04')";
		$result02 = mysql_query($sql02);


	}




	//장바구니 비우기
	$qment="where ip='$userip'";
	if($userid != '비회원')		$qment.="or userid='$userid'";
	$sql = "delete from ks_cart $qment";
	$result = mysql_query($sql);

	//결제내역확인페이지
	$sql = "select * from ks_order where reg_date='$reg_date' order by uid desc limit 1";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$uid = $row['uid'];
}
?>