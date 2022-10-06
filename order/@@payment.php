<script language='javascript'>
function ac_chk(chk){

	if(chk){
		document.all.account01.style.display = '';
	}else{
		document.all.account01.style.display = 'none';
	}

}

function setShip(){
	form = document.frm_order;

	amt = parseFloat(form.amt.value);			//결제금액
	sp = parseFloat(form.ship_price.value);		//배송비

	if(form.ship_mode[0].checked == true){
		LastTotal = amt + sp;
	}else{
		LastTotal = amt - sp;
	}

	form.amt.value = LastTotal;

	//결제정보스탭
	document.getElementById("Divres").innerHTML = "<b>"+number_format(LastTotal)+"원</b>";

	//쿠폰취소
	CouponCancel();
}

function CouponChk(){
	form = document.frm_order;

	if(isFrmEmpty(form.cnum01,"쿠폰번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.cnum02,"쿠폰번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.cnum03,"쿠폰번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.cnum04,"쿠폰번호를 입력해 주십시오"))	return;

	form.target = 'ifra_coupon';
	form.action = 'CheckCoupon.php';
	form.submit();
}

function CouponCancel(){
	form = document.frm_order;

	form.cnum01.value = '';
	form.cnum01.readOnly = false;
	form.cnum01.className = 'ctxt01';
	form.cnum02.value = '';
	form.cnum02.readOnly = false;
	form.cnum02.className = 'ctxt01';
	form.cnum03.value = '';
	form.cnum03.readOnly = false;
	form.cnum03.className = 'ctxt01';
	form.cnum04.value = '';
	form.cnum04.readOnly = false;
	form.cnum04.className = 'ctxt01';

	form.cPrice.value = 0;

	document.getElementById('DivCamt').innerHTML = '';

	obj = document.getElementById('DivCoupon');
	obj.style.display = 'none';
}
</script>

<input type='hidden' name='cPrice' value='0'><!-- 쿠폰가 -->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			
			<table border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td width="10"><img src="/images/bullet_order.gif" border='0' /></td>
					<td class="order_ttl" width="90">결제정보</td>
				</tr>
			</table>
		
		</td>
	</tr>

	<tr>
		<td>
			
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
				<tr height='35'>
					<td width="20%" class="stab_tit_b">결제방법</td>
					<td width="80%" class='stab'>
						<input type='radio' name='pay_mode' value='신용카드' checked onClick="ac_chk('');">신용카드&nbsp;&nbsp;&nbsp;&nbsp;
						<input type='radio' name='pay_mode' value='계좌이체' onClick="ac_chk('');">계좌이체&nbsp;&nbsp;&nbsp;&nbsp;
						<input type='radio' name='pay_mode' value='무통장입금' onClick="ac_chk('');">무통장입금&nbsp;&nbsp;&nbsp;&nbsp;
<!--
						<input type='radio' name='pay_mode' value='주문완료' onClick="ac_chk('1');">주문완료
						<input type='radio' name='pay_mode' value='3' onClick="ac_chk('');">가상계좌&nbsp;&nbsp;&nbsp;&nbsp;
						<input type='radio' name='pay_mode' value='4' onClick="ac_chk('');">핸드폰
-->
					</td>
				</tr>
<!--
				<tr id='account01' style="display:none;" bgcolor="#FFFFFF" height='30'>
					<td class="stab_tit_b">입금계좌</td>
					<td class='stab'>입금자 : <input type="text" name='ac_name' style='width:100px;' value='<?=$oname?>'>&nbsp;<input type='radio' name='ac_type' value='1' checked onClick="acc_chk('1');">은행명 : <b>11111111</b> &nbsp; 예금주 : 예스관광개발(주)</td>
				</tr>
-->
				<tr bgcolor="#FFFFFF" height='35'>
					<td class="stab_tit_b">배송비</td>
					<td class='stab'>
						<input type='radio' name='ship_mode' value='선불' onclick='setShip();' checked>선불&nbsp;&nbsp;&nbsp;&nbsp;
						<input type='radio' name='ship_mode' value='착불' onclick='setShip();'>착불
					</td>
				</tr>

				<tr bgcolor="#FFFFFF" height='35'>
					<td class="stab_tit_b">결제금액</td>
					<td class='stab'><div id='Divres' class='font_red'><b><?=number_format($amt)?>원</div></td>
				</tr>

				<tr bgcolor="#FFFFFF" height='35'>
					<td class="stab_tit_b">쿠폰사용</td>
					<td class='stab'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
									<input type='text' name='cnum01' class='cTxt01' maxlength='5' onKeyUp="return autoTab(this, 5, event);"> - 
									<input type='text' name='cnum02' class='cTxt01' maxlength='5' onKeyUp="return autoTab(this, 5, event);"> - 
									<input type='text' name='cnum03' class='cTxt01' maxlength='5' onKeyUp="return autoTab(this, 5, event);"> - 
									<input type='text' name='cnum04' class='cTxt01' maxlength='5'>
								</td>
								<td style='padding:0px 0px 0px 10px;'><a href="javascript:CouponChk();" onClick="this.blur()"><img src='/images/coupon_btn.gif' align='absmiddle'></a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr height='35' id='DivCoupon' style='display:none;'>
					<td class="stab_tit_b">쿠폰적용가</td>
					<td class='stab' id='DivCamt'></td>
				</tr>
			</table>
		
		</td>
	</tr>
</table>


<!-- 쿠폰사용 iframe -->
<iframe name='ifra_coupon' src='about:blank' frameborder='0' scrolling='no' width='0' height='0'></iframe>
<!-- /쿠폰사용 iframe -->