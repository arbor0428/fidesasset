<?
	include '../header.php';

	$path = '../upfile/shop/';	//상품이미지경로

	$G_Size01 = '120';	//이미지크기
	$G_Size02 = '150';	//이미지크기

	//접속 디바이스확인
	require_once '../module/Mobile-Detect-master/Mobile_Detect.php';
	$detect = new Mobile_Detect;

	$UserOS = '';
	$Device = '';

	//모바일인경우
	if($detect->isMobile()){
		$UserOS = 'mobile';
		
		if($detect->isiOS()){
			$Device = 'iOS';
		}
	}else{
		$UserOS = 'pc';
	}


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

	userid = form.userid.value;
	amt = parseFloat(form.amt.value);
	cPrice = parseFloat(form.cPrice.value);

/*
	if(userid == '' && cPrice > amt){
		modPrice = number_format(cPrice-amt);
		if(!confirm('회원가입 후 쿠폰을 사용하시면 남은금액인 '+modPrice+'원을\n적립금으로 받으실 수 있습니다\n비회원으로 결제를 진행하시겠습니까?'))	 return;
	}
*/

	//쿠폰적용 후 결제금액이 0원이하 또는 적립금 사용으로 인해 결제금액이 0원일 경우
	if(cPrice >= amt || amt == 0){
		form.target = '';
		form.action = 'proc2.php';
		form.submit();

	}else{

		//접속디바이스
		device = form.UserOS.value;

		if(device == 'pc'){
			$('#pgFrame').html("<iframe src='about:blank' name='ifra_kcp' id='ifra_kcp' width='740' height='565' frameborder='0' scrolling='no'></iframe>");
			$(".pgBox_open").click();

			form.type.value = 'write';
			form.target = 'ifra_kcp';
			form.action = '/module/kcp/sample/order.php';
			form.submit();

		}else if(device == 'mobile'){
			payWin = window.open("about:blank","kcpBox");
			form.type.value = 'write';
			form.target = 'kcpBox';
			form.action = '/module/kcp/mobile_sample/order_mobile.php';
			form.submit();
		}
		
/*

		if(UserOS == 'mobile'){
			form.target = '';
			form.action = '../module/lgu_xmobile/index.php';
			form.submit();

		}else{
			form.target = '';
			form.action = 'xpay.php';
			form.submit();

		 //구형
			form.target = 'ifra_pay';
			form.action = '../module/lgu/index.php';
			form.submit();
		
		}
		*/
	}
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


<form name='frm_order' method='post' action='proc.php'>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='type' value=''>
<input type='hidden' name='userid' value='<?=$GBL_USERID?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='UserOS' value='<?=$UserOS?>'>
<input type='hidden' name='Device' value='<?=$Device?>'>
<input type='hidden' name='callChk' id='callChk' value='1'><!-- 모바일 결제창 호출용 -->

<style>
	/*화면 너비 0 ~ 1050px*/
	@media (max-width: 1050px){
		.content_box_wrap {padding:25px !important;}
		.content_box {padding:12px !important;}
	}

	/*화면 너비 0 ~ 550px*/
	@media (max-width: 550px){
		.content_box_wrap {padding: 0px !important;}
	}
</style>


<div class="sub_visual sub_visual02 visual_wrap">
	<div class="text-box">장바구니</div>
</div>

<div class="content_box_wrap" style=''>
	<div class='content_box' style='width:1100px;'>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			

			<tr>
				<td>
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
							<td>						
								<!---------------------        결제정보      ----------------------------->
								<?
									include 'payment2.php';
//										include 'payment.php';
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
								<!-- 버튼
								<table border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td><a href="javascript:check_form();"  onFocus="this.blur()" ><img src="/images/btn/btn_pay.gif" border='0' /></a></td>
										<td width="50"></td>
										<td><a href="javascript:GoMenu('home');"  onFocus="this.blur()" ><img src="/images/btn/btn_ordercancel.gif" border='0' /></a></td>
									</tr>
								</table>
								버튼 END-->
							
							</td>
						</tr>
					</table>
					<!-- 상품주문 END-->
				</td>
			</tr>

		</table>
	</div>
</div>
</form>


<iframe name='ifra_pay' src='about:blank' width='0' height='0' frameborder='0' scrolling='no'></iframe>

<?
	//하단
	include '../footer.php';
?>