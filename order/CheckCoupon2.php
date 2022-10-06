<?
	include '../module/class/class.DbCon.php';
	include '../module/class/class.Util.php';
	include '../module/class/class.Msg.php';
?>

<script language='javascript' src='/module/js/common.js'></script>

<script language='javascript'>
function cError(t,n){
	alert(t);

	chk = parent.document.getElementsByName('cnumber[]');
	chk[n].className = 'ctxt02';
	chk[n].focus();

	form = parent.document.frm_order;
	form.cPrice.value = 0;

	parent.document.getElementById('DivCamt').innerHTML = '';

	obj = parent.document.getElementById('DivCoupon');
	obj.style.display = 'none';
}

function cOk(c){
	obj = parent.document.getElementById('DivCoupon');
	obj.style.display = 'table-row';

	chk = parent.document.getElementsByName('cnumber[]');

	for(i=0; i<chk.length; i++){
		chk[i].readOnly = true;
		chk[i].className = 'ctxt02';
	}

	form = parent.document.frm_order;

	amt = form.amt.value;
	coupon = c;
	form.cPrice.value = coupon;

	tot = parseInt(amt) - parseInt(coupon);

	refund = '';

	if(tot < 0)	tot = 0;

	parent.document.getElementById('DivCamt').innerHTML = "<table cellpadding='0' cellspacing='0' border='0'><tr><td class='cTxt03'>"+number_format(tot)+" 원</span></td><td style='padding:0px 0px 0px 30px;'><a href='javascript:CouponCancel();'><img src='/images/coupon_cancel.gif' align='absmiddle'></a></td></tr></table>";
}
</script>



<?
	$cnt = count($cnumber);

	if($cnt == 0){
		Msg::backMsg('접근오류');
		exit;

	}else{
		$cAmt = 0;

		for($i=0; $i<$cnt; $i++){
			$coupon = $cnumber[$i];

			if($coupon){
				//쿠폰 유효성검사
				$cChk = Util::CouponCheck($coupon,$dbconn);

				if($cChk == ''){
					echo ("<script language='javascript'>cError('잘못된 쿠폰번호입니다',$i);</script>");
					exit;

				}elseif($cChk == 'used'){
					echo ("<script language='javascript'>cError('이미 사용된 쿠폰번호입니다',$i);</script>");
					exit;

				}elseif($cChk == 'end'){
					echo ("<script language='javascript'>cError('유효기간이 만료된 쿠폰입니다',$i);</script>");
					exit;

				}elseif($cChk > 0){
					$cAmt += 1;
				}
			}
		}

		if($cAmt > 0){
			$cAmtTot = $cAmt * 79000;
			echo ("<script language='javascript'>cOk($cAmtTot);</script>");
			exit;
		}
	}
?>