<script language='javascript'>
function go_search(){
	form = document.frm01;
	form.type.value = '';
	form.record_start.value = '';
	form.taget = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reset_search(){
	form = document.frm01;

	form.f_enable[0].checked = true;
	form.f_mtype[0].checked = true;
	form.f_userid.value = '';
	form.f_name.value = '';

	form.record_start.value = '';
	form.taget = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}


</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
				<tr>
					<th>상태</th>
					<td>
						<input type='radio' name='f_enable' value='' <?if($f_enable == ''){echo 'checked';}?>> <span class='ico10' style='display:inline !important;'>전체</span>&nbsp;&nbsp;
						<input type='radio' name='f_enable' value='1' <?if($f_enable == '1'){echo 'checked';}?>> <span class='ico03' style='display:inline !important;'>승인</span>&nbsp;&nbsp;
						<input type='radio' name='f_enable' value='2' <?if($f_enable == '2'){echo 'checked';}?>> <span class='ico09' style='display:inline !important;'>대기</span>
					</td>
					<th>구분</th>
					<td>
						<input type='radio' name='f_mtype' value='' <?if($f_mtype == ''){echo 'checked';}?>> <span class='ico10' style='display:inline !important;'>전체</span>&nbsp;&nbsp;
						<input type='radio' name='f_mtype' value='M' <?if($f_mtype == 'M'){echo 'checked';}?>> <span class='ico05' style='display:inline !important;'>일반회원</span>&nbsp;&nbsp;
						<input type='radio' name='f_mtype' value='C' <?if($f_mtype == 'C'){echo 'checked';}?>> <span class='ico02' style='display:inline !important;'>기업회원</span>
					</td>
				</tr>
				<tr>
					<th width='17%'>아이디</th>
					<td width='33%'><input type='text' name='f_userid' style='width:190px;' value='<?=$f_userid?>'></td>
					<th width='17%'>닉네임</th>
					<td width='33%'><input type='text' name='f_name' style='width:190px;' value='<?=$f_name?>'></td>
				</tr>
			</table>
		</td>
	</tr>						
	<tr>
		<td height="35" align='center'><a href='javascript:go_search();'><img src="/images/common/search.gif" alt="검색"></a> <a href='javascript:reset_search();'><img src="/images/common/reset.gif" alt="초기화"></a></td>
	</tr>						
</table>

<br><br>