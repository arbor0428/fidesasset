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
				<tr height='30'>
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
				<tr bgcolor="#FFFFFF" height='30'>
					<td class="stab_tit_b">배송비</td>
					<td class='stab'>
						<input type='radio' name='ship_mode' value='선불' onclick='setShip();' checked>선불&nbsp;&nbsp;&nbsp;&nbsp;
						<input type='radio' name='ship_mode' value='착불' onclick='setShip();'>착불
					</td>
				</tr>

				<tr bgcolor="#FFFFFF" height='30'>
					<td class="stab_tit_b">결제금액</td>
					<td class='stab'><div id='Divres' class='font_red'><b><?=number_format($amt)?>원</div></td>
				</tr>
			</table>
		
		</td>
	</tr>
</table>