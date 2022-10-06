<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			
			<table border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td class="order_ttl" width="90">결제정보</td>
				</tr>
			</table>
		
		</td>
	</tr>
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td height="1" bgcolor="484848" style='padding:1px 0px 0px 0px;'></td>
	</tr>

	<tr>
		<td>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class='gTable2'>
				<tr height='35'>
					<th width="20%" class="stab_tit_b">결제방법</td>
					<td width="80%" class='stab'><?=$pay_mode?></td>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF" height='35'>
					<th class="stab_tit_b">배송비</td>
					<td class='stab'><?=$ship_mode?></td>
				</tr>

				<tr bgcolor="#FFFFFF" height='35'>
					<th class="stab_tit_b">결제금액</td>
					<td class='stab'><?=number_format($amt)?>원</td>
				</tr>


			</table>
		
		</td>
	</tr>
</table>