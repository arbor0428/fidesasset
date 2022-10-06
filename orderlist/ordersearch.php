<script language='javascript'>
function check_form(){
	form = document.frm_search;

	if(isFrmEmpty(form.f_oname,"주문자를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.f_ohp2,"휴대전화번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.f_ohp3,"휴대전화번호를 입력해 주십시오"))	return;

	form.type.value = 'list';
	form.submit();
}
</script>


<form name='frm_search' method='post' action='<?=$PHP_SELF?>'>
<input type='hidden' name='type' value=''>
<table width="500" border="0" cellpadding="0" cellspacing="0">

	<tr>
		<td align="center">
			<table border="0" cellpadding="0" cellspacing="0" class='gTable2'>
				<tr>
					<th class='orderlist_ttl'>주문자</td>
					<td class='tab'><input type='text' name='f_oname' value='' style='width:170px;'></td>
					
				</tr>
				<tr>
					<th class='orderlist_ttl'>휴대전화번호</td>
					<td class='tab'>
					<select name='f_ohp1'>
						<option value='010'>010</option>
						<option value='011'>011</option>
						<option value='016'>016</option>
						<option value='017'>017</option>
						<option value='018'>018</option>
						<option value='019'>019</option>
					</select> - <input type='text' name='f_ohp2' value='' style='width:50px;' maxlength='4' > - <input type='text' name='f_ohp3' value='' style='width:50px;' maxlength='4' >
				</td>
				</tr>
			</table>
		</td>
	</tr>

</table>

<div class="shop_btn" style='width:500px;'>
	<a href="javascript:check_form();" >
		<div style="padding:12px 0px; font-size:17px; font-weight:bold; ">주문확인</div>
	</a>
</div>	
</form>