<?
########### 24시간 지난 장바구니 삭제 #############
/*
	$now = time();
	$chk_time = $now - (24*60*60);
	$sql = "delete from tb_cart where reg_date < $chk_time";
	$result = mysql_query($sql);
*/
########### 회원 로그인시 정보 가져오기 #############

/*
[왕복배송비 설정정보]
20만원 이상무료

장신구를 제외한
1벌 주문시 6,000원
2벌 이상시 8,000원

장신구만 주문시 무조건 6,000원
*/

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
	form.action = 'proc2.php';
	form.submit();

}


function setcart(type,uid,cade01){
	form = document.frm_cart;

	//배송비 제외항목
	if(cade01 == '장신구(판매)' || cade01 == '여아한복(판매)' || cade01 == '남아한복(판매)' || cade01 == '여성한복' || cade01 == '남성한복' || cade01 == '커플한복'){
		except = true;
	}else{
		except = false;
	}
	
	obj01 = form['ea'+uid];	 //수량필드
	obj02 = form['op'+uid];	 //가격필드

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
	Sprice = 0;

	if(type=='up'){
		obj01.value = EA + 1;
		sp = Price * (EA + 1);

		//총수량
		TeT = Te + 1;

		if(except)	Ae++;

		set_price = result_price + Price;


	}else{
		if(EA > 1){
			obj01.value = EA - 1;
			sp = Price * (EA - 1);

			//총수량
			TeT = Te - 1;

			if(except)	Ae--;

			set_price = result_price - Price;

		}else{
			alert('1개 이상 주문하셔야 합니다');
			return;
		}
	}

	//상품별 합계금액
	document.getElementById("ptxt"+uid).innerHTML = number_format(sp);

	//상품구매금액
	form.result_price.value = set_price;

	//총주문수량
	form.tot_ea.value = TeT;

	//장신구수량
	form.acc_ea.value = Ae;

	//왕복배송비
	if(set_price >= 200000)		Sprice = 0;			//20만원이상 무료
	else if((TeT-Ae) >= 2)		Sprice = 8000;	//장신구 제외한 주문수량이 2개이상이면 8,000원
	else if((TeT-Ae) == 1)		Sprice = 6000;	//장신구 제외한 주문수량이 1개이면 6,000원

	//왕복배송비
	form.ship_price.value = Sprice;

	//총계
	form.amt.value = set_price + Sprice;
	LastTotal = parseFloat(form.amt.value);

	document.getElementById("Divtot").innerHTML = "(총수량 : "+number_format(TeT)+" EA / 왕복배송비 : "+number_format(Sprice)+"원)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[총계]&nbsp;<span class='font_red'>"+number_format(LastTotal)+"원</span>";



}
</script>

<form name='frm_cart' method='post' action='proc2.php'>
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
					<td width="11%" class='bbs'>금액</td>
					<!-- <td width="11%" class='bbs'>옵션가</td> -->
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
	if($GBL_USERID)		$query = "select c.* from ks_cart as c left join ks_product as p on c.pid=p.uid where (c.userid='$GBL_USERID' or c.ip='$host_ip') and p.uid=c.pid order by c.uid desc";
	else						$query = "select c.* from ks_cart as c left join ks_product as p on c.pid=p.uid where c.ip='$host_ip' and p.uid=c.pid order by c.uid desc";

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
				$fix_price = $row01["fix_price"];	//가격고정
				$upfile01 = $row01["upfile01"];

				if($fix_price == ''){
					if($cade01 == '여성한복')			$price = 89000;
					elseif($cade01 == '남성한복')	$price = 89000;
					elseif($cade01 == '커플한복')	$price = 178000;

				}elseif($fix_price == '2'){
					if($cade01 == '여성한복')			$price = 99000;
					elseif($cade01 == '남성한복')	$price = 99000;
					elseif($cade01 == '커플한복')	$price = 198000;
				}


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
				if($cade01 == '장신구(판매)' || $cade01 == '여아한복(판매)' || $cade01 == '남아한복(판매)' || $cade01 == '여성한복' || $cade01 == '남성한복' || $cade01 == '커플한복'){

					//상품수량을 2개로 처리하여 배송비를 추가함
					if($cade01 == '커플한복' && $price == '118000'){
						$acc_ea -= 1;

					//특가상품은 배송비를 추가
					}elseif(($cade01 == '여성한복' || $cade01 == '남성한복') && $price == '59000'){

					}else{
						$acc_ea += $pea;
					}

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
					<td align='center' style='padding:10px 0px;'><img src='<?=$imgFile?>' style='width:100px;'></td>
					<td class='bbs' style='padding:10px 0px 10px 15px;'>
						<?=$title?>
					</td>
					<td class='bbs01' align='center'><?=number_format($price)?></td>
					<!-- <td class='bbs01' align='center'><?=number_format($optAmt)?></td> -->
					<td class='bbs01' align='center'><?=$tea?><input type='hidden' name='ea<?=$uid?>' value='<?=$tea?>'>
					<!--						
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td rowspan='2'><input type='text' name='ea<?=$uid?>' style='width:35px;height:20px;border:1px solid #cccccc;text-align:center;' value='<?=$tea?>' readonly></td>
								<td style='padding:0px 0px 0px 3px;'><img src="/images/basket_up.gif" onclick="setcart('up','<?=$uid?>','<?=$cade01?>');" alt="up" style="cursor:pointer;cursor:hand;"/></td>
							</tr>
							<tr>
								<td style='padding:0px 0px 0px 3px;'><img src="/images/basket_down.gif" onclick="setcart('down','<?=$uid?>','<?=$cade01?>');" alt="down" style="cursor:pointer;cursor:hand"/></td>
							</tr>
						</table>
					-->					
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
		$sp = 0;

		if($tot_price >= 200000)			$sp = 0;			//20만원이상 무료
		elseif(($tot_ea-$acc_ea) >= 2)	$sp = 8000;	//장신구 제외한 주문수량이 2개이상이면 8,000원
		elseif(($tot_ea-$acc_ea) == 1)	$sp = 6000;	//장신구 제외한 주문수량이 1개이면 6,000원
		$sp = 0;
	

		$spTxt = number_format($sp);

		$amt = $tot_price + $sp;
?>
				<input type='hidden' name='cart_idx' value='<?=$cart_idx?>'>
				<tr>
					<td colspan="7" height="30" align="right" style='padding-right:10px;font-weight:bold;'><div id='Divtot' class='txt_pro'>(총수량 : <?=$tot_ea?> EA / 배송비 : <?=$spTxt?>원)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[총계]&nbsp;<span class="font_red"><?=number_format($amt)?>원</span></div></td>
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
		<td class="kiba_order_btn" align="center" style="padding:30px 0px 0px 0px;"><a href="javascript:frm_check();" onFocus="this.blur()" ><img src="/images/btn_order.gif" border='0' /></a></td>
	</tr>
<?
}
?>
</table>


</form>

<iframe name='ifra01' src='about:blank' width='0' height='0' frameborder='0' scrolling='no'></iframe>

<style>
/*화면 너비 0 ~ 1050px*/
@media (max-width: 1050px){
	.kiba_order_btn a {display:block;  width:120px !important; height:45px !important; margin:0 auto !important;}
}
</style>