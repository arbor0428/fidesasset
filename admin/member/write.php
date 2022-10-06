<?	
	include '../../module/Calendar.php';


	if($type=='edit' && $uid){
		$sql = "select * from tb_member where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$mtype = $row['mtype'];
		$userid = $row['userid'];
		$name = $row['name'];
		$pwd = $row["pwd"];

		$mArr = Util::ManagerType($mtype);

		if(in_array('C',$mArr))	$chk01 = 'checked';
		if(in_array('B',$mArr))	$chk02 = 'checked';
		if(in_array('D',$mArr))	$chk03 = 'checked';
		if(in_array('P',$mArr))	$chk04 = 'checked';
		if(in_array('R',$mArr))	$chk05 = 'checked';
	}
?>

<script language='javascript'>
function check_form(){
	form = document.frm01;

	if(form.mChk01.checked == false && form.mChk02.checked == false && form.mChk03.checked == false && form.mChk04.checked == false && form.mChk05.checked == false){
		GblMsgBox("담당자 권한을 선택해 주십시오.","");
		return;
	}

	if(isFrmEmptyModal(form.name,"성명을 입력해 주십시오."))	return;

	type = form.type.value;

	if(type == 'write'){
		if(isFrmEmptyModal(form.userid,"아이디를 입력해 주십시오."))	return;		
	}

	if(isFrmEmptyModal(form.pwd,"비밀번호를 입력해 주십시오."))	return;

	PWD = form.pwd.value;
	if(PWD.length < 4 || PWD.length > 12){
		GblMsgBox('비밀번호는 4~12자 이내입니다','');
		form.pwd.focus();
		return;
	}
	
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}
function reg_list(){
	form = document.frm01;
	form.type.value = 'list';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

</script>


<form name='frm01' action="proc01.php" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>


<!-- 검색관련 -->
<input type='hidden' name='f_enable' value='<?=$f_enable?>'>
<input type='hidden' name='f_mtype' value='<?=$f_mtype?>'>
<input type='hidden' name='f_userid' value='<?=$f_userid?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<!-- /검색관련 -->


<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
	<tr>
		<th><?=$ico01?> 권한</th>
		<td style='padding-top:15px;'>
			<div style='float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="C" id="mChk01" name="mChk01" <?=$chk01?>>
					<label for="mChk01"></label>
				</div>
				<p style='margin:0 0 0 30px;'>대관관리</p>
			</div>

			<div style='margin-left:30px;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="B" id="mChk02" name="mChk02" <?=$chk02?>>
					<label for="mChk02"></label>
				</div>
				<p style='margin:0 0 0 30px;'>공연관리</p>
			</div>

			<div style='margin-left:30px;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="D" id="mChk03" name="mChk03" <?=$chk03?>>
					<label for="mChk03"></label>
				</div>
				<p style='margin:0 0 0 30px;'>게시판관리</p>
			</div>

			<div style='margin-left:30px;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="P" id="mChk04" name="mChk04" <?=$chk04?>>
					<label for="mChk04"></label>
				</div>
				<p style='margin:0 0 0 30px;'>프로그램관리</p>
			</div>

			<div style='margin-left:30px;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="R" id="mChk05" name="mChk05" <?=$chk05?>>
					<label for="mChk05"></label>
				</div>
				<p style='margin:0 0 0 30px;'>주차관리</p>
			</div>
		</td>
	</tr>

	<tr>
		<th><?=$ico01?> 성명</th>
		<td><input type='text' name='name' value="<?=$name?>" style='width:200px;'></td>
	</tr>

	<tr>
		<th width='15%'><?=$ico01?> 아이디</th>
		<td width='85%'>
		<?
			if($type == 'write'){
		?>
			<input type='text' name='userid' value='' style='width:200px;'>
		<?
			}else{
				echo $userid;
			}
		?>
		</td>
	</tr>

	<tr>
		<th><?=$ico01?> 비밀번호</th>
		<td><input type='password' name='pwd' value="<?=$pwd?>" style='width:200px;'></td>
	</tr>
</table>

</form>

<table cellpadding='0' cellspacing='0' border='0' width='100%' style='margin-top:20px;'>
	<tr>
		<td align='center'>
		<?
			if($type == 'write'){
		?>
			<a href="javascript:check_form();" class='big cbtn blue'>등록</a>&nbsp;&nbsp;
			<a href="javascript:reg_list();" class='big cbtn black'>취소</a>
		<?
			}else{
		?>
			<a href="javascript:check_form();" class='big cbtn blue'>정보수정</a>&nbsp;&nbsp;
			<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
		<?
			}
		?>
		</td>
	</tr>
</table>
