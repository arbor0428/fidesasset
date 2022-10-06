<?	
	//제이쿼리 달력
	$sRange = '1';
	$eRange = '1';

	include '/home/websp/www/module/Calendar.php';

	if($type=='edit' && $uid){
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
		$useros = $row01["useros"];
		$reg_date = $row01["reg_date"];
		$reg_date_txt = date("Y-m-d H:i:s",$reg_date);
		$cDate = $row01["cDate"];
		$cTime = $row01["cTime"];

		$virno = $row01['virno'];	//가상계좌번호
		$virbank = $row01['virbank'];	 //가상계좌은행

		$result_priceTxt = number_format($result_price);
		$ship_priceTxt = number_format($ship_price);
		$amtTxt = number_format($amt);

		if($ship_mode == '착불')	$ship_modeTxt = "<font color='#ff0000'><b>착불</b></font>";
		else								$ship_modeTxt = $ship_mode;
	}
?>

<script language="javascript">
function check_form(){
	form = document.FRM;

	set_status = $("#set_status option:selected").val();
	if(set_status == '주문취소'){
		if(isFrmEmpty(form.cDate,"취소일자를 입력해 주십시오"))	return;
	}

	form.action = 'proc.php';
	form.submit();
}

function check_del(){
	if(confirm('주문내역을 삭제하시겠습니까?\n삭제후에는 복구가 불가능합니다.')){
		form = document.FRM;
		form.type.value = 'del';
		form.action = 'proc.php';
		form.submit();
	}else{
		return;
	}
}

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = 'up_index.php';
	form.submit();
}

function cDateBox(){
	set_status = $("#set_status option:selected").val();
	if(set_status == '주문취소'){
		$('#fpicker').val("<?=date('Y-m-d')?>");
		$('#fpicker').show();
	}else{
		$('#fpicker').val('');
		$('#fpicker').hide();
	}
}
</script>


<form name='FRM' action="proc.php" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='f_reg' value='<?=$f_reg?>'>
<input type='hidden' name='f_oname' value='<?=$f_oname?>'>
<input type='hidden' name='f_userid' value='<?=$f_userid?>'>
<input type='hidden' name='f_paymode' value='<?=$f_paymode?>'>
<input type='hidden' name='f_status' value='<?=$f_status?>'>
<input type='hidden' name='f_sy' value='<?=$f_sy?>'>
<input type='hidden' name='f_sm' value='<?=$f_sm?>'>
<input type='hidden' name='f_sd' value='<?=$f_sd?>'>
<input type='hidden' name='f_ey' value='<?=$f_ey?>'>
<input type='hidden' name='f_em' value='<?=$f_em?>'>
<input type='hidden' name='f_ed' value='<?=$f_ed?>'>
<input type='hidden' name='f_manager' value='<?=$f_manager?>'>

<input type='hidden' name='userid' value='<?=$userid?>'>
<input type='hidden' name='call_no' value='<?=$ohp1?><?=$ohp2?><?=$ohp3?>'><!-- 송장번호 안내문자 수신번호 -->


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

?>

	<tr>
		<td style='padding:60px 0px 0px 0px;'><b>1. 주문내역</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class='gTable2'>
				<tr height='40'> 
					<th width="17%" class='tab_tit'>이미지</td>
					<td width="83%" class='tab' colspan='3'><?=$imgTag?></td>
				</tr>

				<tr height='40'> 
					<th width="17%" class='tab_tit'>상품명</td>
					<td width="83%" class='tab' colspan='3'><span class='ks_red'><b><?=$ptitle?></b></span></td>
				</tr>

				<tr height='40'> 
					<th width="17%" class='tab_tit'>수량</td>
					<td width="33%" class='tab'><?=$peaTxt?> 개</td>
					<th class='tab_tit'>판매가격</td>
					<td class='tab'><?=$price01Txt?> 원</td>
				</tr>

				<tr height='40'> 
					<th class='tab_tit'>구매금액</td>
					<td class='tab'><span class='ks_blue'><b><?=$price03Txt?> 원</b></span></td>
					<th class='tab_tit'></td>
					<td class='tab'></td>
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
		<td style='padding-top:100px;'><b><?=$no?>. 결제정보</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class='gTable2'>
				<tr height='40'> 
					<th width="17%" class='tab_tit'>결제수단</td>
					<td width="33%" class='tab'><?if($useros == 'mobile'){echo "<font color='0000ff'>모바일</font>&nbsp;&nbsp;&nbsp;";}?><?=$paymode?> <?if($paymode == '주문완료'){echo '&nbsp;&nbsp;&nbsp;(입금자:'.$account.')';}?></td>
					<th width="17%" class='tab_tit'>주문상태</td>
					<td width="33%" class='tab'>
						<select name='set_status' id='set_status' style='height:30px;font-size:13px;' onchange='cDateBox();'>
							<option value='접수' <?if($status=='접수'){echo 'selected';}?>>접수</option>
							<option value='입금대기' <?if($status=='입금대기'){echo 'selected';}?>>입금대기</option>
							<option value='결제완료' <?if($status=='결제완료'){echo 'selected';}?>>결제완료</option>
							<option value='입금확인' <?if($status=='입금확인'){echo 'selected';}?>>입금확인</option>
							<option value='발송준비' <?if($status=='발송준비'){echo 'selected';}?>>발송준비</option>
							<option value='발송완료' <?if($status=='발송완료'){echo 'selected';}?>>발송완료</option>
							<option value='주문취소' <?if($status=='주문취소'){echo 'selected';}?>>주문취소</option>
						</select>
						<input type='text' name='cDate' value='<?=$cDate?>' class='fpicker' id='fpicker' style='width:120px;height:30px;<?if($status!='주문취소'){echo 'display:none;';}?>' placeholder='취소일자'>
					</td>
				</tr>
			<?
				if($paymode=='무통장입금'){
					//가상계좌정보
					$vsql = "select * from ks_order_account where LGD_BUYERID='$userid' and LGD_OID='$reg_date' order by uid desc limit 1";
					$vresult = mysql_query($vsql);
					$vrow = mysql_fetch_array($vresult);

					$LGD_FINANCENAME = $vrow['LGD_FINANCENAME'];		//가상계좌은행
					$LGD_ACCOUNTNUM = $vrow['LGD_ACCOUNTNUM'];		//가상계좌번호
					$LGD_PAYER = $vrow['LGD_PAYER'];							//입금자명
					$LGD_PAYDATE_IN = $vrow['LGD_PAYDATE_IN'];				//입금일시
					$LGD_AMOUNT = $vrow['LGD_AMOUNT'];						//입금액

					if($LGD_FINANCENAME || $LGD_ACCOUNTNUM || $LGD_PAYER){


			?>
				<tr height='40'> 
					<th class='tab_tit' style='background-color:#fff3e2;'>은행정보</td>
					<td class='tab' style='background-color:#fff3e2;'>[<?=$LGD_FINANCENAME?>] - <?=$LGD_ACCOUNTNUM?></td>
					<th class='tab_tit' style='background-color:#fff3e2;'>입금자명</td>
					<td class='tab' style='background-color:#fff3e2;'><?=$LGD_PAYER?></td>
				</tr>
			<?
					}

					if($LGD_PAYDATE_IN){
						$LGD_PAYDATE_IN_TXT = substr($LGD_PAYDATE_IN,0,4).'-'.substr($LGD_PAYDATE_IN,4,2).'-'.substr($LGD_PAYDATE_IN,6,2).' '.substr($LGD_PAYDATE_IN,8,2).':'.substr($LGD_PAYDATE_IN,10,2).':'.substr($LGD_PAYDATE_IN,12,2);
			?>
				<tr height='40'> 
					<th class='tab_tit' style='background-color:#fff3e2;'>입금일시</td>
					<td class='tab' style='background-color:#fff3e2;'><?=$LGD_PAYDATE_IN_TXT?></td>
					<th class='tab_tit' style='background-color:#fff3e2;'>입금액</td>
					<td class='tab' style='background-color:#fff3e2;'><?=number_format($LGD_AMOUNT)?> 원</td>
				</tr>

			<?
					}
				}
			?>

				<tr height='40'> 
					<th class='tab_tit'>판매가격</td>
					<td class='tab'><?=$result_priceTxt?> 원</td>
					<th class='tab_tit'>배송비</td>
					<td class='tab'><?=$ship_priceTxt?> 원 (<?=$ship_modeTxt?>)</td>
				</tr>

			<?
				if($saleTxt){
			?>
				<tr height='40'> 
					<th class='tab_tit'><?=$saleTxt?></td>
					<td class='tab' colspan='3'><font color='#52809a'><b>-<?=number_format($sale_price)?> 원</b></font></td>
				</tr>
			<?
				}
			?>

			<?
				if($point){
			?>
				<tr height='40'> 
					<th class='tab_tit'>적립금사용</td>
					<td class='tab' colspan='3'><font color='#52809a'><b><?=number_format($point)?> 원</b></font></td>
				</tr>
			<?
				}
			?>
			<?
				if($coupon && $coupon_price){
			?>
				<tr height='40'> 
					<th class='tab_tit'>쿠폰번호</td>
					<td class='tab'><?=$coupon?></td>
					<th class='tab_tit'>쿠폰사용</td>
					<td class='tab'><font color='#52809a'><b><?=number_format($coupon_price)?> 원</b></font></td>
				</tr>
			<?
				}
			?>
				<tr height='40'> 
					<th class='tab_tit'>결제금액</td>
					<td class='tab'><font color='#de712e'><b><?=$amtTxt?> 원</b></font></td>
					<th class='tab_tit'>송장번호</td>
					<td class='tab'>
						<input type='text' name='ship_num' value='<?=$ship_num?>' style='width:100%;'></td>
								<!-- <td style='padding:0px 0px 0px 10px;'><input type='checkbox' name='sms' value='1'>문자발송</td> -->
						
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
		<td style='padding-top:20px;'><b><?=$no?>. 주문자정보</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class='gTable2'>
				<tr height='40'> 
					<th class='tab_tit'>주문번호</td>
					<td class='tab'><?=$reg_date?></td>
				</tr>
				<tr height='40'> 
					<th width="17%" class='tab_tit'>성명(아이디)</td>
					<td width="83%" class='tab'><?=$oname?> (<?=$userid?>)</td>
				</tr>
				<tr height='40'> 
					<th class='tab_tit'>주소</td>
					<td class='tab'><?=$ozipcode?> <?if($ozip1 && $ozip2){echo "[".$ozip1."-".$ozip2."]";}?><br><?=$oaddr1?><br><?=$oaddr2?></td>
				</tr>
				<tr height='40'> 
					<th class='tab_tit'>유선전화</td>
					<td class='tab'><?=$otel1?>-<?=$otel2?>-<?=$otel3?></td>
				</tr>
				<tr height='40'> 
					<th class='tab_tit'>휴대전화</td>
					<td class='tab'><?=$ohp1?>-<?=$ohp2?>-<?=$ohp3?></td>
				</tr>
				<tr height='40'> 
					<th class='tab_tit'>이메일</td>
					<td class='tab'><?=$oemail?></td>
				</tr>
				<tr height='40'> 
					<th class='tab_tit'>주문일시</td>
					<td class='tab'><?=$reg_date_txt?></td>
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
		<td style='padding-top:20px;'><b><?=$no?>. 배송지정보</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class='gTable2'>
				<tr height='40'> 
					<th width="17%" class='tab_tit'>성명</td>
					<td width="83%" class='tab'><?=$pname?></td>
				</tr>
				<tr height='40'> 
					<th class='tab_tit'>주소</td>
					<td class='tab'><?=$pzipcode?> <?if($pzip1 && $pzip2){echo "[".$pzip1."-".$pzip2."]";}?><br><?=$paddr1?><br><?=$paddr2?></td>
				</tr>
				<tr height='40'> 
					<th class='tab_tit'>유선전화</td>
					<td class='tab'><?=$ptel1?>-<?=$ptel2?>-<?=$ptel3?></td>
				</tr>
				<tr height='40'> 
					<th class='tab_tit'>휴대전화</td>
					<td class='tab'><?=$php1?>-<?=$php2?>-<?=$php3?></td>
				</tr>
				<tr height='40'> 
					<th class='tab_tit'>배송메세지</td>
					<td class='tab'><?=$ment?></td>
				</tr>
			</table>
		</td>
	</tr>

<!-- /배송지정보 -->




	
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<!--<td><a href="javascript:openCenterWin('print.php?uid=<?=$uid?>','eprint','780','900','','1');"><img src="../../images/common/print.gif" border='0'></a></td>-->
					<td align='right' height='50'>
				<?if($GBL_MTYPE=='A'){
					if($type == 'edit'){
				?>
						<a href="javascript:check_form();"><img src="../../images/common/modify2.gif" border='0'></a>&nbsp;
						<a href="javascript:check_del();"><img src="../../images/common/delete1.gif" border='0'></a>&nbsp;
				<?
					}else{
				?>
						<a href="javascript:check_form();"><img src="../../images/common/register.gif" border='0'></a>&nbsp;
				<?
					}
					}
				?>
						<a href="javascript:reg_list();"><img src="../../images/common/cancel.gif" border='0'></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>


</form>