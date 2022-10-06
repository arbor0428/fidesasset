<?
	$mNum = '9';
	$sNum = '1';

	include '../header.php';

	$path = '../upfile/';	//상품이미지경로

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
	}
?>


<form name='frm_order' method='post'>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='type' value=''>
<input type='hidden' name='userid' value='<?=$GBL_USERID?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='UserOS' value='<?=$UserOS?>'>
<input type='hidden' name='Device' value='<?=$Device?>'>
<div class="sub_top01 sub_top">
	<div class="sub_tit_line"></div>
	<div class="sub_tit">
		주문하기
	</div>
</div>

<div style='padding:50px;background:#fafafa'>
	<div class='content_box'>
		<table width="1100" border="0" cellpadding="0" cellspacing="0">
			

			<tr>
				<td style='padding:0px 0px 0px 0px;'>
					<!-- 상품주문 -->
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td>						
								<!---------------------          주문내역      ----------------------------->
								<?
									include 'list2_xpay.php';
								?>
								<!---------------------          주문내역  END    ----------------------------->					
							</td>
						</tr>

						<tr>
							<td style='padding:50px 0px 0px 0px;'>						
								<!---------------------        주문자정보      ----------------------------->
								<?
									include 'info_xpay.php';
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
									include 'payment2_xpay.php';
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
									<a href="up_index.php" >
										<div style="padding:12px 0px; font-size:17px; font-weight:bold; ">돌아가기</div>
									</a>
								</div>	
							<!--<a href="up_index.php"  onFocus="this.blur()" ><img src="/images/btn/btn_ordercancel.gif" border='0' /></a>-->
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


<?
	//결제모듈
	include '../module/lgu_xpay/payreq_crossplatform.php';
?>


<?
	//하단
	include '../footer.php';
?>