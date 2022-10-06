<?

	$mNum = '1';
	$sNum = '1';

	include '../header.php';

	$path = '../upfile/shop/';
	if(!$type)	$type = 'list';
	if($type == 'list'){
		if($GBL_USERID || $f_oname){
			$content_box_w='1200';			
		}else{
			$content_box_w='600';
		}
	}elseif($type == 'view'){
		$content_box_w='1200';		
	}

?>

<div class="sub_visual sub_visual02 visual_wrap">
	<div class="text-box">주문내역</div>
</div>

<div class='content_box' style='width:1200px;'>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		
		<tr>
			<td style='padding:0px 0px 0px 0px;' align='center'>
			<?
				

				if($type == 'list'){
					if($GBL_USERID || $f_oname){
						include 'orderlist.php';

					}else{
						include 'ordersearch.php';	//로그인을 하지 않은 경우 주문자와 휴대전화번호 검색을 이용하여 주문내역을 가져온다
					}

				}elseif($type == 'view'){
					include 'orderview.php';
				}
			?>
			</td>
		</tr>	
	</table>
</div>

<? include '../footer.php'; ?>