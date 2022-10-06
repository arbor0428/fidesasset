
<script language='javascript'>
function go_search(){
	form = document.frm01;
	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reset_search(){
	form = document.frm01;

	cade01 = form.cade01.value;

	if(cade01 == '여성한복'){
		form.f_c02a.checked = false;
		form.f_c02b.checked = false;
		form.f_c02c.checked = false;
		form.f_c02d.checked = false;
	}

	form.f_title.value = '';
	form.f_enable01.checked = false;
	form.f_enable02.checked = false;

	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}


</script>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
				<tr>
					<th>상품명</th>
					<td><input type='text' name='f_title' style='width:216px;' value='<?=$f_title?>' onkeypress="if(event.keyCode==13){go_search();}"></td>
					<th>상태</th>
					<td>
						<input type='checkbox' name='f_enable01' value='1' <?if($f_enable01) echo 'checked';?>>판매중&nbsp;
						<input type='checkbox' name='f_enable02' value='1' <?if($f_enable02) echo 'checked';?>>판매중지
					</td>
				</tr>
			</table>
		</td>
	</tr>						
	<tr>
		<td height="35" align='center'><a href='javascript:go_search();'><img src="/images/common/search.gif" alt="검색"></a> <a href='javascript:reset_search();'><img src="/images/common/reset.gif" alt="초기화"></a></td>
	</tr>						
</table>

<br><br>