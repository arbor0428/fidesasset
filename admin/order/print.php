<?	
	include '../header.php';

	$path = '../../upfile/';

	//이미지크기
	$size01 = 400;
	$size02 = 500;

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
	}
?>





<script language="javascript" type="text/javascript">
function printPage(){
	if(window.print){
		window.print();
	}
}
</script>

<body onload='printPage();'>



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
		<td style='padding:20px 0px 0px 0px;'><b><?=$no?>. <?=$pcade01?></b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
				<tr> 
					<td width="17%" class='tab_tit'>상품명</td>
					<td width="83%" class='tab' colspan='3'><span class='ks_red'><b><?=$ptitle?></b></span></td>
				</tr>

				<tr> 
					<td width="17%" class='tab_tit'>행사일</td>
					<td width="33%" class='tab'><?=$pdateTxt?></td>
					<td width="17%" class='tab_tit'>수량</td>
					<td width="33%" class='tab'><?=$peaTxt?> 개</td>
				</tr>

		<?
			if($pcade01 == '여성한복'){
		?>
				<tr> 
					<td class='tab_tit'>여성사이즈</td>
					<td class='tab'><?=$gdata01?></td>
					<td class='tab_tit'>속치마</td>
					<td class='tab'><?=$gdata02?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>신장</td>
					<td class='tab'><?=$gdata03?></td>
					<td class='tab_tit'>가슴둘레</td>
					<td class='tab'><?=$gdata04?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>총장</td>
					<td class='tab'><?=$gdata05?></td>
					<td class='tab_tit'>슬리퍼</td>
					<td class='tab'><?=$gdata06?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>높이</td>
					<td class='tab'><?=$gdata07?></td>
					<td class='tab_tit'>버선</td>
					<td class='tab'><?=$gdata08?></td>
				</tr>
			<?
				if(strpos($pcade01,'촬영한복',0)){
			?>
				<tr> 
					<td class='tab_tit'>아얌</td>
					<td class='tab'><?=$etc01?></td>
					<td class='tab_tit'>비녀</td>
					<td class='tab'><?=$etc02?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>뱃씨댕기</td>
					<td class='tab'><?=$etc03?></td>
					<td class='tab_tit'>노리개</td>
					<td class='tab'><?=$etc04?></td>
				</tr>
			<?
				}
			?>
				<tr> 
					<td class='tab_tit'>특이사항</td>
					<td class='tab' colspan='3' style='padding:10px;' height='60'><?=$gdata09?></td>
				</tr>




		<?
			}elseif($pcade01 == '남성한복'){
		?>
				<tr> 
					<td class='tab_tit'>가슴둘레</td>
					<td class='tab'><?=$mdata01?></td>
					<td class='tab_tit'>허리사이즈</td>
					<td class='tab'><?=$mdata02?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>신장</td>
					<td class='tab'><?=$mdata03?></td>
					<td class='tab_tit'>신발</td>
					<td class='tab'><?=$mdata04?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>특이사항</td>
					<td class='tab' colspan='3' style='padding:10px;' height='60'><?=$mdata05?></td>
				</tr>


		<?
			}elseif($pcade01 == '커플한복'){
		?>
				<tr>
					<td colspan='4' style='padding:20px 0px 0px 10px;'><span class='ks_blue'><b>[여성한복옵션]</b></span></td>
				</tr>
				<tr> 
					<td class='tab_tit'>여성사이즈</td>
					<td class='tab'><?=$gdata01?></td>
					<td class='tab_tit'>속치마</td>
					<td class='tab'><?=$gdata02?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>신장</td>
					<td class='tab'><?=$gdata03?></td>
					<td class='tab_tit'>가슴둘레</td>
					<td class='tab'><?=$gdata04?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>총장</td>
					<td class='tab'><?=$gdata05?></td>
					<td class='tab_tit'>슬리퍼</td>
					<td class='tab'><?=$gdata06?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>높이</td>
					<td class='tab'><?=$gdata07?></td>
					<td class='tab_tit'>버선</td>
					<td class='tab'><?=$gdata08?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>특이사항</td>
					<td class='tab' colspan='3' style='padding:10px;' height='60'><?=$gdata09?></td>
				</tr>

				<tr>
					<td colspan='4' style='padding:20px 0px 0px 10px;'><span class='ks_blue'><b>[남성한복옵션]</b></span></td>
				</tr>
				<tr> 
					<td class='tab_tit'>가슴둘레</td>
					<td class='tab'><?=$mdata01?></td>
					<td class='tab_tit'>허리사이즈</td>
					<td class='tab'><?=$mdata02?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>신장</td>
					<td class='tab'><?=$mdata03?></td>
					<td class='tab_tit'>신발</td>
					<td class='tab'><?=$mdata04?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>특이사항</td>
					<td class='tab' colspan='3' style='padding:10px;' height='60'><?=$mdata05?></td>
				</tr>




		<?
			}elseif($pcade01 == '남아한복' || $pcade01 == '남아한복(판매)'){
		?>
				<tr> 
					<td class='tab_tit'>키,몸무게</td>
					<td class='tab'><?=$bdata01?></td>
					<td class='tab_tit'>사이즈</td>
					<td class='tab'><?=$bdata02?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>신발</td>
					<td class='tab'><?=$bdata03?></td>
					<td class='tab_tit'>모자</td>
					<td class='tab'><?=$bdata04?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>돌띠</td>
					<td class='tab'><?=$bdata05?></td>
					<td class='tab_tit'>버선</td>
					<td class='tab'><?=$bdata06?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>특이사항</td>
					<td class='tab' colspan='3' style='padding:10px;' height='60'><?=$bdata07?></td>
				</tr>




		<?
			}elseif($pcade01 == '여아한복' || $pcade01 == '여아한복(판매)'){
		?>
				<tr> 
					<td class='tab_tit'>키,몸무게</td>
					<td class='tab'><?=$cdata01?></td>
					<td class='tab_tit'>사이즈</td>
					<td class='tab'><?=$cdata02?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>신발</td>
					<td class='tab'><?=$cdata03?></td>
					<td class='tab_tit'>모자</td>
					<td class='tab'><?=$cdata04?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>돌띠</td>
					<td class='tab'><?=$cdata05?></td>
					<td class='tab_tit'>버선</td>
					<td class='tab'><?=$cdata06?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>특이사항</td>
					<td class='tab' colspan='3' style='padding:10px;' height='60'><?=$cdata07?></td>
				</tr>




		<?
			}elseif($pcade01 == '털배자(조끼)'){
		?>
				<tr> 
					<td class='tab_tit'>여성사이즈</td>
					<td class='tab'><?=$gdata01?></td>
					<td class='tab_tit'>가슴둘레</td>
					<td class='tab'><?=$gdata04?></td>
				</tr>

		<?
			}
		?>

				<tr> 
					<td class='tab_tit'>대여료</td>
					<td class='tab'><?=$price01Txt?> 원</td>
					<td class='tab_tit'>옵션가</td>
					<td class='tab'><?=$price02Txt?> 원</td>
				</tr>
				<tr> 
					<td class='tab_tit'>구매금액</td>
					<td class='tab'><span class='ks_blue'><b><?=$price03Txt?> 원</b></span></td>
					<td class='tab_tit'></td>
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
		<td style='padding-top:20px;'><b><?=$no?>. 결제정보</b></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
				<tr> 
					<td width="17%" class='tab_tit'>결제수단</td>
					<td width="33%" class='tab'><?=$paymode?> <?if($paymode == '주문완료'){echo '&nbsp;&nbsp;&nbsp;(입금자:'.$account.')';}?></td>
					<td width="17%" class='tab_tit'>주문상태</td>
					<td width="33%" class='tab'><?=$status?></td>
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
				<tr> 
					<td class='tab_tit' style='background-color:#fff3e2;'>은행정보</td>
					<td class='tab' style='background-color:#fff3e2;'>[<?=$LGD_FINANCENAME?>] - <?=$LGD_ACCOUNTNUM?></td>
					<td class='tab_tit' style='background-color:#fff3e2;'>입금자명</td>
					<td class='tab' style='background-color:#fff3e2;'><?=$LGD_PAYER?></td>
				</tr>
			<?
					}

					if($LGD_PAYDATE_IN){
						$LGD_PAYDATE_IN_TXT = substr($LGD_PAYDATE_IN,0,4).'-'.substr($LGD_PAYDATE_IN,4,2).'-'.substr($LGD_PAYDATE_IN,6,2).' '.substr($LGD_PAYDATE_IN,8,2).':'.substr($LGD_PAYDATE_IN,10,2).':'.substr($LGD_PAYDATE_IN,12,2);
			?>
				<tr> 
					<td class='tab_tit' style='background-color:#fff3e2;'>입금일시</td>
					<td class='tab' style='background-color:#fff3e2;'><?=$LGD_PAYDATE_IN_TXT?></td>
					<td class='tab_tit' style='background-color:#fff3e2;'>입금액</td>
					<td class='tab' style='background-color:#fff3e2;'><?=number_format($LGD_AMOUNT)?> 원</td>
				</tr>

			<?
					}
				}
			?>

				<tr> 
					<td class='tab_tit'>상품대여료</td>
					<td class='tab'><?=$result_priceTxt?> 원</td>
					<td class='tab_tit'>배송비</td>
					<td class='tab'><?=$ship_priceTxt?> 원 (<?=$ship_modeTxt?>)</td>
				</tr>

			<?
				if($saleTxt){
			?>
				<tr> 
					<td class='tab_tit'><?=$saleTxt?></td>
					<td class='tab' colspan='3'><font color='#52809a'><b>-<?=number_format($sale_price)?> 원</b></font></td>
				</tr>
			<?
				}
			?>

			<?
				if($point){
			?>
				<tr> 
					<td class='tab_tit'>적립금사용</td>
					<td class='tab' colspan='3'><font color='#52809a'><b><?=number_format($point)?> 원</b></font></td>
				</tr>
			<?
				}
			?>
			<?
				if($coupon && $coupon_price){
			?>
				<tr> 
					<td class='tab_tit'>쿠폰번호</td>
					<td class='tab'><?=$coupon?></td>
					<td class='tab_tit'>쿠폰사용</td>
					<td class='tab'><font color='#52809a'><b><?=number_format($coupon_price)?> 원</b></font></td>
				</tr>
			<?
				}
			?>
				<tr> 
					<td class='tab_tit'>결제금액</td>
					<td class='tab'><font color='#de712e'><b><?=$amtTxt?> 원</b></font></td>
					<td class='tab_tit'>송장번호</td>
					<td class='tab'><?=$ship_num?></td>
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
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
				<tr> 
					<td width="17%" class='tab_tit'>주문번호</td>
					<td width="33%" class='tab'><?=$reg_date?></td>
					<td width="17%" class='tab_tit'>성명(아이디)</td>
					<td width="33%" class='tab'><?=$oname?> (<?=$userid?>)</td>
				</tr>
				<tr> 
					<td class='tab_tit'>주소</td>
					<td class='tab' colspan='3'><?=$ozipcode?> <?if($ozip1 && $ozip2){echo "[".$ozip1."-".$ozip2."]";}?><br><?=$oaddr1?><br><?=$oaddr2?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>유선전화</td>
					<td class='tab'><?=$otel1?>-<?=$otel2?>-<?=$otel3?></td>
					<td class='tab_tit'>휴대전화</td>
					<td class='tab'><?=$ohp1?>-<?=$ohp2?>-<?=$ohp3?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>이메일</td>
					<td class='tab'><?=$oemail?></td>
					<td class='tab_tit'>주문일시</td>
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
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
				<tr> 
					<td width="17%" class='tab_tit'>성명</td>
					<td width="83%" class='tab' colspan='3'><?=$pname?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>주소</td>
					<td class='tab' colspan='3'><?=$pzipcode?> <?if($pzip1 && $pzip2){echo "[".$pzip1."-".$pzip2."]";}?><br><?=$paddr1?><br><?=$paddr2?></td>
				</tr>
				<tr> 
					<td width="17%" class='tab_tit'>유선전화</td>
					<td width="33%" class='tab'><?=$ptel1?>-<?=$ptel2?>-<?=$ptel3?></td>
					<td width="17%" class='tab_tit'>휴대전화</td>
					<td width="33%" class='tab'><?=$php1?>-<?=$php2?>-<?=$php3?></td>
				</tr>
				<tr> 
					<td class='tab_tit'>배송메세지</td>
					<td class='tab' colspan='3'><?=$ment?></td>
				</tr>
			</table>
		</td>
	</tr>

<!-- /배송지정보 -->

</table>