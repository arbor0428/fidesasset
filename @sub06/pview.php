<?
	$msgTxt = "등이 굽은 편이며 팔이 좀 긴편입니다.";

	if(!$uid){
		Msg::backMsg('접근오류입니다');
		exit;

	}else{
		//오늘 본 상품추가
	//	Util::getTodayProduct($dbconn,$uid,$GBL_USERID);

		$sql = "select * from ks_product where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$upfile01 = $row["upfile01"];		//이미지
		$upfile02 = $row["upfile02"];		//상세설명 상단이미지
		$upfile03 = $row["upfile03"];		//상세설명 하단이미지#1
		$upfile04 = $row["upfile04"];		//상세설명 하단이미지#2

		$etc_opt01 = $row["etc_opt01"];	//여성한복 > 촬영한복 추가옵션
		$etc_opt02 = $row["etc_opt02"];	//여성한복 > 촬영한복 추가옵션
		$etc_opt03 = $row["etc_opt03"];	//여성한복 > 촬영한복 추가옵션
		$etc_opt04 = $row["etc_opt04"];	//여성한복 > 촬영한복 추가옵션

		$upfile02 = '';
		$upfile03 = '';
		$upfile04 = '';

		$title = $row["title"];					//상품명
		$oprice = $row["oprice"];	 		//세일전가격
		$price = $row["price"];				//판매가격
//		$baeja = $row["baeja"];				//배자
		$ment = $row["ment"];				//내용

		$puserid = $row["userid"];				//판매자

		$acclist = $row["acclist"];			//추천장신구
		$manlist = $row["manlist"];			//추천남성한복
		$vestlist = $row["vestlist"];			//추천털배자(조끼)

		$data04 = $row["data04"];
		$data05 = $row["data05"];
		$data06 = $row["data06"];
		$data07 = $row["data07"];
		$data08 = $row["data08"];
		$data09 = $row["data09"];

		if($oprice)	$opriceTxt = "<s style='font-weight:100; color:#6a6a6a; margin-right:15px;font-size:13px;'>".number_format($oprice)."원</s>&nbsp;&nbsp;";
		else			$opriceTxt = '';



		$priceTxt = "<span style='font-size:22px;color:#ae0000;' ><b style='font-family:Tahoma'>".number_format($price)."원</b></span>";

		//적립금표시
		$point = round($price * 0.02);
		$pointTxt = "<font color='#52809a'>".number_format($point)." (2%)</font>";

		$imgTag01 = '';

		if($upfile01){
			$imgFile = $path.'thumb_'.$upfile01;
			if(!is_file($imgFile))	$imgFile = $path.$upfile01;
			$resize = Util::AutoImgSize($imgFile,$G_Size01,$G_Size02);
			$imgTag01 = "<img src='$imgFile' $resize>";
			$imgTag01 = "<div style='width:400px;height:400px;background:url(".$imgFile.") center center no-repeat;border:1px solid #d1d1d1;box-sizing:border-box;background-size:cover'></div>";
		}

/*
		$imgTag02 = '';

		if($upfile02){
			$imgFile = $path.'thumb_'.$upfile02;
			if(!is_file($imgFile))	$imgFile = $path.$upfile02;
			$resize = Util::AutoImgSize($imgFile,1100,3000);
			$imgTag02 = "<img src='$imgFile' $resize>";
		}


		$imgTag03 = '';

		if($upfile03){
			$imgFile = $path.'thumb_'.$upfile03;
			if(!is_file($imgFile))	$imgFile = $path.$upfile03;
			$resize = Util::AutoImgSize($imgFile,1100,3000);
			$imgTag03 = "<img src='$imgFile' $resize>";
		}


		$imgTag04 = '';

		if($upfile04){
			$imgFile = $path.'thumb_'.$upfile04;
			if(!is_file($imgFile))	$imgFile = $path.$upfile04;
			$resize = Util::AutoImgSize($imgFile,1100,3000);
			$imgTag04 = "<img src='$imgFile' $resize>";
		}
*/
	}
?>

<script language='javascript'>
function set_ea(type){
	form = document.frm01;
	EA = parseFloat(form.pea.value);
	T=Number('1e'+1);

	if(type=='up'){
		form.pea.value = EA + 1;
	}else{
		if(EA > 1){
			form.pea.value = EA - 1;
		}else{
			alert('1개 이상 주문하셔야 합니다');
			return;
		}
	}
}

function golist(){
	form = document.frm01;
	form.type.value = 'list';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function goOrderCart(n){
	form = document.frm01;

	pid = form.pid.value;
	puserid = form.puserid.value;
	//pea = 1;

	form.type.value = 'write';
	form.direct_order.value = n;
	form.target = '';
	form.action = '../cart/proc2.php';
	form.submit();

}

function setMsg(field){
	form = document.frm01;
	txt = form[field].value;

	if(txt == '<?=$msgTxt?>'){
		form[field].value = '';
		form[field].focus();
	}
}
</script>



<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type='hidden' name='type' value=''>
<input type='hidden' name='userid' value='<?=$GBL_USERID?>'>
<input type='hidden' name='cade01' value='<?=$cade01?>'>
<input type='hidden' name='cade02' value='<?=$cade02?>'>
<input type='hidden' name='uid' value='<?=$uid?>'><!-- 장바구니 또는 주문시 상품id -->
<input type='hidden' name='pid' value='<?=$uid?>'><!-- 장바구니 또는 주문시 상품id -->
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='direct_order' value=''>
<input type='hidden' name='puserid' value='<?=$puserid?>'>

	<div class='view_wrap' style='width:1100px;'>
		<div class="clearfix">
			<!-- 이미지 -->
			<div class='view_img' valign='top' style='width:400px; text-align:center;'><?=$imgTag01?></div>
			<!-- //이미지 -->
								
			<!-- 상세설정내용 -->
			<div class="view_content" valign="top">
				<div class="shop_frame shop_title_text">
					<?=$title?>
				</div>
				<div class="shop_frame">
					<!-- 내용 -->
					<div style="width:100%;">
						<div class="shop_list" style="border-bottom:1px solid #e1e1e1;padding-bottom:15px;">
							<?=$opriceTxt?><?=$priceTxt?>
						</div>				
						<div class="shop_list" style="border-bottom:1px solid #e1e1e1;padding-bottom:15px;">
							<b style="line-height:20px;font-size:14px;">택배비 : 무료배송</b><br>
							<!--<span style="line-height:20px;font-size:12px;">택배사 : cj대한통운</span><br>-->
						</div>				
						<div class="shop_list02 clearfix" style="padding-bottom:15px;">
							<div style='width:70px;height:40px;float:left;'>
								<input type='text' name='pea' value='1' class='input01' style='width:70px;height:40px;' readonly>
							</div>
							<div style='float:left;margin-left:5px;'>
								<div style='width:20px;height:20px;'>
									<img src="/images/basket_up.jpg" onclick="set_ea('up');" alt="up" style="cursor:pointer;"/>
								</div>
								<div style='width:20px;height:20px;'>
									<img src="/images/basket_down.jpg" onclick="set_ea('down');" alt="down" style="cursor:pointer;"/>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class='clearfix' style='width:100%;'>
					<div class="shop_btn" style="float:left; width:50%;">
						<a  href="javascript:goOrderCart('1');" style="display:block; width:100%; height: 100%;">
							<div style='width:100%; height: 100%; padding:12px 0px; background-color:#212121; font-size:17px; font-weight:bold; '>바로 구매</div>
						</a>
					</div>		
					<div class="shop_btn02" style="float:left; width:23%; margin-left:2%;">
						<a href="javascript:goOrderCart('');" style="display:block; width:100%; height: 100%;">
							<div style="padding:12px 0px;  border:1px solid #212121; box-sizing: border-box; width:100%; height: 100%; font-size:17px; font-weight:bold; ">장바구니담기</div>
						</a>
					</div>	
					<div class="shop_btn02" style="float:left; width:23%; margin-left:2%;">
						<a href="javascript:golist();" style="display:block; width:100%; height: 100%;">
							<div style="padding:12px 0px; border:1px solid #212121; box-sizing: border-box; width:100%; height: 100%; font-size:17px; font-weight:bold; ">다른상품보기</div>
						</a>
					</div>
				</div>

			</div>
			<!-- //상세설정내용 -->
		</div>
	</div>
	<?
		if($cade01=='온라인몰'){
			//상품상세정보
			include 'tab01.php';
			//상품후기
			include 'tab02.php';
			//상품문의
			include 'tab03.php';
		}else{
			//전문가용 상세정보
			include 'tab04.php';
		}
	?>
</form>





<style>
.view_img {float:left; margin-right:100px;}
.view_content {float:left; width:600px;}

@media (max-width: 1235px) {

	.view_wrap {width:100% !important;}
	.view_img {width: 30% !important; margin-right:5%;}
	.view_img > div {width: 100% !important;}
	.view_content {width:65% !important;}
	.view_content > div {width: 100% !important;}

}

@media (max-width: 1000px) {
	.view_img {width: 60% !important; margin-right: 20%; margin-left: 20%;  margin-bottom:35px;}
	.view_content {width: 100% !important;}
}

@media (max-width: 840px) {

	.view_img {width: 100% !important; margin-right:0; margin-left:0;}


}

@media (max-width:706px) {
	.shop_btn {width:33.333% !important;}
	.shop_btn02 {width:31.333% !important; margin-left: 1% !important;}

	.shop_btn > a > div {font-size:15px !important;}
	.shop_btn02 > a > div {font-size:14px !important;}

}
</style>



<script>
$(function(){
	$(".view_img>div").height($(".view_img>div").width())
	$(window).resize(function(){
		$(".view_img>div").height($(".view_img>div").width())
	})
})
</script>




<iframe name='ifra01' src='about:blank' width='0' height='0' scrolling='no' frameborder='0'></iframe>



