<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "where uid > 0";


	if($f_reg)	$query_ment .= " and reg_date like '%$f_reg%'";
	if($f_oname)	$query_ment .= " and oname like '%$f_oname%'";
	if($f_userid)	$query_ment .= " and userid like '%$f_userid%'";

	if($f_paymode)	$query_ment .= " and paymode='$f_paymode'";
	if($f_status)	$query_ment .= " and status='$f_status'";

	//날짜검색
	if($f_sy){
		$start_date = mktime(0,0,0,$f_sm,$f_sd,$f_sy);
		$end_date = mktime(23,59,59,$f_em,$f_ed,$f_ey);

		$query_ment .= " and (reg_date>='$start_date' and reg_date<='$end_date')";
	}


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
					<td width='50%' align='right'><a href="javascript:openCenterWin('config.php','','600','200','','')"><img src='../sms/img/set_btn.jpg' align='absmiddle'></a></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>						
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="3">
				<tr> 
					<td bgcolor="cccccc"  height="2" colspan="9"></td>
				</tr>
				<tr bgcolor="676767" align='center'>
					<td width="5%"><input name='all_chk' type='checkbox' onclick="All_chk('all_chk','chk[]');"></td>
					<td width="5%" class='w'>번호</td>
					<td width="10%" class='w'>주문번호</td>
					<td width="25%" class='w'>주문상품</td>
					<td width="15%" class='w'>주문자</td>
					<td width="10%" class='w'>결제방법</td>
					<td width="9%" class='w'>결제금액</td>
					<td width="9%" class='w'>주문상태</td>
					<td width="14%" class='w'>주문일시</td>
				</tr>
				<tr> 
					<td bgcolor="cccccc"  style='padding:1px 0px 0px 0px;' colspan="9"></td>
				</tr>



<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$userid = $row["userid"];
		$cart_idx = $row["cart_idx"];
		$oname = $row["oname"];
		$paymode = $row["paymode"];
		$tot_price = $row["tot_price"];			//합계금액(상품금액 + 배송비)
		$upoint = $row["upoint"];					//주문시 사용한 적립금
		$result_price = $row["result_price"];		//실제결제금액(합계금액 - 사용적립금)
		$status = $row["status"];
		$reg_date = $row["reg_date"];
		$reg_date_txt = date("Y-m-d H:i:s",$reg_date);

		//주문한 상품의수와 첫번째 상품명을 가져온다.
		$pid = explode(',',$cart_idx);
		$onum = count($pid);	//주문한 상품 종류의 수

		$sql01 = "select title from ks_order_list where userid='$userid' and code='$reg_date'";
		$result01 = mysql_query($sql01);
		$num01 = mysql_num_rows($result01);

		if($num01){
			$title = mysql_result($result01,0,0);

			if($onum > 1){
				$onum -= 1;
				$title_txt = $title.'외 '.$onum.'건';
			}else{
				$title_txt = $title;
			}

		}else{
			$title_txt = "<font color='#de712e'>삭제 상품</font>";
		}

		if($userid == '_guest'){
			$css = "style='color:#de712e;'";
			$useridTxt = '(비회원)';
		}else{
			$css = "style='color:#52809a;'";
			$useridTxt = '('.$userid.')';
		}


		if($upoint)	$tot_priceTxt = "<strike><font color='#52809a'>".number_format($tot_price)."</font></strike><br>";
		else			$tot_priceTxt = '';

		$resulttxt = number_format($result_price);


?>
				<tr style='cursor:hand;' align='center' height='30' onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'"> 
					<td><input name='chk[]' type='checkbox' value='<?=$uid?>'></td>
					<td onclick="viewer('<?=$uid?>')"><?=$i?></td>
					<td onclick="viewer('<?=$uid?>')"><?=$reg_date?></td>
					<td onclick="viewer('<?=$uid?>')"><?=$title_txt?></td>
					<td onclick="viewer('<?=$uid?>')" <?=$css?>><?=$oname?><br><?=$useridTxt?></td>
					<td onclick="viewer('<?=$uid?>')"><?=$paymode?></td>
					<td onclick="viewer('<?=$uid?>')"><?=$tot_priceTxt?><?=$resulttxt?></td>
					<td onclick="viewer('<?=$uid?>')"><?=$status?></td>
					<td onclick="viewer('<?=$uid?>')"><?=$reg_date_txt?></td>
				</tr>
				<tr> 
					<td bgcolor="cccccc"  style='padding:1px 0px 0px 0px;' colspan="9"></td>
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













						<!--버튼-->
<table border="0" align="center" cellpadding="1" cellspacing="0" style='margin-top:15px;'>
	<tr>

<?
if($total_record != '0'){
	if($total_record > $record_count){
		
		echo ("<td>");

		if($current_page * $record_count > $record_count * $link_count) {
			$pre_group_start = ($group * $record_count * $link_count) - $record_count;
			echo("<a href=javascript:pageing('frm01','$pre_group_start');><img src='/images/common/prev2.gif'></a>");
		}else{
			echo("<img src='/images/common/prev2.gif'>");
		}

		echo ("</td>");



		echo ("<td>");

		if($total_page > 1 && ($record_start !=0 )) {
			$pre_page_start = $record_start - $record_count;
			echo("<a href=javascript:pageing('frm01','$pre_page_start');><img src='/images/common/prev1.gif'></a>");
		}else{
			echo ("<img src='/images/common/prev1.gif'>");
		}

		echo ("</td><td width='5'></td>");



		echo ("<td>");

		for($i=0; $i<$link_count; $i++){
			$input_start = ($group * $link_count + $i) * $record_count; 

			$link = ($group * $link_count + $i) + 1;

			if($input_start < $total_record) {
				if($input_start != $record_start) {
					echo("<a onclick=pageing('frm01','$input_start'); style='cursor:hand'>$link</a>&nbsp;&nbsp;");
				} else {
					echo("<b>$link</b>&nbsp;&nbsp;");
				}
			}
		}

		echo ("</td><td width='5'></td>");



		echo ("<td>");

		if($total_page > 1 && ($record_start != ($total_page * $record_count - $record_count))) {
			$next_page_start = $record_start + $record_count;
			echo("<a href=javascript:pageing('frm01','$next_page_start');><img src='/images/common/next1.gif'></a>");
		}else{
			echo ("<img src='/images/common/next1.gif'>");
		}

		echo ("</td>");



		echo ("<td>");

		if($total_record > (($group + 1) * $record_count * $link_count)) {
			$next_group_start = ($group + 1) * $record_count* $link_count;
			echo("<a href=javascript:pageing('frm01','$next_group_start');><img src='/images/common/next2.gif'></a>");
		}else{
			echo ("<img src='/images/common/next2.gif'>");
		}

		echo ("</td>");



		  
	}else{
		echo "<td><b>1</b></td>";
	}
}
?>

	</tr>
</table>


						<!--/버튼-->


</form>