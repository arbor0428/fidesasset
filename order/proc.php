<?
	include "../module/class/class.DbCon.php";
	include '../module/class/class.Util.php';
	include "../module/class/class.Msg.php";

	$reg_date = mktime();
	$user_ip = $_SERVER['REMOTE_ADDR'];

	$cChk = 0;

	//쿠폰금액이 있는 경우
	if($cPrice){
		$cnum01 = strtoupper($_POST['cnum01']);
		$cnum02 = strtoupper($_POST['cnum02']);
		$cnum03 = strtoupper($_POST['cnum03']);
		$cnum04 = strtoupper($_POST['cnum04']);


		if(!$cnum01 || !$cnum02 || !$cnum03 || !$cnum04){
			Msg::backMsg('접근오류');
			exit;

		}else{
			$coupon = $cnum01.'-'.$cnum02.'-'.$cnum03.'-'.$cnum04;

			//쿠폰 유효성검사
			$cChk = Util::CouponCheck($coupon,$dbconn);

			if($cChk == 'used'){
				Msg::backMsg('이미 사용된 쿠폰번호입니다');
				exit;

			}elseif($cChk == 'end'){
				Msg::backMsg('유효기간이 만료된 쿠폰번호입니다');
				exit;

			}elseif($cChk == ''){
				Msg::backMsg('잘못된 쿠폰번호입니다');
				exit;
			}
		}
	}






	$cart_num = explode(',',$cart_idx);
	$clen = count($cart_num);

	$errMsg = "";

	//중복상품 재고수 처리용
	$invenArr = Array();
	$invenArrEA = Array();

	//재고확인
	for($i=0; $i<$clen; $i++){
		$cid = $cart_num[$i];
		$cea = ${'ea'.$cid};

		$sql = "select * from ks_cart where uid='$cid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$pid = $row['pid'];
		$pdateTime = $row['pdate'];
		$gdata01 = $row['gdata01'];			//여성한복사이즈
		$bdata02 = $row['bdata02'];			//돌한복(남아)
		$cdata02 = $row['cdata02'];			//돌한복(여아)

		//재고확인(행사일기준)
		$invenID = $pid;					//상품UID
		$invenTime = $pdateTime;		//행사일
		$invenEA = $cea;					//주문수량

		include '../module/invenChk.php';
	}

	if($errMsg){
		$errMsg .= "\\n재고가 부족합니다";
		Msg::goMsg($errMsg,'up_index.php');
		exit;
	}






	if($ment){
		$ment = eregi_replace("<", "&lt;", $ment);
		$ment = eregi_replace(">", "&gt;", $ment);
		$ment = eregi_replace("\"", "&quot;", $ment);
		$ment = eregi_replace("\|", "&#124;", $ment);
		$ment = eregi_replace("\r\n\r\n", "<P>", $ment);
		$ment = eregi_replace("\r\n", "<BR>", $ment);
	}



	//적립금을 사용한 경우
	if($uPrice > 0 && $userid){
		//사용자 적립금 사용내역등록
		$pmsg = '['.$reg_date.'] 주문사용';
		$sql = "insert into ks_point (userid,ptype,point,ment,reg_date) values ('$userid','U','$uPrice','$pmsg','$reg_date')";
		$result = mysql_query($sql);

		//사용자 적립금차감
		$sql = "update tb_member set point = point - $uPrice where userid='$userid'";
		$result = mysql_query($sql);
	}





	if($cChk > $amt && $userid){
		//쿠폰 사용후 남은 액수는 적립금으로...
		$point = $cChk - $amt;

		//사용자 적립금 내역등록
		$pmsg = '['.$coupon.'] 사용후 차액적립';
		$sql = "insert into ks_point (userid,ptype,point,ment,reg_date) values ('$userid','P','$point','$pmsg','$reg_date')";
		$result = mysql_query($sql);

		//사용자 적립금추가
		$sql = "update tb_member set point = point + $point where userid='$userid'";
		$result = mysql_query($sql);
	}


	$amt = $amt - $cChk;
	if($amt < 0)	 $amt = 0;



	if(!$userid)	$userid = '_guest';


	if($cChk > 0){
		//쿠폰사용처리
		$cmsg = '['.$reg_date.'] 주문사용';
		$sql = "update ks_coupon_list set r_date='$reg_date', r_userid='$userid', r_name='$oname', ment='$cmsg' where coupon='$coupon'";
		$result = mysql_query($sql);
	}








	//주문자 정보를 저장한다.
	$sql = "insert into ks_order (userid,oname,ozip1,ozip2,ozipcode,oaddr1,oaddr2,otel1,otel2,otel3,ohp1,ohp2,ohp3,oemail,pname,pzip1,pzip2,pzipcode,paddr1,paddr2,ptel1,ptel2,ptel3,php1,php2,php3,ment,paymode,account,result_price,ship_price,ship_mode,ship_num,amt,coupon_price,coupon,point,status,ip,reg_date) ";
	$sql .= "values ('$userid','$oname','$ozip1','$ozip2','$ozipcode','$oaddr1','$oaddr2','$otel1','$otel2','$otel3','$ohp1','$ohp2','$ohp3','$oemail','$pname','$pzip1','$pzip2','$pzipcode','$paddr1','$paddr2','$ptel1','$ptel2','$ptel3','$php1','$php2','$php3','$ment','-','$ac_name','$result_price','$ship_price','$ship_mode','$ship_num','$amt','$cChk','$coupon','$uPrice','결제완료','$user_ip','$reg_date')";
	$result = mysql_query($sql);




	//주문내역을 저장한다.
	$id_list = explode(',',$cart_idx);		//장바구니UID
	$tot = count($id_list);

	for($i=0; $i<$tot; $i++){
		$uid = $id_list[$i];

		$sql01 = "select * from ks_cart where uid='$uid'";
		$result01 = mysql_query($sql01);
		$row01 = mysql_fetch_array($result01);

		$pid = $row01['pid'];					//제품UID
		$pdate = $row01['pdate'];				//행사일
		$pea = ${'ea'.$uid};						//수량
		$price01 = ${'p1'.$uid};				//상품가격
		$price02 = ${'p2'.$uid};				//옵션가
		$price03 = ${'op'.$uid} * $pea;		//(상품가격+옵션가) * 수량

		//여성한복
		$gdata01 = $row01['gdata01'];
		$gdata02 = $row01['gdata02'];
		$gdata03 = $row01['gdata03'];
		$gdata04 = $row01['gdata04'];
		$gdata05 = $row01['gdata05'];
		$gdata06 = $row01['gdata06'];
		$gdata07 = $row01['gdata07'];
		$gdata08 = $row01['gdata08'];
		$gdata09 = $row01['gdata09'];

		//여성한복 > 촬영한복 주문옵션
		$etc01 = $row01['etc01'];			//아얌
		$etc02 = $row01['etc02'];			//비녀
		$etc03 = $row01['etc03'];			//뱃씨댕기
		$etc04 = $row01['etc04'];			//노리개

		//남성한복
		$mdata01 = $row01['mdata01'];
		$mdata02 = $row01['mdata02'];
		$mdata03 = $row01['mdata03'];
		$mdata04 = $row01['mdata04'];
		$mdata05 = $row01['mdata05'];

		//남아한복(대여)
		$bdata01 = $row01['bdata01'];
		$bdata02 = $row01['bdata02'];
		$bdata03 = $row01['bdata03'];
		$bdata04 = $row01['bdata04'];
		$bdata05 = $row01['bdata05'];
		$bdata06 = $row01['bdata06'];
		$bdata07 = $row01['bdata07'];

		//여아한복(대여)
		$cdata01 = $row01['cdata01'];
		$cdata02 = $row01['cdata02'];
		$cdata03 = $row01['cdata03'];
		$cdata04 = $row01['cdata04'];
		$cdata05 = $row01['cdata05'];
		$cdata06 = $row01['cdata06'];
		$cdata07 = $row01['cdata07'];



		//제품정보
		$sql02 = "select * from ks_product where uid='$pid'";
		$result02 = mysql_query($sql02);
		$row02 = mysql_fetch_array($result02);

		$pcade01 = $row02['cade01'];
		$pcade02 = $row02['cade02'];
		$ptitle = $row02['title'];



		$sql03 = "insert into ks_order_list (userid,code,pid,pcade01,pcade02,ptitle,pdate,pea,price01,price02,price03,gdata01,gdata02,gdata03,gdata04,gdata05,gdata06,gdata07,gdata08,gdata09,mdata01,mdata02,mdata03,mdata04,mdata05,bdata01,bdata02,bdata03,bdata04,bdata05,bdata06,bdata07,cdata01,cdata02,cdata03,cdata04,cdata05,cdata06,cdata07,etc01,etc02,etc03,etc04) values ('$userid','$reg_date','$pid','$pcade01','$pcade02','$ptitle','$pdate','$pea','$price01','$price02','$price03','$gdata01','$gdata02','$gdata03','$gdata04','$gdata05','$gdata06','$gdata07','$gdata08','$gdata09','$mdata01','$mdata02','$mdata03','$mdata04','$mdata05','$bdata01','$bdata02','$bdata03','$bdata04','$bdata05','$bdata06','$bdata07','$cdata01','$cdata02','$cdata03','$cdata04','$cdata05','$cdata06','$cdata07','$etc01','$etc02','$etc03','$etc04')";
		$result03 = mysql_query($sql03);
	}



	$sql = "select * from ks_order where userid='$userid' and reg_date='$reg_date' order by uid desc limit 1";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$uid = $row['uid'];




	//문자발송
	mysql_close($dbconn);
	unset($db);
	unset($dbconn);

	$SMS_ADMIN = 'leehyunjoo';
	$SMS_TYPE = 'order';

	//sms 데이터베이스 접속
	include '../module/class/class.DbConSmsHub.php';
	include '../module/SmsHub.php';




	$msg = '주문이 접수되었습니다';
	Msg::goNext('/orderlist/sub01.php?type=view&uid='.$uid);
?>
