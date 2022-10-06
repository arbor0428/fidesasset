<?
	$mNum = '9';
	$sNum = '1';

	include '../header.php';

	$path = '../upfile/';	//상품이미지경로

	$G_Size01 = '120';	//이미지크기
	$G_Size02 = '150';	//이미지크기
?>


<script language='javascript'>
function check_form(){
	form = document.frm_order;

	if(form.cart_idx.value == ''){
		alert('주문상품이 없습니다');
		return;
	}

	if(isFrmEmpty(form.oname,"[주문자정보]\n성명을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.ozipcode,"[주문자정보]\n우편번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.oaddr1,"[주문자정보]\n기본주소를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.oaddr2,"[주문자정보]\n상세주소를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.otel1,"[주문자정보]\n유선전화번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.otel2,"[주문자정보]\n유선전화번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.otel3,"[주문자정보]\n유선전화번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.ohp1,"[주문자정보]\n휴대전화번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.ohp2,"[주문자정보]\n휴대전화번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.ohp3,"[주문자정보]\n휴대전화번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.oemail,"[주문자정보]\n이메일을 입력해 주십시오"))	return;

	if(isFrmEmpty(form.pname,"[배송지정보]\n성명을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.pzipcode,"[배송지정보]\n우편번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.paddr1,"[배송지정보]\n기본주소를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.paddr2,"[배송지정보]\n상세주소를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.ptel1,"[배송지정보]\n유선전화번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.ptel2,"[배송지정보]\n유선전화번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.ptel3,"[배송지정보]\n유선전화번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.php1,"[배송지정보]\n휴대전화번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.php2,"[배송지정보]\n휴대전화번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.php3,"[배송지정보]\n휴대전화번호를 입력해 주십시오"))	return;

	//거래불가고객확인
	oaddr1 = form.oaddr1.value;	oaddr2 = form.oaddr2.value;
	otel1 = form.otel1.value;	otel2 = form.otel2.value;	otel3 = form.otel3.value;
	ohp1 = form.ohp1.value;	ohp2 = form.ohp2.value;	ohp3 = form.ohp3.value;
	oemail = form.oemail.value;

	paddr1 = form.paddr1.value;	paddr2 = form.paddr2.value;
	ptel1 = form.ptel1.value;	ptel2 = form.ptel2.value;	ptel3 = form.ptel3.value;
	php1 = form.php1.value;	php2 = form.php2.value;	php3 = form.php3.value;

	userid = form.userid.value;

	$.post('../module/BlackUserChk.php',{'userid':userid,'oaddr1':oaddr1,'oaddr2':oaddr2,'otel1':otel1,'otel2':otel2,'otel3':otel3,'ohp1':ohp1,'ohp2':ohp2,'ohp3':ohp3,'oemail':oemail,'paddr1':paddr1,'paddr2':paddr2,'ptel1':ptel1,'ptel2':ptel2,'ptel3':ptel3,'php1':php1,'php2':php2,'php3':php3}, function(cnt){
		if(cnt){
			alert('고객센터로 문의주시기바랍니다');
			return;

		}else{
			
			amt = parseFloat(form.amt.value);
			cPrice = parseFloat(form.cPrice.value);

			if(userid == '' && cPrice > amt){
				modPrice = number_format(cPrice-amt);
				if(!confirm('회원가입 후 쿠폰을 사용하시면 남은금액인 '+modPrice+'원을\n적립금으로 받으실 수 있습니다\n비회원으로 결제를 진행하시겠습니까?'))	 return;
			}

			//쿠폰적용 후 결제금액이 0원이하 또는 적립금 사용으로 인해 결제금액이 0원일 경우
			if(cPrice >= amt || amt == 0){
				form.target = '';
				form.action = 'proc.php';
				form.submit();

			}else{
				form.target = 'ifra_pay';
				form.action = '../module/lgu/index.php';
				form.submit();
			}

		}
	});




	

}

function onlyNumber(){
	var key = event.keyCode;
	
    if(key >= 48 && key <= 57){
		event.returnValue=true;
	}else{
		alert("숫자만 입력 가능합니다");
		event.returnValue=false;
	}
}
</script>

<!-- LGU+ 결제모듈설치 -->
<script language="javascript" src="<?= $_SERVER['SERVER_PORT']!=443?"http":"https" ?>://xpay.lgdacom.net<?=($CST_PLATFORM == "test")?($_SERVER['SERVER_PORT']!=443?":7080":":7443"):""?>/xpay/js/xpay.js" type="text/javascript"></script>


<form name='frm_order' method='post' action='proc.php'>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='type' value=''>
<input type='hidden' name='userid' value='<?=$GBL_USERID?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td align="center">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height='20'></td>
				</tr>

				<tr>
					<td>
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td height='40' style="background:url('../images/new/dot02.gif') repeat-x bottom;">
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td>
												<table cellpadding='0' cellspacing='0' border='0'>
													<tr height='40'>
														<td align="left" style="background:url('../images/new/dot01.gif') repeat-x bottom;"><font size="5" face="나눔고딕"><strong>주문하기</strong></font></td>
													</tr>
												</table>
											</td>
											<td align="right" valign="bottom"><a href="#">Home</a> > <strong>주문하기</strong></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td> 
				</tr>

				<tr>
					<td style='padding:20px 0px 0px 0px;'>
						<!-- 상품주문 -->
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td>						
									<!---------------------          주문내역      ----------------------------->
									<?
										include 'list2.php';
//										include 'list.php';
									?>
									<!---------------------          주문내역  END    ----------------------------->					
								</td>
							</tr>

							<tr>
								<td style='padding:50px 0px 0px 0px;'>						
									<!---------------------        주문자정보      ----------------------------->
									<?
										include 'info.php';
									?>
									<!---------------------          주문자정보  END    ----------------------------->					
								</td>
							</tr>
							<tr>
								<td height="30"></td>
							</tr>
							<tr>
								<td>						
									<!---------------------        결제정보      ----------------------------->
									<?
										include 'payment.php';
									?>
									<!---------------------          결제정보  END    ----------------------------->					
								</td>
							</tr>
							<tr>
								<td height="60"></td>
							</tr>
							<tr>
								<td align="center">
								<div class="shop_btn" style='width:25%;'>
									<a href="javascript:check_form();" >
										<div style="padding:12px 0px; font-size:17px; font-weight:bold; ">바로 구매</div>
									</a>
								</div>
									<!-- 버튼 -->
									<!-- <table border="0" cellspacing="0" cellpadding="0">
										<tr>
										<?
											if($total_record != '0'){
										?>
											<td><a href="javascript:check_form();"  onFocus="this.blur()" ><img src="/images/btn/btn_pay.gif" border='0' /></a></td>
											<td width="50"></td>
										<?
											}
										?>
											<td><a href="javascript:GoMenu('home');"  onFocus="this.blur()" ><img src="/images/btn/btn_ordercancel.gif" border='0' /></a></td>
										</tr>
									</table> -->
									<!-- 버튼 END-->
								
								</td>
							</tr>
						</table>
						<!-- 상품주문 END-->
					</td>
				</tr>

			</table>
		</td>
	</tr>
</table>

</form>


<iframe name='ifra_pay' src='about:blank' width='0' height='0' frameborder='0' scrolling='no'></iframe>

<?
	//하단
	include '../footer.php';
?>