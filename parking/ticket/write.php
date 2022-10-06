<?	
	if($type=='edit' && $uid){
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

	}else{
		$userid = $GBL_USERID;
		$name = $GBL_NAME;
	}
?>

<script language='javascript'>
function trimChk(obj){
	str = $('#carNum').val().replace(/\s/gi, "");
	$('#carNum').val(str);
}

function check_form(){
	form = document.frm01;

	if(isFrmEmptyModal(form.guest,"방문자를 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.carNum,"차량번호를 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.ment,"사유를 입력해 주십시오."))	return;

	carNum = $('#carNum').val().replace(/\s/gi, "");
	$('#carNum').val(carNum);

	type = $('#type').val();
	uid = $('#uid').val();

	//차량번호 중복확인
	$.post('carNumChk.php',{'carNum':carNum,'type':type,'uid':uid}, function(res){
		if(res == 'ok'){
			form.target = 'ifra_gbl';
			form.action = 'proc.php';
			form.submit();

		}else if(res == 'overlap1'){
			GblMsgConfirmBox("금일 동일한 차량번호가 등록되어있습니다.\n그래도 등록하시겠습니까?","saveOk()");
			return;

		}else if(res == 'overlap2'){
			GblMsgConfirmBox("등록일에 동일한 차량번호가 등록되어있습니다.\n그래도 등록하시겠습니까?","saveOk()");
			return;

		}else{
			GblMsgBox('error','');
			return;
		}
	});
}

function saveOk(){
	form = document.frm01;
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


<form name='frm01' method='post'>
<input type='hidden' name='type' id='type' value='<?=$type?>'>
<input type='hidden' name='uid' id='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='userid' value='<?=$userid?>'>
<input type='hidden' name='name' value='<?=$name?>'>


<!-- 검색관련 -->
<input type='hidden' name='f_code' value='<?=$f_code?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_guest' value='<?=$f_guest?>'>
<input type='hidden' name='f_carNum' value='<?=$f_carNum?>'>
<input type='hidden' name='f_rDate01' value='<?=$f_rDate01?>'>
<input type='hidden' name='f_rDate02' value='<?=$f_rDate02?>'>
<!-- /검색관련 -->


<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
<?
	if($type == 'edit'){
?>
	<tr>
		<th><?=$ico01?> 일련번호</th>
		<td><?=$code?></td>
	</tr>
<?
	}
?>
	<tr>
		<th width='20%'><?=$ico01?> 등록자</th>
		<td width='80%'><?=$name?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 방문자</th>
		<td><input type='text' name='guest' id='guest' value="<?=$guest?>" style='width:200px;'></td>
	</tr>

	<tr>
		<th><?=$ico01?> 차량번호</th>
		<td><input type='text' name='carNum' id='carNum' value="<?=$carNum?>" style='width:200px;' onkeyup="trimChk(this);"></td>
	</tr>

	<tr>
		<th><?=$ico01?> 사 유</th>
		<td><input type='text' name='ment' value="<?=$ment?>" style='width:100%;'></td>
	</tr>
<?
	if($type == 'edit'){
?>
	<tr>
		<th><?=$ico01?> 등록일시</th>
		<td><?=$rDate?></td>
	</tr>
<?
	}
?>
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
