
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

	form.f_userid.value = '';
	form.f_ptype.selectedIndex = 0;

	form.f_sy.value = '';
	form.f_sm.value = '';
	form.f_sd.value = '';
	form.f_ey.value = '';
	form.f_em.value = '';
	form.f_ed.value = '';

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
				<tr>
					<th width='17%'>아이디</th>
					<td width='33%'><input type='text' name='f_userid' style='width:216px;' value='<?=$f_userid?>'></td>
					<th width='17%'>유형</th>
					<td width='33%'>
						<!-- <select name='f_ptype'>
							<option value=''>==</option>
							<option value='P' <?if($f_ptype=='P'){echo 'selected';}?> style='color:#52809a'>쿠폰차액적립</option>
							<option value='P' <?if($f_ptype=='R'){echo 'selected';}?> style='color:#52809a'>쿠폰등록</option>
							<option value='P' <?if($f_ptype=='O'){echo 'selected';}?> style='color:#52809a'>주문적립</option>
							<option value='U' <?if($f_ptype=='U'){echo 'selected';}?> style='color:#de712e'>예약사용</option>
						</select> -->
					</td>
				</tr>
			</table>
		</td>
	</tr>								
	<tr>
		<td height="35" align='center'>
			<a href='javascript:go_search();' class='small cbtn blue'>검색</a>
			<a href='javascript:reset_search();' class='small cbtn black'>초기화</a>
		</td>
	</tr>					
</table>

<br><br>












