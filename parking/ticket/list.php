<?
	if(!$f_rDate01)		$f_rDate01 = date('Y-m-d');
	if(!$f_rDate02)		$f_rDate02 = date('Y-m-d');

	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//검색기간
	$f_sArr = explode('-',$f_rDate01);
	$start_date = mktime(0,0,0,$f_sArr[1],$f_sArr[2],$f_sArr[0]);
	$f_eArr = explode('-',$f_rDate02);
	$end_date = mktime(23,59,59,$f_eArr[1],$f_eArr[2],$f_eArr[0]);

	//쿼리조건
	$query_ment = " where rTime>='$start_date' and rTime<='$end_date'";

	if($f_code)		$query_ment .= " and code like '%$f_code%'";
	if($f_name)		$query_ment .= " and name like '%$f_name%'";
	if($f_guest)		$query_ment .= " and guest like '%$f_guest%'";
	if($f_carNum)	$query_ment .= " and carNum like '%$f_carNum%'";

	$sort_ment = "order by uid desc";



	$query = "select * from ks_ticket $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from ks_ticket $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);
?>

<script language='javascript'>
function goWrite(){
	form = document.frm01;

	form.type.value = 'write';
	form.action = '<?=$PHP_SELF?>';
	form.target = '';
	form.submit();
}

function goViewer(uid){
	form = document.frm01;

	form.type.value = 'view';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.target = '';
	form.submit();
}

function ifra_xls(){
	form = document.frm01;
	form.type.value = '';
	form.target = '';
	form.action = 'excel.php';
	form.submit();
}
</script>

<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>

<?
	include 'search.php';
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style='margin-top:10px;'>
	<tr>
		<td style='padding-bottom:5px;'><a href="javascript:ifra_xls();" class="cbtn small green">엑셀변환</td>
	</tr>
	<tr>						
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable1 fix'>
				<tr>
					<th width="10%">면제권</th>
					<th width="15%">일련번호</th>
					<th width="15%">방문자</th>
					<th width="15%">차량번호</th>
					<th width="*">사유</th>
					<th width="15%">등록자</th>
					<th width="13%">등록일시</th>
				</tr>



<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$code = $row['code'];
		$name = $row["name"];
		$guest = $row['guest'];
		$carNum = $row['carNum'];
		$ment = $row['ment'];
		$rDate = $row['rDate'];
		$rArr = explode(' ',$rDate);
		$rDateTxt = $rArr[0].'<br>'.$rArr[1];
?>
				<tr class='grayLine'>
					<td><a href="javascript://" onclick="window.open('receipt.php?uid=<?=$uid?>','ieprint','width=500,height=500,scrollbars=yes','_blank')" class='small cbtn blue'>면제권출력</a></td>
					<td onclick="goViewer('<?=$uid?>');"><b><?=$code?></b></td>
					<td onclick="goViewer('<?=$uid?>');"><?=$guest?></td>
					<td onclick="goViewer('<?=$uid?>');"><?=$carNum?></td>
					<td onclick="goViewer('<?=$uid?>');"><?=$ment?></td>
					<td onclick="goViewer('<?=$uid?>');"><?=$name?></td>
					<td onclick="goViewer('<?=$uid?>');"><?=$rDateTxt?></td>
				</tr>
<?
		$i--;
	}
}else{
?>
				<tr> 
					<td colspan="8" align='center' height='50'>등록된 면제권이 없습니다.</td>
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
	include '../../module/TableFix.php';
?>