<?	
	if($uid){
		$sql = "select * from tb_member where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$mtype = $row['mtype'];
		$name = $row["name"];
		$userid = $row['userid'];
		$reg_date = $row['reg_date'];
		$reg_dateTxt = date('Y-m-d H:i:s',$reg_date);

		$mArr = Util::ManagerType($mtype);

		$mtxt = '';

		if(in_array('C',$mArr))	$mtxt = '대관관리';
		if(in_array('B',$mArr)){
			if($mtxt)	$mtxt .= ', ';
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
	}
?>

<script language='javascript'>
function check_form(){
	form = document.frm01;
	form.type.value = 'edit';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reg_list(){
	form = document.frm01;
	form.type.value = 'list';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function checkDel(){
	GblMsgConfirmBox("해당 담당자 정보를 삭제하시겠습니까?\n삭제후에는 복구가 불가능합니다.","checkDelOk()");
}

function checkDelOk(){
	form = document.frm01;
	form.type.value = 'del';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}
</script>

<form name='frm01' action="proc.php" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>



<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
	<tr>
		<th><?=$ico01?> 권한</th>
		<td><?=$mtxt?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 성명</th>
		<td><?=$name?></td>
	</tr>

	<tr>
		<th width='15%'><?=$ico01?> 아이디</th>
		<td width='85%'><?=$userid?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 등록일시</th>
		<td><?=$reg_dateTxt?></td>
	</tr>
</table>


<table cellpadding='0' cellspacing='0' border='0' width='100%' style='margin-top:20px;'>
	<tr>
		<td width='30%'><a href="javascript:checkDel();" class='big cbtn blood'>삭제하기</a></td>
		<td width='40%' align='center'>
			<a href="javascript:check_form();" class='big cbtn blue'>수정하기</a>&nbsp;&nbsp;
			<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
		</td>
		<td width='30%'></td>
	</tr>
</table>


</form>