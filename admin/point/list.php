<script language='javascript'>
function All_del(){

    var chk = document.getElementsByName('chk[]');
	var isChk = false;

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked)	isChk = true; 
    }

	if(!isChk){
		alert('삭제하실 적립금 내역을 선택하여 주십시오.');
		return;
	}

	if(confirm('선택하신 적립금 내역을 삭제하시겠습니까?')){

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

	if($f_userid)	$query_ment .= " and userid like '%$f_userid%'";
	if($f_ptype)	$query_ment .= " and ptype='$f_ptype'";

	//날짜검색
	if($f_sy){
		$start_date = mktime(0,0,0,$f_sm,$f_sd,$f_sy);
		$end_date = mktime(23,59,59,$f_em,$f_ed,$f_ey);

		$query_ment .= " and (reg_date>='$start_date' and reg_date<='$end_date')";
	}


	$sort_ment = "order by uid desc";



	$query = "select * from ks_point $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from ks_point $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style='margin-top:10px;'>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr height='30'>
					<td><a href="javascript:All_chk_btn('all_chk','chk[]')"><img src='/images/common/allselect.gif' align='absmiddle'></a> <a href="javascript:All_del()"><img src='/images/common/alldelete.gif' align='absmiddle'></a> * 내역을 삭제할 경우 <font color='#52809a'><b>[적립]</b></font> 또는 <font color='#de712e'><b>[사용]</b></font>된 적립금은 취소처리됩니다.</td>
					<td align='right'><!--font color='#de712e'><b>- 사용</b></font>&nbsp;&nbsp;<font color='#52809a'><b>- 적립</b></font--></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>						
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class='gTable'>

				<tr>
					<th width="5%"><input name='all_chk' type='checkbox' onclick="All_chk('all_chk','chk[]');"></td>
					<th width="6%" class='w'>번호</td>
					<th width="10%" class='w'>아이디</td>
					<th width="13%" class='w'>유형</td>
					<th width="18%" class='w'>적립금</td>
					<th width="36%" class='w'>내용</td>
					<th width="12%" class='w'>적용일시</td>
				</tr>


<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$userid = $row["userid"];
		$ptype = $row["ptype"];
		$point = $row["point"];
		$ment = $row["ment"];
		$reg_date = $row["reg_date"];

		$pointtxt = number_format($point);
		$reg_date_txt = date("Y-m-d H:i:s",$reg_date);


		if($ptype == 'P'){
			$sign = '+';
			$fcolor = '#52809a';
			$msg = '쿠폰차액적립';

		}elseif($ptype == 'R'){
			$sign = '+';
			$fcolor = '#52809a';
			$msg = '쿠폰등록';

		}elseif($ptype == 'O'){
			$sign = '+';
			$fcolor = '#52809a';
			$msg = '주문적립';

		}elseif($ptype == 'U'){
			$sign = '-';
			$fcolor = '#de712e';
			$msg = '주문사용';
		}

?>
				<tr align='center' height='30' onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'"> 
					<td><input name='chk[]' type='checkbox' value='<?=$uid?>'></td>
					<td><?=$i?></td>
					<td><?=$userid?></td>
					<td><?=$msg?></td>
					<td><font color='<?=$fcolor?>'><?=$sign?><?=$pointtxt?></font></td>
					<td><?=$ment?></td>
					<td><?=$reg_date_txt?></td>
				</tr>
<?
		$line_num++;
		$i--;
	}

}else{
?>
				<tr> 
					<td colspan="7" align='center' height='50'>적립금 내역이 없습니다</td>
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
	include '../../module/pageNum.php';
?>