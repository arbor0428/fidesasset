<?
########### 24시간 지난 장바구니 삭제 #############
/*
	$now = time();
	$chk_time = $now - (24*60*60);
	$sql = "delete from tb_cart where reg_date < $chk_time";
	$result = mysql_query($sql);
*/
########### 회원 로그인시 정보 가져오기 #############

	$host_ip = $_SERVER['REMOTE_ADDR'];

?>
<script language='javascript'>
function cart_del(uid){
	if(confirm('삭제하시겠습니까?')){
		form = document.frm_cart;
		form.uid.value = uid;
		form.type.value = 'del';
		form.target = 'ifra01';
		form.submit();
	}
}


function frm_check(){

	form = document.frm_cart;
	form.type.value = 'order';
	form.target = '';
	form.action = 'proc.php';
	form.submit();

}


function setcart(type,uid,cade01){
	form = document.frm_cart;

	//배송비 제외항목
	if(cade01 == '장신구' || cade01 == '장신구(판매)' || cade01 == '여아한복(판매)' || cade01 == '남아한복(판매)'){
		except = true;
	}else{
		except = false;
	}
	
	obj01 = form['ea'+uid];	 //수량필드
	obj02 = form['op'+uid];	 //가격 필드

	//개별수량
	vea = obj01.value;
	EA = parseFloat(vea);

	//개별단가
	vprice = obj02.value;
	Price = parseFloat(vprice);

	//상품구매금액
	result_price = parseFloat(form.result_price.value);

	//총수량
	Te = parseFloat(form.tot_ea.value);

	//장신구 총수량
	Ae = parseFloat(form.acc_ea.value);

	//왕복배송비
	if(Te == Ae)		Sprice = 0;
	else				Sprice = 6000;

	if(type=='up'){
		obj01.value = EA + 1;
		sp = Price * (EA + 1);

		//총수량
		TeT = Te + 1;
		form.tot_ea.value = TeT;

		if(except){
			Ae++;
			form.acc_ea.value = Ae;
		}

		spNum = TeT - Ae;

		//왕복배송비설정
		for(i=1; i<spNum; i++){
			Sprice += 2000;
		}

		document.getElementById("ptxt"+uid).innerHTML = number_format(sp);
		form.result_price.value = result_price + Price
		form.amt.value = result_price + Price + Sprice;



	}else{
		if(EA > 1){
			obj01.value = EA - 1;
			sp = Price * (EA - 1);

			//총수량
			TeT = Te - 1;
			form.tot_ea.value = TeT;

			if(except){
				Ae--;
				form.acc_ea.value = Ae;
			}

			spNum = TeT - Ae;

			//왕복배송비설정
			for(i=1; i<spNum; i++){
				Sprice += 2000;
			}

			document.getElementById("ptxt"+uid).innerHTML = number_format(sp);
			form.result_price.value = result_price - Price
			form.amt.value = (result_price - Price) + Sprice;

		}else{
			alert('1개 이상 주문하셔야 합니다');
			return;
		}
	}

	form.ship_price.value = Sprice;

	LastTotal = parseFloat(form.amt.value);

	document.getElementById("Divtot").innerHTML = "(총수량 : "+number_format(TeT)+" EA / 왕복배송비 : "+number_format(Sprice)+"원)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[총계]&nbsp;<span class='font_red'>"+number_format(LastTotal)+"원</span>";



}
</script>

<form name='frm_cart' method='post' action='proc.php'>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='type' value=''>
<input type='hidden' name='userid' value='<?=$GBL_USERID?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>


<!-- 장바구니 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
	<tr>
		<td style="padding-top: 7;">

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td bgcolor="8c8c8c"  height="1" style='padding:1px 0px 0px 0px;' colspan="7"></td>
				</tr>
				 <tr align="center" height='30' bgcolor='#f7f7f7'>
					<td width="15%" class='bbs'>이미지</td>
					<td width="31%" class='bbs'>상품명</td>
					<td width="11%" class='bbs'>대여료</td>
					<td width="11%" class='bbs'>옵션가</td>
					<td width="11%" class='bbs'>수량</td>
					<td width="11%" class='bbs'>합계</td>
					<td width="10%" class='bbs'>삭제</td>
				</tr>

				<tr height="2">
					<td bgcolor="8d8d8d"></td>
					<td bgcolor="e86261" colspan="1"></td>
					<td bgcolor="8d8d8d" colspan="5"></td>
				</tr>



<?
	if($GBL_USERID)		$query = "select * from ks_cart where userid='$GBL_USERID' or ip='$host_ip' order by uid desc";
	else						$query = "select * from ks_cart where ip='$host_ip' order by uid desc";

	$result = mysql_query($query);
	$total_record = mysql_num_rows($result);

	if($total_record != '0'){
		$cart_idx = '';
		$tot_price = 0;		//총상품금액
		$tot_ea = 0;		//총수량
		$acc_ea = 0;		//장신구수량

		for($i=0; $i<$total_record; $i++){
			$tea = 0;			//결제금액 계산용 수량
			$optAmt = 0;		//추가옵션가
		
			$row = mysql_fetch_array($result);
			$uid = $row['uid'];
			$pid = $row['pid'];				//주문상품
			$pdate = $row['pdate'];		//행사일
			$pea = $row['pea'];				//주문수량

			$tot_ea += $pea;
			$tea += $pea;

			$pdateTxt = date('Y-m-d',$pdate);



			//여성한복 주문옵션			
			$gdata01 = $row['gdata01'];		//여성사이즈
			$gdata02 = $row['gdata02'];		//속치마
			$gdata03 = $row['gdata03'];		//신장
			$gdata04 = $row['gdata04'];		//가슴둘레
			$gdata05 = $row['gdata05'];		//총장
			$gdata06 = $row['gdata06'];		//슬리퍼
			$gdata07 = $row['gdata07'];		//높이
			$gdata08 = $row['gdata08'];		//버선
			$gdata09 = $row['gdata09'];		//특이사항

			if($gdata02 == '링속치마(+5,000원)')		$optAmt += 5000;
			if($gdata08 == '구매(3,000원)')				$optAmt += 3000;





			//여성한복 > 촬영한복 주문옵션
			$etc01 = $row['etc01'];			//아얌
			$etc02 = $row['etc02'];			//비녀
			$etc03 = $row['etc03'];			//뱃씨댕기
			$etc04 = $row['etc04'];			//노리개

			if($etc01 == '아얌(3,000원)')		$optAmt += 3000;
			if($etc02 == '비녀(2,000원)')		$optAmt += 3000;
			if($etc03 == '뱃씨댕기(3,000원)')	$optAmt += 3000;
			if($etc04 == '노리개(4,000원)')		$optAmt += 3000;





			//남성한복 주문옵션
			$mdata01 = $row['mdata01'];	//가슴둘레
			$mdata02 = $row['mdata02'];	//허리사이즈
			$mdata03 = $row['mdata03'];	//신장
			$mdata04 = $row['mdata04'];	//신발
			$mdata05 = $row['mdata05'];	//특이사항



			if($mdata04 != '' && $mdata04 != '선택없음')	$optAmt += 5000;







			//남아한복(대여 && 판매) 주문옵션
			$bdata01 = $row['bdata01'];		//키,몸무게
			$bdata02 = $row['bdata02'];		//사이즈
			$bdata03 = $row['bdata03'];		//신발
			$bdata04 = $row['bdata04'];		//모자
			$bdata05 = $row['bdata05'];		//돌띠
			$bdata06 = $row['bdata06'];		//버선
			$bdata07 = $row['bdata07'];		//특이사항









			//여아한복(대여) 주문옵션
			$cdata01 = $row['cdata01'];		//키,몸무게
			$cdata02 = $row['cdata02'];		//사이즈
			$cdata03 = $row['cdata03'];		//신발
			$cdata04 = $row['cdata04'];		//모자
			$cdata05 = $row['cdata05'];		//돌띠
			$cdata06 = $row['cdata06'];		//버선
			$cdata07 = $row['cdata07'];		//특이사항








			//상품정보
			$sql01 = "select * from ks_product where uid='$pid'";
			$res01 = mysql_query($sql01);
			$num01 = mysql_num_rows($res01);
			if($num01){

				if($cart_idx)	 $cart_idx .= ',';
				$cart_idx .= $uid;

				$row01 = mysql_fetch_array($res01);
				$cade01 = $row01["cade01"];	//분류
				$title = $row01["title"];				//상품명
				$price = $row01["price"];			//판매가격
				$upfile01 = $row01["upfile01"];




				if($cade01 == '남아한복'){
					if(strpos($bdata03,'(+5,000)',0))			$optAmt += 5000;
					if(strpos($bdata04,'(+5,000)',0))			$optAmt += 5000;
					if(strpos($bdata05,'(+6,000)',0))			$optAmt += 6000;
					if(strpos($bdata06,'(+2,000)',0))			$optAmt += 2000;


				}elseif($cade01 == '남아한복(판매)'){
					if(strpos($bdata02,'(+10,000)',0))			$optAmt += 10000;
					elseif(strpos($bdata02,'(+20,000)',0))		$optAmt += 20000;
					elseif(strpos($bdata02,'(+30,000)',0))		$optAmt += 30000;
					elseif(strpos($bdata02,'(+40,000)',0))		$optAmt += 40000;

					if(strpos($bdata03,'(+18,000)',0))			$optAmt += 18000;
					elseif(strpos($bdata03,'(+20,000)',0))		$optAmt += 20000;
					elseif(strpos($bdata03,'(+23,000)',0))		$optAmt += 23000;

					if(strpos($bdata04,'(+20,000)',0))			$optAmt += 20000;

					if(strpos($bdata05,'(+30,000)',0))			$optAmt += 30000;

					if(strpos($bdata06,'(+15,000)',0))			$optAmt += 15000;


				}elseif($cade01 == '여아한복'){
					if(strpos($cdata03,'(+5,000)',0))			$optAmt += 5000;

					if(strpos($cdata04,'(+5,000)',0))			$optAmt += 5000;
					elseif(strpos($cdata04,'(+3,000)',0))		$optAmt += 3000;

					if(strpos($cdata05,'(+6,000)',0))			$optAmt += 6000;
					if(strpos($cdata06,'(+2,000)',0))			$optAmt += 2000;


				}elseif($cade01 == '여아한복(판매)'){
					if(strpos($cdata02,'(+10,000)',0))			$optAmt += 10000;
					elseif(strpos($cdata02,'(+20,000)',0))		$optAmt += 20000;
					elseif(strpos($cdata02,'(+30,000)',0))		$optAmt += 30000;
					elseif(strpos($cdata02,'(+40,000)',0))		$optAmt += 40000;

					if(strpos($cdata03,'(+18,000)',0))			$optAmt += 18000;
					elseif(strpos($cdata03,'(+20,000)',0))		$optAmt += 20000;
					elseif(strpos($cdata03,'(+23,000)',0))		$optAmt += 23000;

					if(strpos($cdata04,'(+12,000)',0))			$optAmt += 12000;
					elseif(strpos($cdata04,'(+30,000)',0))		$optAmt += 30000;
					elseif(strpos($cdata04,'(+40,000)',0))		$optAmt += 40000;

					if(strpos($cdata05,'(+30,000)',0))			$optAmt += 30000;

					if(strpos($cdata06,'(+15,000)',0))			$optAmt += 15000;

				}





				$resultPrice = $price + $optAmt;


				//(대여료 + 추가옵션가) * 수량
				$oprice = $resultPrice * $tea;				

				//결제금액
				$tot_price += $oprice;

				//배송비 제외항목 수량
				if($cade01 == '장신구' || $cade01 == '장신구(판매)' || $cade01 == '여아한복(판매)' || $cade01 == '남아한복(판매)'){
					$acc_ea += $pea;
				}


				$pricetxt = number_format($oprice);

				$imgTag = '';

				if($upfile01){
					$imgFile = $path.'thumb_'.$upfile01;
					if(!is_file($imgFile))	$imgFile = $path.$upfile01;
					$resize = Util::AutoImgSize($imgFile,$G_Size01,$G_Size02);
					$imgTag = "<img src='$imgFile' $resize>";
				}

				if($i % 2)	$bgc = '#f7f7f7';
				else			$bgc = '#ffffff';

?>
				<input type='hidden' name='op<?=$uid?>' value='<?=$resultPrice?>'><!-- 상품별 가격(옵션가포함) -->

				<!-- 상품 -->
				<tr bgcolor='<?=$bgc?>'> 
					<td align='center' style='padding:10px 0px;'><?=$imgTag?></td>
					<td class='bbs' style='padding:10px 0px 10px 15px;'>
				<?
					if($cade01 == '여성한복' || $cade01 == '혼주한복'){
				?>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>[<?=$cade01?>]<br><span class='tmenu3'><?=$title?></span></td>
							</tr>
							<tr>
								<td style='font-size:11px;line-height:155%;'>
									행사일 : <?=$pdateTxt?><br>
									여성사이즈 : <?=$gdata01?><br>
									속치마 : <?=$gdata02?><br>
									신장 : <?=$gdata03?><br>
									가슴둘레 : <?=$gdata04?><br>
									총장 : <?=$gdata05?><br>
									슬리퍼 : <?=$gdata06?><br>
									높이 : <?=$gdata07?><br>
									버선 : <?=$gdata08?><br>
							<?
									if($etc01)	echo $etc01.'<br>';
									if($etc02)	echo $etc02.'<br>';
									if($etc03)	echo $etc03.'<br>';
									if($etc04)	echo $etc04.'<br>';
							?>
									<?=$gdata09?>
								</td>
							</tr>
						</table>

				<?
					}elseif($cade01 == '남성한복'){
				?>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>[<?=$cade01?>]<br><span class='tmenu3'><?=$title?></span></td>
							</tr>
							<tr>
								<td style='font-size:11px;line-height:155%;'>
									행사일 : <?=$pdateTxt?><br>
									가슴둘레 : <?=$mdata01?><br>
									허리사이즈 : <?=$mdata02?><br>
									신장 : <?=$mdata03?><br>
									신발 : <?=$mdata04?><br>
									<?=$mdata05?>
								</td>
							</tr>
						</table>

				<?
					}elseif($cade01 == '커플한복'){
				?>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>[<?=$cade01?>]<br><span class='tmenu3'><?=$title?></span></td>
							</tr>
							<tr>
								<td>행사일 : <?=$pdateTxt?></td>
							</tr>
							<tr>
								<td style='font-size:11px;line-height:155%;padding:15px 0px 0px 0px;'>
									<font color='#52809a'><b>- 여성한복 -</b></font><br>
									여성사이즈 : <?=$gdata01?><br>
									속치마 : <?=$gdata02?><br>
									신장 : <?=$gdata03?><br>
									가슴둘레 : <?=$gdata04?><br>
									총장 : <?=$gdata05?><br>
									슬리퍼 : <?=$gdata06?><br>
									높이 : <?=$gdata07?><br>
									버선 : <?=$gdata08?><br>
									<?=$gdata09?>
								</td>
							</tr>
							<tr>
								<td style='font-size:11px;line-height:155%;padding:15px 0px 0px 0px;'>
									<font color='#52809a'><b>- 남성한복 -</b></font><br>
									가슴둘레 : <?=$mdata01?><br>
									허리사이즈 : <?=$mdata02?><br>
									신장 : <?=$mdata03?><br>
									신발 : <?=$mdata04?><br>
									<?=$mdata05?>
								</td>
							</tr>
						</table>

				<?
					}elseif($cade01 == '장신구' || $cade01 == '장신구(판매)'){
				?>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>[<?=$cade01?>]<br><span class='tmenu3'><?=$title?></span></td>
							</tr>
							<tr>
								<td style='font-size:11px;line-height:155%;'>행사일 : <?=$pdateTxt?></td>
							</tr>
						</table>


				<?
					}elseif($cade01 == '남아한복' || $cade01 == '남아한복(판매)'){
				?>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>[<?=$cade01?>]<br><span class='tmenu3'><?=$title?></span></td>
							</tr>
							<tr>
								<td style='font-size:11px;line-height:155%;'>
									행사일 : <?=$pdateTxt?><br>
									키,몸무게 : <?=$bdata01?><br>
									사이즈 : <?=$bdata02?><br>
									신발 : <?=$bdata03?><br>
									모자 : <?=$bdata04?><br>
									돌띠 : <?=$bdata05?><br>
									버선 : <?=$bdata06?><br>
									<?=$bdata07?>
								</td>
							</tr>
						</table>


				<?
					}elseif($cade01 == '여아한복' || $cade01 == '여아한복(판매)'){
				?>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>[<?=$cade01?>]<br><span class='tmenu3'><?=$title?></span></td>
							</tr>
							<tr>
								<td style='font-size:11px;line-height:155%;'>
									행사일 : <?=$pdateTxt?><br>
									키,몸무게 : <?=$cdata01?><br>
									사이즈 : <?=$cdata02?><br>
									신발 : <?=$cdata03?><br>
									모자 : <?=$cdata04?><br>
									돌띠 : <?=$cdata05?><br>
									버선 : <?=$cdata06?><br>
									<?=$cdata07?>
								</td>
							</tr>
						</table>


				<?
					}
				?>
					</td>
					<td class='bbs01' align='center'><?=number_format($price)?></td>
					<td class='bbs01' align='center'><?=number_format($optAmt)?></td>
					<td class='bbs01' align='center'>
						
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td rowspan='2'><input type='text' name='ea<?=$uid?>' style='width:35px;height:20px;border:1px solid #cccccc;text-align:center;' value='<?=$tea?>' readonly></td>
								<td style='padding:0px 0px 0px 3px;'><img src="/images/basket_up.gif" onclick="setcart('up','<?=$uid?>','<?=$cade01?>');" alt="up" style="cursor:pointer;cursor:hand;"/></td>
							</tr>
							<tr>
								<td style='padding:0px 0px 0px 3px;'><img src="/images/basket_down.gif" onclick="setcart('down','<?=$uid?>','<?=$cade01?>');" alt="down" style="cursor:pointer;cursor:hand"/></td>
							</tr>
						</table>					
					
					</td>
					<td align='center'><div id='ptxt<?=$uid?>' class='bbs04'><?=$pricetxt?></div></td>
					<td align='center'><a href="javascript:cart_del('<?=$uid?>');"><img src="/images/common/delete.gif" border='0' /></a></td>
				</tr>
				<tr>
					<td colspan="7" bgcolor="cccccc" style='padding:1px 0px 0px 0px;' height="1"></td>
				</tr>
				<!-- 상품 END-->
<?
			}else{
?>
				<tr>
					<td colspan='6' height='50' align='center'>상품정보가 없습니다</td>
					<td align='center'><a href="javascript:cart_del('<?=$uid?>');"><img src="/images/btn_delete.gif" border='0' /></a></td>
				</tr>
				<tr>
					<td colspan="7" bgcolor="cccccc" style='padding:1px 0px 0px 0px;' height="1"></td>
				</tr>
<?
			}
		
		}

		//총결제금액
		$total = $tot_price;

		//총왕복배송비
		if($tot_ea == $acc_ea){
			$sp = 0;
		}else{
			$sp = 6000;	//기본1개(1개추가 주문시마다 2,000원씩 추가)
		}

		for($s=1; $s<$tot_ea-$acc_ea; $s++){
			$sp += 2000;
		}
		$spTxt = number_format($sp);

		$amt = $tot_price + $sp;
?>
				<input type='hidden' name='cart_idx' value='<?=$cart_idx?>'>
				<tr>
					<td colspan="7" height="30" align="right" style='padding-right:10px;font-weight:bold;'><div id='Divtot' class='txt_pro'>(총수량 : <?=$tot_ea?> EA / 왕복배송비 : <?=$spTxt?>원)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[총계]&nbsp;<span class="font_red"><?=number_format($amt)?>원</span></div></td>
				</tr>

<?
	}else{
		echo ("<tr><td height=50 align='center' colspan=7>등록된 상품이 없습니다.</td></tr>");
	}

?>
				<input type='hidden' name='amt' value='<?=$amt?>'><!-- 결제금액(왕복배송비포함) -->
				<input type='hidden' name='result_price' value='<?=$tot_price?>'><!-- 상품구매금액 -->
				<input type='hidden' name='ship_price' value='<?=$sp?>'><!-- 왕복배송비 -->
				<input type='hidden' name='tot_ea' value='<?=$tot_ea?>'><!-- 총수량 -->
				<input type='hidden' name='acc_ea' value='<?=$acc_ea?>'><!-- 장신구수량(택배비에 반영되지않음) -->

				<tr>
					<td colspan="7" height="1" style='padding:1px 0px 0px 0px;' bgcolor="8c8c8c"></td>
				</tr>
				<tr>
					<td colspan="7" height="3" bgcolor="f5f5f5"></td>
				</tr>
			</table>
		</td>
	</tr>


<?
if($total_record != '0'){
?>
	<tr>
		<td height="30" align="right" style='padding-right:10px;'>※ 제주도 및 도서산간 지역에는 추가 배송비가 발생할 수 있습니다</td>
	</tr>
	<tr>
		<td align="center" style="padding:30px 0px 0px 0px;"><a href="javascript:frm_check();" onFocus="this.blur()" ><img src="/images/btn_order.gif" border='0' /></a></td>
	</tr>
<?
}
?>
</table>


</form>

<iframe name='ifra01' src='about:blank' width='0' height='0' frameborder='0' scrolling='no'></iframe>