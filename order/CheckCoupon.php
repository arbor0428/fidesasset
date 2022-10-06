<?
	include '../module/class/class.DbCon.php';
	include '../module/class/class.Util.php';
	include '../module/class/class.Msg.php';

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
	}

?>


<script language='javascript' src='/module/js/common.js'></script>


<?
	if($cChk == ''){
?>

<script language='javascript'>
	alert('잘못된 쿠폰번호입니다');

	form = parent.document.frm_order;
	form.cnum01.value = '';
	form.cnum02.value = '';
	form.cnum03.value = '';
	form.cnum04.value = '';

	parent.document.getElementById('DivCamt').innerHTML = '';

	obj = parent.document.getElementById('DivCoupon');
	obj.style.display = 'none';
</script>






<?
	}elseif($cChk == 'used'){
?>

<script language='javascript'>
	alert('이미 사용된 쿠폰번호입니다');

	form = parent.document.frm_order;
	form.cnum01.value = '';
	form.cnum02.value = '';
	form.cnum03.value = '';
	form.cnum04.value = '';
	form.cPrice.value = 0;

	parent.document.getElementById('DivCamt').innerHTML = '';

	obj = parent.document.getElementById('DivCoupon');
	obj.style.display = 'none';
</script>






<?
	}elseif($cChk == 'end'){
?>

<script language='javascript'>
	alert('유효기간이 만료된 쿠폰번호입니다');

	form = parent.document.frm_order;
	form.cnum01.value = '';
	form.cnum02.value = '';
	form.cnum03.value = '';
	form.cnum04.value = '';
	form.cPrice.value = 0;

	parent.document.getElementById('DivCamt').innerHTML = '';

	obj = parent.document.getElementById('DivCoupon');
	obj.style.display = 'none';
</script>






<?
	}elseif($cChk > 0){
?>

<script language='javascript'>
	obj = parent.document.getElementById('DivCoupon');
	obj.style.display = 'table-row';

	form = parent.document.frm_order;

	userid = form.userid.value;

	form.cnum01.readOnly = true;
	form.cnum01.className = 'ctxt02';
	form.cnum02.readOnly = true;
	form.cnum02.className = 'ctxt02';
	form.cnum03.readOnly = true;
	form.cnum03.className = 'ctxt02';
	form.cnum04.readOnly = true;
	form.cnum04.className = 'ctxt02';

	amt = form.amt.value;
	coupon = '<?=$cChk?>';
	form.cPrice.value = coupon;

	tot = parseInt(amt) - parseInt(coupon);

	refund = '';

	if(tot < 0){
		totTxt = tot * -1;

		if(userid)		refund = '쿠폰사용 후 남은금액인 <b>'+number_format(totTxt)+'</b> 원은 적립금으로 적립됩니다';
		else			refund = '<b>회원가입</b> 후 쿠폰을 사용하시면 남은금액인 <b>'+number_format(totTxt)+'</b> 원은 적립금으로 적립됩니다';

		tot = 0;
	}

	parent.document.getElementById('DivCamt').innerHTML = "<table cellpadding='0' cellspacing='0' border='0'><tr><td class='cTxt03'>"+number_format(tot)+" 원</span></td><td style='padding:0px 0px 0px 30px;'><a href='javascript:CouponCancel();'><img src='/images/coupon_cancel.gif' align='absmiddle'></a></td><td style='padding:0px 0px 0px 10px;'>"+refund+"</td></tr></table>";
</script>

<?
	}
?>