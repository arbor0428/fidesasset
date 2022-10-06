<?
	$record_count = 20;  //한 페이지에 출력되는 레코드수
	$link_count = 10;		//한 페이지에 출력되는 페이지 링크수
	$one_line = 4;			//한줄에 출력되는 이미지수


	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));


	//쿼리조건
	$query_ment = "where cade01='$cade01'";

	//정렬방식

	if($sort == 'down'){
		$sort_ment = "order by price";
		$cls01 = 'stxt01';
		$cls02 = 'stxt02';
		$cls03 = 'stxt01';

	}elseif($sort == 'up'){
		$sort_ment = "order by price desc";
		$cls01 = 'stxt01';
		$cls02 = 'stxt01';
		$cls03 = 'stxt02';

	}else{
		$sort_ment = "order by msort desc, uid desc";
		$cls01 = 'stxt02';
		$cls02 = 'stxt01';
		$cls03 = 'stxt01';

	}



	$query = "select * from ks_product $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from ks_product $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);
?>





<script language='javascript'>
function pview(uid){
	form = document.frm01;
	form.type.value = 'view';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function psort(s){
	form = document.frm01;
	form.type.value = 'list';
	form.sort.value = s;
	form.uid.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>






<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='cade01' value='<?=$cade01?>'>
<input type='hidden' name='sort' value='<?=$sort?>'>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>

<table class="list_btn_wrap" cellpadding='0' cellspacing='0' border='0' style="width:100%;">
	<tr>
		<td align='right' style='padding:0px 0px 20px 0px;'>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><a href="javascript:psort('uid');" class='<?=$cls01?>'>신상품</a></td>
					<td style='padding:0px 10px 0px 10px;font-size:14px;' align='center'>｜</td>
					<td><a href="javascript:psort('down');" class='<?=$cls02?>'>낮은가격순</a></td>
					<td style='padding:0px 10px 0px 10px;font-size:14px;' align='center'>｜</td>
					<td><a href="javascript:psort('up');" class='<?=$cls03?>'>높은가격순</a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<!-- 제품 리스트 -->
<table class="item_list" border="0" cellspacing="0" cellpadding="0" style="width:100%;">
	<tr>
<?

	if($total_record != '0'){
		$i = $total_record - ($current_page - 1) * $record_count;

		$line_num = 1;

		while($row = mysql_fetch_array($result)){

			$uid = $row["uid"];
			$enable = $row["enable"];
			$upfile01 = $row["upfile01"];		//이미지
			$title = $row["title"];					//상품명
			$icon = $row["icon"];				//아이콘
			$oprice = $row["oprice"];	 		//세일전가격
			$price = $row["price"];				//판매가격


			if($icon){
				$iconArr = explode(',',$icon);
				$iconCnt = count($iconArr);
			}else{
				$iconCnt = 0;
			}

			if($oprice)	$opriceTxt = "<font color='#919191'><strike>".number_format($oprice)."원</strike></font>&nbsp;&nbsp;";
			else			$opriceTxt = '';


			$priceTxt = "<span class='mpriceTxt'>".number_format($price)."원</span>";


			$imgTag = '';
			$imgFile = '';
			if($upfile01){
				$imgFile = $path.$upfile01;
			}
			if(!$enable){
	?>

			<td valign='top'>
				<table class="item_box" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td class="item_width" style="width:260px; height:260px;" align='center'>
						<a href="javascript:pview('<?=$uid?>')" style='display:block;width:260px; height:260px;background:url(<?=$imgFile?>) center center no-repeat;background-size:cover;border:1px solid #d1d1d1;'></a>
						</td>
					</tr>
					<tr>
						<td class="item_tit" align="center" style='font-size:18px;margin-top:15px;'><?=$title?></td>
					</tr>
					<tr>
						<td class="item_price" align='center'>
						<?
							if($opriceTxt)	echo $opriceTxt;
							
							echo $priceTxt;
						?>
						</td>
					</tr>
				<?
					if($iconCnt > 0){
				?>
					<tr>
						<td height="9"></td>
					</tr>
					<tr>
						<td align="center">
						<?
							for($c=0; $c<count($iconArr); $c++){
								$icoImg = $iconArr[$c];

								if($icoImg){
									if($c > 0)	echo ("&nbsp;");
									echo ("<img src='../images/$icoImg' align='absmiddle'>");
								}
							}
						?>
						</td>
					</tr>
				<?
					}
				?>
				</table>
			</td>




<?
			
		$mod = $line_num % $one_line;
		if ($mod == 0)	echo ("</tr><tr><td style='height:50px'></td></tr>");
		else	echo ("<td style='width:20px;'></td>");

		$i--;
		$line_num++;
	}
}

	//빈TD 채우기
	if($mod > 0){

		for($k=$mod; $k<$one_line; $k++){
			echo ("
						<td>
							<table class='item_box' border='0' cellspacing='0' cellpadding='0' style='width:100%;'>
								<tr>
									<td class='item_width'>&nbsp;</td>
								</tr>
							</table>
						</td>");

			if($k < ($one_line-1))	echo ("<td style='width:20px;'></td>");
		}

	}

}else{
?>

				
			<td height='150' align='center' width='1150'>등록된 상품이 없습니다</td>


<?
}
?>







		</tr>
	</table>
	<!-- 제품 리스트 END -->

</form>


<style>
	.item_list tbody > tr > td {display:inline-block; width:260px;}
@media (max-width: 1235px) {
	.item_list > tbody > tr > td {width: 23%; !important; margin:30px 1% !important;}
	.item_list > tbody > tr > td:nth-child(2n) {display:none;}
	.item_box {width:100% !important;}
	.item_box > tbody > tr > .item_width {width: 100% !important;}
	.item_box > tbody > tr > td {width:100% !important;}
	.item_box > tbody > tr > .item_width a {width: 100% !important;}
	.item_box > tbody > tr > td > img {width:100% !important; }
	.item_tit {font-size:16px !important;}
	.item_price {font-size: 14px !important;}
}

@media (max-width: 960px) {
	.item_list > tbody > tr > td {width: 31.333%; !important; text-align:center;}
}

@media (max-width: 840px) {
	.item_list > tbody > tr > td {width: 48%; !important;}
}

@media (max-width:706px) {
	/* .item_list > tbody > tr > td {width: 98%; !important;} */
}
</style>
<script>
	$(function(){
		$(".item_width").height($(".item_width").width())
		$(".item_width a").height($(".item_width a").width())

		$(window).resize(function(){
			$(".item_width").height($(".item_width").width())
			$(".item_width a").height($(".item_width a").width())
		})
	})
</script>




<?
	$fName = 'frm01';
	include '../module/pageNum.php';
?>