<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	if($GBL_MTYPE=='C'){
		//쿼리조건
		$query_ment = "where userid  ='$GBL_USERID'";

	}else{
		//쿼리조건
		$query_ment = "where uid > 0";


	}



	if($f_reg)			$query_ment .= " and reg_date like '%$f_reg%'";
	if($f_oname)		$query_ment .= " and oname like '%$f_oname%'";
	if($f_userid)			$query_ment .= " and userid like '%$f_userid%'";

	if($f_paymode)	$query_ment .= " and paymode='$f_paymode'";
	if($f_status)			$query_ment .= " and status='$f_status'";

	//날짜검색
	if($f_sy){
		if(!$f_ey)	$f_ey = date('Y');
		if(!$f_em)	$f_em = date('m');
		if(!$f_ed)	$f_ed = date('d');

		$start_date = mktime(0,0,0,$f_sm,$f_sd,$f_sy);
		$end_date = mktime(23,59,59,$f_em,$f_ed,$f_ey);

		$query_ment .= " and (reg_date>='$start_date' and reg_date<='$end_date')";
	}

	//판매자검색
	if($f_manager)		$query_ment .= " and p.manager='$f_manager'";


	$sort_ment = "order by uid desc";



	$query = "select * from ks_order $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from ks_order $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);

?>

<script language='javascript'>
function All_del(){

    var chk = document.getElementsByName('chk[]');
	var isChk = false;

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked)	isChk = true; 
    }

	if(!isChk){
		alert('삭제하실 주문내역을 선택하여 주십시오.');
		return;
	}

	if(confirm('선택하신 주문내역을 삭제하시겠습니까?')){

		form = document.frm01;

		form.type.value = 'all_del'
		form.action = 'proc.php';
		form.submit();

	}

}


function viewer(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function ifra_xls(){
    var chk = document.getElementsByName('chk[]');
	var isChk = false;

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked)	isChk = true; 
    }

	if(!isChk){
		alert(' 주문내역을 선택하여 주십시오.');
		return;
	}

	form = document.frm01;
//	form.target = 'ifra_xls';
	form.action = 'excel.php';
	form.submit();
}
</script>

<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>


<table width="100%" border="0" cellspacing="0" cellpadding="0" style='margin-top:10px;'>
	<tr>
		<td>
		<?
			include 'search.php';
		?>
		</td>
	</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style='margin-top:10px;'>
	<tr>
		<td height='30'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td width='50%'><a href="javascript:All_chk_btn('all_chk','chk[]')"><img src='/images/common/allselect.gif' align='absmiddle'></a> <a href="javascript:All_del()"><img src='/images/common/alldelete.gif' align='absmiddle'></a></td>
				<?
					if($_SERVER[REMOTE_ADDR] == '1.217.114.251'){
				?>
					<td width='50%' align='right'><a href="javascript:ifra_xls();"><img src='/images/xls_down.gif'></a></td>
				<?
					}
				?>
				</tr>
			</table>
		</td>
	</tr>

	<tr>						
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class='gTable2'>
				<tr align='center'>
					<th width="5%"><input name='all_chk' type='checkbox' onclick="All_chk('all_chk','chk[]');"></td>
					<th width="5%" class='w'>번호</td>
					<th width="10%" class='w'>이미지</td>
					<th width="25%" class='w'>주문상품</td>
					<th width="15%" class='w'>주문자</td>
					<th width="10%" class='w'>결제방법</td>
					<th width="9%" class='w'>결제금액</td>
					<th width="9%" class='w'>주문상태</td>
					<th width="14%" class='w'>주문일시</td>
				</tr>



<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$userid = $row["userid"];
		$oname = $row["oname"];
		$paymode = $row["paymode"];
		$amt = $row["amt"];
		$coupon = $row["coupon"];
		$coupon_price = $row["coupon_price"];
		$point = $row["point"];

		$status = $row["status"];
		$reg_date = $row["reg_date"];
		$reg_dateTxt = date("Y-m-d H:i:s",$reg_date);

		$sql01 = "select * from ks_order_list where userid='$userid' and code='$reg_date' order by uid";
		$result01 = mysql_query($sql01);
		$num01 = mysql_num_rows($result01);

		$imgTag = '';

		if($num01){
			$row01 = mysql_fetch_array($result01);
			$ptitle = $row01['ptitle'];
			$pid = $row01['pid'];

			if($num01 > 1){
				$num01 -= 1;
				$title_txt = $ptitle.'외 '.$num01.'건';
			}else{
				$title_txt = $ptitle;
			}

			//제품이미지 가져오기
			$sql02 = "select * from ks_product where uid='$pid'";
			$result02 = mysql_query($sql02);
			$row02 = mysql_fetch_array($result02);
			$upfile01 = $row02["upfile01"];	//이미지

			if($upfile01){
				$imgFile = $path.'thumb_'.$upfile01;
				if(!is_file($imgFile))	$imgFile = $path.$upfile01;
				$resize = Util::AutoImgSize($imgFile,120,146);
				$imgTag = "<img src='$imgFile' $resize>";
			}


		}

		if($userid == '_guest'){
			$css = "style='color:#de712e;'";
			$useridTxt = '(비회원)';
		}else{
			$css = "style='color:#52809a;'";
			$useridTxt = '('.$userid.')';
		}

		$amtTxt = number_format($amt);


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


?>
				<tr style='cursor:hand;' align='center' height='30' onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'"> 
					<td><input name='chk[]' type='checkbox' value='<?=$uid?>'></td>
					<td onclick="viewer('<?=$uid?>')"><?=$i?></td>
					<td onclick="viewer('<?=$uid?>')"><?=$imgTag?></td>
					<td onclick="viewer('<?=$uid?>')" style='line-height:20px;'><?=$reg_date?><br><?=$title_txt?></td>
					<td onclick="viewer('<?=$uid?>')" <?=$css?>><?=$oname?><br><?=$useridTxt?></td>
					<td onclick="viewer('<?=$uid?>')"><?=$payTxt?></td>
					<td onclick="viewer('<?=$uid?>')"><?=$amtTxt?></td>
					<td onclick="viewer('<?=$uid?>')"><?=$status?></td>
					<td onclick="viewer('<?=$uid?>')"><?=$reg_dateTxt?></td>
				</tr>
<?
		$line_num++;
		$i--;
	}

}else{
?>
				<tr> 
					<td colspan="9" align='center' height='50'>접수된 주문내역이 없습니다</td>
				</tr>
<?
}
?>
			</table>									
		</td>
	</tr>
</table>



</form>


<?
	$fName = 'frm01';
	include '/home/websp/www/module/pageNum.php';
?>




<iframe name='ifra_xls' src='about:blank' width='0' height='0' frameborder='0' scrolling='no'></iframe>