<?	
	if($uid){
		$sql = "select * from ks_ticket where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$userid = $row['userid'];
		$name = $row['name'];
		$guest = $row['guest'];
		$carNum = $row['carNum'];
		$code = $row['code'];
		$ment = $row['ment'];
		$rDate = $row["rDate"];
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
	GblMsgConfirmBox("해당 면제권을 삭제하시겠습니까?\n삭제후에는 복구가 불가능합니다.","checkDelOk()");
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

<!-- 검색관련 -->
<input type='hidden' name='f_code' value='<?=$f_code?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_guest' value='<?=$f_guest?>'>
<input type='hidden' name='f_carNum' value='<?=$f_carNum?>'>
<input type='hidden' name='f_rDate01' value='<?=$f_rDate01?>'>
<input type='hidden' name='f_rDate02' value='<?=$f_rDate02?>'>
<!-- /검색관련 -->

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
	<tr>
		<th width='20%'><?=$ico01?> 일련번호</th>
		<td width='80%'><b><?=$code?></b></td>
	</tr>

	<tr>
		<th><?=$ico01?> 등록자</th>
		<td><?=$name?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 방문자</th>
		<td><?=$guest?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 차량번호</th>
		<td><?=$carNum?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 사유</th>
		<td><?=$ment?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 등록일시</th>
		<td><?=$rDate?></td>
	</tr>
</table>

<?
	if($userid == $GBL_USERID || $GBL_MTYPE == 'A'){
?>
<table cellpadding='0' cellspacing='0' border='0' width='100%' style='margin-top:20px;'>
	<tr>
		<td width='30%'><a href="javascript:checkDel();" class='big cbtn blood'>삭제하기</a></td>		
		<td width='40%' align='center'>
			<a href="javascript:check_form();" class='big cbtn blue'>수정하기</a>&nbsp;&nbsp;
			<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
		</td>
		<td width='30%' align='right'></td>
	</tr>
</table>
<?
	}else{
?>
<table cellpadding='0' cellspacing='0' border='0' width='100%' style='margin-top:20px;'>
	<tr>
		<td align='center'><a href="javascript:reg_list();" class='big cbtn black'>목록보기</a></td>
	</tr>
</table>
<?
	}
?>


</form>