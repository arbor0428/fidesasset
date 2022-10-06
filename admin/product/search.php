
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

	form.f_cade01.value = '';
	form.f_title.value = '';

	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}


</script>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
				<tr>					<th width='17%'>구분</td>
					<td width='33%' class='tab'>
						<select name='f_cade01'>
							<option value=''>==</option>
							<option value='일반의약품' <?if($f_cade01=='일반의약품'){echo 'selected';}?>>일반의약품</option>
							<option value='전문의약품' <?if($f_cade01=='전문의약품'){echo 'selected';}?>>전문의약품</option>
							<option value='건강기능식품' <?if($f_cade01=='건강기능식품'){echo 'selected';}?>>건강기능식품</option>
							<option value='기타' <?if($f_cade01=='기타'){echo 'selected';}?>>기타</option>
						</select>
					</td>
					<th width='17%'>제품명</td>
					<td class='tab' width='33%'><input type='text' name='f_title' style='width:100%;' value='<?=$f_title?>'></td>

				</tr>

			</table>
		</td>
	</tr>							
	<tr>
		<td align='center' style="padding:10px 0 50px 0;">
			<a href='javascript:go_search();' class='small cbtn blue'>검색</a>
			<a href='javascript:reset_search();' class='small cbtn black'>초기화</a>
		</td>
	</tr>						
</table>

<br><br>