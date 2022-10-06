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

    chk = document.getElementsByName('cnumber[]');
	isChk = false;

    for(i=0; i<chk.length; i++){
		if(chk[i].value)		isChk = true; 
    }

	if(!isChk){
		alert('쿠폰번호를 입력해 주시기 바랍니다.');
		chk[0].focus();
		return;
	}

	form = document.frm_order;
	form.target = 'ifra_coupon';
	form.action = 'CheckCoupon2.php';
	form.submit();
}

function CouponCancel(){
	chk = parent.document.getElementsByName('cnumber[]');

	for(i=0; i<chk.length; i++){
		chk[i].value = '';
		chk[i].readOnly = false;
		chk[i].className = 'ctxt01';
	}

	form = document.frm_order;
	form.cPrice.value = 0;

	document.getElementById('DivCamt').innerHTML = '';

	obj = document.getElementById('DivCoupon');
	obj.style.display = 'none';
}


//적립금사용
function PointChk(){
	form = document.frm_order;

	if(isFrmEmpty(form.upoint,"사용 적립금을 입력해 주십시오"))	return;

	upoint = parseFloat(form.upoint.value);		//사용하려는 적립금
	opoint = parseFloat(form.opoint.value);		//보유한 적립금
	amt = parseFloat(form.amt.value);			//결제금액

	form.uPrice.value = 0;

	if(upoint > opoint){
		alert('사용가능한 적립금이 부족합니다');
		form.upoint.focus();
		return;

	}else if(upoint > amt){
		alert('결제금액 내에서만 적립금사용이 가능합니다');
		form.upoint.focus();
		return;

	}else{
		form.uPrice.value = upoint;

		result = amt - upoint;

		document.getElementById("Divres").innerHTML = "<b>"+number_format(result)+"원</b>";

		form.amt.value = result;
		form.upoint.readOnly = true;
		form.upoint.className = 'ctxt02';

		document.getElementById("DivpBtn").innerHTML = "<a href='javascript:PointCancel();' onClick='this.blur()' class='big cbtn blue'>취소</a>";


		//쿠폰취소
		CouponCancel();
	}
}

//적립금취소
function PointCancel(){
	form = document.frm_order;

	upoint = parseFloat(form.upoint.value);
	amt = parseFloat(form.amt.value);
	result = upoint + amt;
	form.amt.value = result;
	form.uPrice.value = 0;

	document.getElementById("Divres").innerHTML = "<b>"+number_format(result)+"원</b>";

	form.upoint.value = '';
	form.upoint.readOnly = false;
	form.upoint.className = 'ctxt01';

	document.getElementById("DivpBtn").innerHTML = "<a href='javascript:PointChk();' onClick='this.blur()' class='big cbtn blue'>적용</a>";

	//쿠폰취소
	CouponCancel();
}

//쿠폰번호 오류필드
function ctxtChk(o){
	if(o.readOnly == false){
		o.className = 'ctxt01';
	}
}
</script>

<input type='hidden' name='cPrice' value='0'><!-- 쿠폰가 -->
<input type='hidden' name='uPrice' value='0'><!-- 사용적립금 -->

<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<tr>
		<td>
			
			<table border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td class="order_ttl" width="90">결제정보</td>
				</tr>
			</table>
		
		</td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="1" bgcolor="484848" style='padding:1px 0px 0px 0px;'></td>
	</tr>

	<tr>
		<td>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class='gTable2'>
			
			<?
				//회원 주문시 적립금 사용필드를 활성화 한다
				if($GBL_USERID){
			?>
				<input type='hidden' name='opoint' value='<?=$opoint?>'>
				<tr bgcolor="#FFFFFF" height='35'>
					<th class="stab_tit_b">적립금사용</th>
					<td class='stab'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><input type="number" name="upoint" value="" class='cTxt01'> 원<br>(사용가능한 적립금 : <font color="#0000ff"><b><?=number_format($opoint)?>원</b></font>)</td>
								<td style='padding:0px 0px 0px 10px;' id='DivpBtn'><a href="javascript:PointChk();" onClick="this.blur()" class='big cbtn blue'>적용</a></td>
							</tr>
						</table>
					</td>
				</tr>
			<?
				}else{
			?>
				<input type='hidden' name='upoint' value='0'>
			<?
				}
			?>
			
				<tr height='35'>
					<th width="20%" class="stab_tit_b">결제방법</td>
					<td width="80%" class='stab'>
						<input type='radio' name='pay_mode' value='신용카드' checked onClick="ac_chk('');">신용카드&nbsp;&nbsp;&nbsp;&nbsp;
						<input type='radio' name='pay_mode' value='계좌이체' onClick="ac_chk('');">계좌이체&nbsp;&nbsp;&nbsp;&nbsp;		
					
<!--		
						<input type='radio' name='pay_mode' value='무통장입금' onClick="ac_chk('');">무통장입금&nbsp;&nbsp;&nbsp;&nbsp;
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

				<tr bgcolor="#FFFFFF" height='35'>
					<th class="stab_tit_b">배송비</td>
					<td class='stab'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><input type='radio' name='ship_mode' value='선불' onclick='setShip();' checked>선불</td>
								<td style='padding:0px 0px 0px 20px;'><input type='radio' name='ship_mode' value='착불' onclick='setShip();'>착불</td>
								<td style='padding:5px 0px 0px 20px;color:#ff0000;'><b>(제주도, 도서산간 지역에는 추가요금이 발생할 수 있습니다)</b></td>
							</tr>
						</table>
					</td>
				</tr>
-->
				<tr bgcolor="#FFFFFF" height='35'>
					<th class="stab_tit_b">결제금액</td>
					<td class='stab'><div id='Divres' class='font_red'><b><?=number_format($amt)?>원</div></td>
				</tr>
			
			<?
				if($cnt > 0){
			?>
				<tr bgcolor="#FFFFFF" height='35'>
					<td class="stab_tit_b">쿠폰사용</td>
					<td class='stab'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
								<?
									for($c=0; $c<$cnt; $c++){
										if($c > 0)	$tclass = "style='margin:3px 0 0 0;'";
										else			$tclass = '';
								?>
									<div <?=$tclass?>><input type='text' name='cnumber[]' style='width:130px;height:28px;ime-mode:disabled;' maxlength='13' class='cTxt01' onclick="ctxtChk(this);"></div>
								<?
									}
								?>
								</td>
								<td style='padding:0px 0px 0px 10px;'><a href="javascript:CouponChk();" onClick="this.blur()"><img src='/images/coupon_btn.gif' align='absmiddle'></a></td>
								<td style='padding:0px 0px 0px 10px;'>* 쿠폰사용 가능 카테고리 : 여성한복 / 남성한복 / 커플한복 / 촬영한복 / 혼주한복 / 친인척한복 / 잔치한복</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr height='35' id='DivCoupon' style='display:none;'>
					<td class="stab_tit_b">쿠폰적용가</td>
					<td class='stab' id='DivCamt'></td>
				</tr>
			<?
				}
			?>
			
			</table>
		
		</td>
	</tr>
</table>


<!-- 쿠폰사용 iframe -->
<iframe name='ifra_coupon' src='about:blank' frameborder='0' scrolling='no' width='0' height='0'></iframe>
<!-- /쿠폰사용 iframe -->