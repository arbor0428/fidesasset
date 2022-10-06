<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "where mtype!='A'";

	if($f_enable == '1')		$query_ment .= " and enable='1'";
	elseif($f_enable == '2')	$query_ment .= " and enable=''";

	if($f_mtype)		$query_ment .= " and mtype='$f_mtype'";
	if($f_userid)		$query_ment .= " and userid like '%$f_userid%'";
	if($f_name)		$query_ment .= " and name like '%$f_name%'";

	$sort_ment = "order by uid desc";



	$query = "select * from tb_member $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from tb_member $query_ment $sort_ment limit $record_start, $record_count";

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
</script>

<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style='margin-top:10px;'>
	<tr>
		<td style='padding-bottom:5px;'><a href="javascript:goWrite();" class="cbtn small blue">담당자 등록</td>
	</tr>
	<tr>						
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable1 fix'>
				<tr>
					<th width="10%">번호</th>
					<th width="20%">권한</th>
					<th width="25%">성명</th>
					<th width="25%">아이디</th>
					<th width="20%">등록일시</th>
				</tr>



<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$mtype = $row['mtype'];
		$name = $row["name"];
		$userid = $row['userid'];
		$reg_date = $row['reg_date'];
		$reg_dateTxt = date('Y-m-d H:i:s',$reg_date);

		$mArr = Util::ManagerType($mtype);

		$mtxt = '';

		if(in_array('C',$mArr))	$mtxt = '대관관리';
		if(in_array('B',$mArr)){
			if($mtxt)	$mtxt .= '<br>';
			$mtxt .= '공연관리';
		}
		if(in_array('D',$mArr)){
			if($mtxt)	$mtxt .= '<br>';
			$mtxt .= '게시물관리';
		}
		if(in_array('P',$mArr)){
			if($mtxt)	$mtxt .= '<br>';
			$mtxt .= '프로그램관리';
		}
		if(in_array('R',$mArr)){
			if($mtxt)	$mtxt .= '<br>';
			$mtxt .= '주차관리';
		}

?>
				<tr onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'" style='cursor:pointer;' onclick="goViewer('<?=$uid?>');">
					<td><?=$i?></td>
					<td><?=$mtxt?></td>
					<td><?=$name?></td>
					<td><?=$userid?></td>
					<td><?=$reg_dateTxt?></td>
				</tr>
<?
		$i--;
	}
}else{
?>
				<tr> 
					<td colspan="5" align='center' height='50'>담당자 정보가 없습니다.</td>
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