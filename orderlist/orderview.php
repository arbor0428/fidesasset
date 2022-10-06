<?	
	if($uid){
		$sql01 = "select * from ks_order where uid='$uid'";
		$result01 = mysql_query($sql01);
		$row01 = mysql_fetch_array($result01);

		$userid = $row01["userid"];
		$oname = $row01["oname"];
		$ozip1 = $row01["ozip1"];
		$ozip2 = $row01["ozip2"];
		$ozipcode = $row01["ozipcode"];
		$oaddr1 = $row01["oaddr1"];
		$oaddr2 = $row01["oaddr2"];
		$otel1 = $row01["otel1"];
		$otel2 = $row01["otel2"];
		$otel3 = $row01["otel3"];
		$ohp1 = $row01["ohp1"];
		$ohp2 = $row01["ohp2"];
		$ohp3 = $row01["ohp3"];
		$oemail = $row01["oemail"];

		$pname = $row01["pname"];
		$pzip1 = $row01["pzip1"];
		$pzip2 = $row01["pzip2"];
		$pzipcode = $row01["pzipcode"];
		$paddr1 = $row01["paddr1"];
		$paddr2 = $row01["paddr2"];
		$ptel1 = $row01["ptel1"];
		$ptel2 = $row01["ptel2"];
		$ptel3 = $row01["ptel3"];
		$php1 = $row01["php1"];
		$php2 = $row01["php2"];
		$php3 = $row01["php3"];

		$ment = $row01["ment"];
		$paymode = $row01["paymode"];
		$account = $row01["account"];
		$result_price = $row01["result_price"];
		$ship_price = $row01["ship_price"];
		$ship_mode = $row01["ship_mode"];
		$ship_num = $row01["ship_num"];
		$amt = $row01["amt"];
		$saleTxt = $row01["saleTxt"];
		$sale_price = $row01["sale_price"];
		$coupon = $row01["coupon"];
		$coupon_price = $row01["coupon_price"];
		$point = $row01["point"];
		$status = $row01["status"];
		$ip = $row01["ip"];
		$reg_date = $row01["reg_date"];
		$reg_date_txt = date("Y-m-d H:i:s",$reg_date);

		$virno = $row01['virno'];	//가상계좌번호
		$virbank = $row01['virbank'];	 //가상계좌은행

		$result_priceTxt = number_format($result_price);
		$ship_priceTxt = number_format($ship_price);
		$amtTxt = number_format($amt);

		if($ship_mode == '착불')	$ship_modeTxt = "<font color='#ff0000'><b>착불</b></font>";
		else								$ship_modeTxt = $ship_mode;



		//결제수단설정
		$payTxt = '';

		if($paymode != '-')	$payTxt = $paymode;

		if($coupon && $coupon_price){
			if($payTxt)	$payTxt .= "<br>+<br>";
			$payTxt .= "쿠폰";
		}

		if($point){
			if($payTxt)	$payTxt .= "<br>+<br>";
			$payTxt .= "적립금";
		}
	}
?>



<script language="javascript">
function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = 'sub01.php';
	form.submit();
}

function order_review(uid){
	action = '/module/common/boardWrite.php?myorder=1&pid='+uid;
	document.getElementById("multiFrame").innerHTML = "<iframe src='"+action+"' id='ifra_board' name='ifra_board' width='600' height='720' frameborder='0' scrolling='no'></iframe>";

	$(".multiBox_open").click();
}

function order_review_close(){
	$(".multiBox_close").click();

	document.getElementById("confirmTxt").innerText = '이용후기가 등록되었습니다.';

	document.getElementById("confirmBtnCancel").innerHTML = "<input type='button' class='btn_notice_reg_cancel' value='닫기' />";

	document.getElementById("confirmBtn").innerHTML = "<input type='button' class='btn_notice_reg_add' value='보러가기' onclick=\"location.href='/sub08/sub05.php'\">";

	$(".conFirm_open").click();
}
</script>
<form name='FRM' method='post' action="<?=$PHP_SELF?>">
<input type='hidden' name='type' value=''>

<!-- 비회원 주문검색용 -->
<input type='hidden' name='f_oname' value='<?=$f_oname?>'>
<input type='hidden' name='f_ohp1' value='<?=$f_ohp1?>'>
<input type='hidden' name='f_ohp2' value='<?=$f_ohp2?>'>
<input type='hidden' name='f_ohp3' value='<?=$f_ohp3?>'>
<!-- /비회원 주문검색용 -->

<!-- 관리자 주문검색용 -->
<input type='hidden' name='f_field' value='<?=$f_field?>'>
<input type='hidden' name='f_word' value='<?=$f_word?>'>
<!-- /관리자 주문검색용 -->


<table width="100%" border="0" cellspacing="0" cellpadding="0">

<!-- 주문상품정보 -->

<?
	$sql02 = "select * from ks_order_list where userid='$userid' and code='$reg_date' order by uid";
	$result02 = mysql_query($sql02);
	$num = mysql_num_rows($result02);

	for($i=0; $i<$num; $i++){
		$no = $i + 1;
		$imgTag = '';

		$row02 = mysql_fetch_array($result02);
		$pid = $row02['pid'];
		$pcade01 = $row02['pcade01'];
		$pcade02 = $row02['pcade02'];
		$ptitle = $row02['ptitle'];
		$pdate = $row02['pdate'];
		$pea = $row02['pea'];
		$price01 = $row02['price01'];
		$price02 = $row02['price02'];
		$price03 = $row02['price03'];

		$gdata01 = $row02['gdata01'];
		$gdata02 = $row02['gdata02'];
		$gdata03 = $row02['gdata03'];
		$gdata04 = $row02['gdata04'];
		$gdata05 = $row02['gdata05'];
		$gdata06 = $row02['gdata06'];
		$gdata07 = $row02['gdata07'];
		$gdata08 = $row02['gdata08'];
		$gdata09 = $row02['gdata09'];

		//여성한복 > 촬영한복 주문옵션
		$etc01 = $row02['etc01'];			//아얌
		$etc02 = $row02['etc02'];			//비녀
		$etc03 = $row02['etc03'];			//뱃씨댕기
		$etc04 = $row02['etc04'];			//노리개

		$mdata01 = $row02['mdata01'];
		$mdata02 = $row02['mdata02'];
		$mdata03 = $row02['mdata03'];
		$mdata04 = $row02['mdata04'];
		$mdata05 = $row02['mdata05'];

		$bdata01 = $row02['bdata01'];
		$bdata02 = $row02['bdata02'];
		$bdata03 = $row02['bdata03'];
		$bdata04 = $row02['bdata04'];
		$bdata05 = $row02['bdata05'];
		$bdata06 = $row02['bdata06'];
		$bdata07 = $row02['bdata07'];

		$cdata01 = $row02['cdata01'];
		$cdata02 = $row02['cdata02'];
		$cdata03 = $row02['cdata03'];
		$cdata04 = $row02['cdata04'];
		$cdata05 = $row02['cdata05'];
		$cdata06 = $row02['cdata06'];
		$cdata07 = $row02['cdata07'];

		$pdateTxt = date('Y-m-d',$pdate);
		$peaTxt = number_format($pea);
		$price01Txt = number_format($price01);
		$price02Txt = number_format($price02);
		$price03Txt = number_format($price03);




		//제품이미지 가져오기
		$sql03 = "select * from ks_product where uid='$pid'";
		$result03 = mysql_query($sql03);
		$row03 = mysql_fetch_array($result03);
		$upfile01 = $row03["upfile01"];	//이미지

		if($upfile01){
			$imgFile = $path.'thumb_'.$upfile01;
			if(!is_file($imgFile))	$imgFile = $path.$upfile01;
			$resize = Util::AutoImgSize($imgFile,229,287);
			$imgTag = "<img src='$imgFile' $resize>";
		}
	if($i==0)	$pt60='';
	else		$pt60='padding-top:60px';
?>

	<tr>
		<td class='order_ttl' style='<?=$pt60?>'>주문내역</td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="1" bgcolor="484848" style="padding:1px 0px 0px 0px;"></td>
	</tr>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th width="17%">이미지</th>
					<td width="83%" colspan='3'><?=$imgTag?></td>
				</tr>
				<tr> 
					<th>상품명</th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><span class='ks_red'><b><?=$ptitle?></b></span></td>
							<?
								if($status == '결제완료' || $status == '입금확인' || $status == '발송준비' || $status == '발송완료'){
									$act = '/sub06/sub01.php';

									if($UserOS == 'mobile'){
							?>
								<td style='padding:0 0 0 40px;'><a href="javascript:order_review('<?=$pid?>');" class='small cbtn blue'>이용후기등록</a></td>
								<?
									}else{
								?>
								<td style='padding:0 0 0 40px;'><a href="<?=$act?>?type=view&uid=<?=$pid?>&pboardType=write#tab02" class='small cbtn blue'>이용후기등록</a></td>
							<?
									}
								}
							?>
							</tr>						
						</table>

					</td>
				</tr>

				<tr> 
					<th width="17%">수량</th>
					<td width="33%"><?=$peaTxt?> 개</td>
					<th>금액</th>
					<td><?=$price01Txt?> 원</td>
				</tr>
				<tr> 
					<th>구매금액</th>
					<td><span class='ks_blue'><b><?=$price03Txt?> 원</b></span></td>
					<th></th>
					<td></td>
				</tr>
			</table>
		</td>
	</tr>

<?
	}
?>

<!-- /주문상품정보 -->





<!-- 결제정보 -->
<?
	$no++;
?>

	<tr>
		<td class='order_ttl' style='padding-top:60px;'>결제정보</td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="1" bgcolor="484848" style="padding:1px 0px 0px 0px;"></td>
	</tr>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th width="17%">결제수단</th>
					<td width="33%"><?=$payTxt?></td>
					<th width="17%">주문상태</th>
					<td width="33%"><font color='#de712e'><b><?=$status?></b></font></td>
				</tr>
			<?
				if($paymode=='무통장입금'){
					//가상계좌정보
					$vsql = "select * from ks_order_account where LGD_BUYERID='$userid' and LGD_OID='$reg_date' order by uid desc limit 1";
					$vresult = mysql_query($vsql);
					$vrow = mysql_fetch_array($vresult);

					$LGD_FINANCENAME = $vrow['LGD_FINANCENAME'];
					$LGD_ACCOUNTNUM = $vrow['LGD_ACCOUNTNUM'];
					$LGD_PAYER = $vrow['LGD_PAYER'];

					if($LGD_FINANCENAME || $LGD_ACCOUNTNUM || $LGD_PAYER){

			?>
				<tr> 
					<th>은행정보</th>
					<td>[<?=$LGD_FINANCENAME?>] - <?=$LGD_ACCOUNTNUM?></td>
					<th>입금자명</th>
					<td><?=$LGD_PAYER?></td>
				</tr>
			<?
					}
				}
			?>

				<tr> 
					<th>상품금액</th>
					<td><?=$result_priceTxt?> 원</td>
					<th>배송비</th>
					<td><?=$ship_priceTxt?> 원 (<?=$ship_modeTxt?>)</td>
				</tr>
			<?
				if($saleTxt){
			?>
				<tr> 
					<th><?=$saleTxt?></th>
					<td colspan='3'><font color='#52809a'><b>-<?=number_format($sale_price)?> 원</b></font></td>
				</tr>
			<?
				}
			?>

			<?
				if($point){
			?>
				<tr> 
					<th>적립금사용</th>
					<td colspan='3'><font color='#52809a'><b><?=number_format($point)?> 원</b></font></td>
				</tr>
			<?
				}
			?>

			<?
				if($coupon && $coupon_price){
			?>
				<tr> 
					<th>쿠폰사용</th>
					<td colspan='3'><font color='#52809a'><b><?=$coupon?></b></font></td>
				</tr>
			<?
				}
			?>

				<tr> 
					<th>결제금액</th>
					<td><font color='#de712e'><b><?=$amtTxt?> 원</b></font></td>
					<th>송장번호</th>
					<td>
					<?
						if($ship_num){
					?>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td style='color:#52809a;font-size:13pt;'><b><?=$ship_num?></b></td>
								<!-- <td style='padding:0px 0px 0px 40px;'><a href="https://www.doortodoor.co.kr/parcel/doortodoor.do?fsp_action=PARC_ACT_002&fsp_cmd=retrieveInvNoACT&invc_no=<?=$ship_num?>" target="_blank"><img src='/images/cjLogo.jpg'></a></td> -->
							</tr>
						</table>
					<?
						}
					?>
					</td>
				</tr>
			</table>
		</td>
	</tr>

<!-- /결제정보 -->





<!-- 주문자정보 -->
<?
	$no++;
?>

	<tr>
		<td class='order_ttl' style='padding-top:60px;'>주문자정보</td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="1" bgcolor="484848" style="padding:1px 0px 0px 0px;"></td>
	</tr>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th width="17%">주문번호</th>
					<td width="83%"><?=$reg_date?></td>
				</tr>
				<tr> 
					<th>성명(아이디)</th>
					<td><?=$oname?> (<?=$userid?>)</td>
				</tr>
				<tr> 
					<th>주소</th>
					<td><?=$ozipcode?> <?if($ozip1 && $ozip2){echo "[".$ozip1."-".$ozip2."]";}?><br><?=$oaddr1?><br><?=$oaddr2?></td>
				</tr>
				<tr> 
					<th>유선전화</th>
					<td><?=$otel1?>-<?=$otel2?>-<?=$otel3?></td>
				</tr>
				<tr> 
					<th>휴대전화</th>
					<td><?=$ohp1?>-<?=$ohp2?>-<?=$ohp3?></td>
				</tr>
				<tr> 
					<th>이메일</th>
					<td><?=$oemail?></td>
				</tr>
				<tr> 
					<th>주문일시</th>
					<td><?=$reg_date_txt?></td>
				</tr>
			</table>
		</td>
	</tr>

<!-- /주문자정보 -->





<!-- 배송지정보 -->
<?
	$no++;
?>

	<tr>
		<td class='order_ttl' style='padding-top:60px;'>배송지정보</td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="1" bgcolor="484848" style="padding:1px 0px 0px 0px;"></td>
	</tr>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th width="17%">성명</th>
					<td width="83%"><?=$pname?></td>
				</tr>
				<tr> 
					<th>주소</th>
					<td><?=$pzipcode?> <?if($pzip1 && $pzip2){echo "[".$pzip1."-".$pzip2."]";}?><br><?=$paddr1?><br><?=$paddr2?></td>
				</tr>
				<tr> 
					<th>유선전화</th>
					<td><?=$ptel1?>-<?=$ptel2?>-<?=$ptel3?></td>
				</tr>
				<tr> 
					<th>휴대전화</th>
					<td><?=$php1?>-<?=$php2?>-<?=$php3?></td>
				</tr>
				<tr> 
					<th>배송메세지</th>
					<td height='60'><?=$ment?></td>
				</tr>
			</table>
		</td>
	</tr>

<!-- /배송지정보 -->




	
	<tr>
		<td style='padding:20px 0 50px 0;' align='center'><a href="javascript:reg_list();" class='big cbtn black'>목록보기</a></td>
	</tr>
</table>


</form>

