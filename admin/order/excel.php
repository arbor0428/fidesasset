<? 

	$xls_name = '주문내역('.date('Ymd').')';
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=$xls_name.xls"); 


	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';

	$path = "http://hwnvhanbok.co.kr/upfile/";

?>


<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>

<!--
<table border='1' cellpadding='5' cellspacing='0' bordercolor='#cccccc' BorderColorlight='#cccccc' bordercolordark='ffffff' align='center'>
-->


<?
for($c=0; $c<count($chk); $c++){
	$uid = $chk[$c];
?>


<table width="980" border="0" cellspacing="0" cellpadding="0">
<?
	if($c > 0){
?>
	<tr>
		<td height='200'>&nbsp;</td>
	</tr>
<?
	}
?>

<!-- 주문상품정보 -->

<?
	$sql01 = "select * from ks_order where uid='$uid'";
	$result01 = mysql_query($sql01);
	$row01 = mysql_fetch_array($result01);

	$userid = $row01["userid"];
	$oname = $row01["oname"];
	$ozip1 = $row01["ozip1"];
	$ozip2 = $row01["ozip2"];
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
	$amt = $row01["amt"];
	$coupon = $row01["coupon"];
	$coupon_price = $row01["coupon_price"];
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
		$mdata01 = $row02['mdata01'];
		$mdata02 = $row02['mdata02'];
		$mdata03 = $row02['mdata03'];
		$mdata04 = $row02['mdata04'];
		$mdata05 = $row02['mdata05'];

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
		<td style='padding:10px 0px 0px 0px;'><b><?=$no?>. <?=$pcade01?></b></td>
	</tr>
	<tr>
		<td>
			<table width="980" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
				<tr height='30'> 
					<td width="170" style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">이미지</td>
					<td width="810" style="font-size: 12px; padding-left:10px;mso-number-format:'\@'" colspan='3'><?=$imgTag?></td>
				</tr>

				<tr height='30'> 
					<td width="170" style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">상품명</td>
					<td width="810" style="font-size: 12px; padding-left:10px;mso-number-format:'\@'" colspan='3'><span style="color:#de712e;"><b><?=$ptitle?></b></span></td>
				</tr>

				<tr height='30'> 
					<td width="170" style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">행사일</td>
					<td width="320" style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$pdateTxt?></td>
					<td width="170" style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">수량</td>
					<td width="320" style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$peaTxt?> 개</td>
				</tr>

		<?
			if($pcade01 == '신부한복' || $pcade01 == '혼주한복'){
		?>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">여성사이즈</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata01?></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">배자</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata02?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">신장</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata03?></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">가슴둘레</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata04?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">총장</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata05?></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">슬리퍼</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata06?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">높이</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata07?></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">버선</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata08?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">특이사항</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'" colspan='3' style='padding:10px;' height='60'><?=$gdata09?></td>
				</tr>




		<?
			}elseif($pcade01 == '신랑한복'){
		?>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">가슴둘레</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$mdata01?></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">허리사이즈</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$mdata02?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">신장</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$mdata03?></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">신발</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$mdata04?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">특이사항</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'" colspan='3' style='padding:10px;' height='60'><?=$mdata05?></td>
				</tr>


		<?
			}elseif($pcade01 == '신랑신부세트'){
		?>
				<tr>
					<td colspan='4' style='padding:20px 0px 0px 10px;'><span style="color:#52809a;"><b>[신부한복옵션]</b></span></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">여성사이즈</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata01?></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">배자</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata02?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">신장</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata03?></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">가슴둘레</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata04?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">총장</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata05?></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">슬리퍼</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata06?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">높이</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata07?></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">버선</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$gdata08?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">특이사항</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'" colspan='3' style='padding:10px;' height='60'><?=$gdata09?></td>
				</tr>

				<tr>
					<td colspan='4' style='padding:20px 0px 0px 10px;'><span style="color:#52809a;"><b>[신랑한복옵션]</b></span></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">가슴둘레</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$mdata01?></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">허리사이즈</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$mdata02?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">신장</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$mdata03?></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">신발</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$mdata04?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">특이사항</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'" colspan='3' style='padding:10px;' height='60'><?=$mdata05?></td>
				</tr>



		<?
			}
		?>

				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">대여료</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$price01Txt?> 원</td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">옵션가</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$price02Txt?> 원</td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">구매금액</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><span style="color:#52809a;"><b><?=$price03Txt?> 원</b></span></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;"></td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"></td>
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
		<td style='padding-top:20px;'><b><?=$no?>. 결제정보</b></td>
	</tr>
	<tr>
		<td>
			<table width="980" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
				<tr height='30'> 
					<td width="170" style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">결제수단</td>
					<td width="320" style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$paymode?> <?if($paymode == '주문완료'){echo '&nbsp;&nbsp;&nbsp;(입금자:'.$account.')';}?></td>
					<td width="170" style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">주문상태</td>
					<td width="320" style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$status?></td>
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
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;" style='background-color:#fff3e2;'>은행정보</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'" style='background-color:#fff3e2;'>[<?=$LGD_FINANCENAME?>] - <?=$LGD_ACCOUNTNUM?></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;" style='background-color:#fff3e2;'>입금자명</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'" style='background-color:#fff3e2;'><?=$LGD_PAYER?></td>
				</tr>
			<?
					}

					if($LGD_PAYDATE_IN){
						$LGD_PAYDATE_IN_TXT = substr($LGD_PAYDATE_IN,0,4).'-'.substr($LGD_PAYDATE_IN,4,2).'-'.substr($LGD_PAYDATE_IN,6,2).' '.substr($LGD_PAYDATE_IN,8,2).':'.substr($LGD_PAYDATE_IN,10,2).':'.substr($LGD_PAYDATE_IN,12,2);
			?>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;" style='background-color:#fff3e2;'>입금일시</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'" style='background-color:#fff3e2;'><?=$LGD_PAYDATE_IN_TXT?></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;" style='background-color:#fff3e2;'>입금액</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'" style='background-color:#fff3e2;'><?=number_format($LGD_AMOUNT)?> 원</td>
				</tr>

			<?
					}
				}
			?>

				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">상품대여료</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$result_priceTxt?> 원</td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">배송비</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$ship_priceTxt?> 원 (<?=$ship_modeTxt?>)</td>
				</tr>
			<?
				if($coupon && $coupon_price){
			?>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">쿠폰사용</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><font color='#52809a'><b>- <?=number_format($coupon_price)?> 원</b></font></td>
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">쿠폰번호</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$coupon?></td>
				</tr>
			<?
				}
			?>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">결제금액</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'" colspan='3'><font color='#de712e'><b><?=$amtTxt?> 원</b></font></td>
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
			<table width="980" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">주문번호</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$reg_date?></td>
				</tr>
				<tr height='30'> 
					<td width="170" style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">성명(아이디)</td>
					<td width="810" style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$oname?> (<?=$userid?>)</td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">주소</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'">[<?=$ozip1?>-<?=$ozip2?>]<br><?=$oaddr1?><br><?=$oaddr2?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">유선전화</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$otel1?>-<?=$otel2?>-<?=$otel3?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">휴대전화</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$ohp1?>-<?=$ohp2?>-<?=$ohp3?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">이메일</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$oemail?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">주문일시</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$reg_date_txt?></td>
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
			<table width="980" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
				<tr height='30'> 
					<td width="170" style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">성명</td>
					<td width="810" style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$pname?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">주소</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'">[<?=$pzip1?>-<?=$pzip2?>]<br><?=$paddr1?><br><?=$paddr2?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">유선전화</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$ptel1?>-<?=$ptel2?>-<?=$ptel3?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">휴대전화</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$php1?>-<?=$php2?>-<?=$php3?></td>
				</tr>
				<tr height='30'> 
					<td style="font-size: 12px; background-color:f9f9f9;padding-left:15px;">배송메세지</td>
					<td style="font-size: 12px; padding-left:10px;mso-number-format:'\@'"><?=$ment?></td>
				</tr>
			</table>
		</td>
	</tr>

<!-- /배송지정보 -->




</table>




<?
}
?>