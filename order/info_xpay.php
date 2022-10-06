<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			
			<table  border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td class="order_ttl" width="110">주문자정보</td>
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
				<tr>
					<th width="20%" class='stab_tit_b'>성&nbsp;&nbsp;명</td>
					<td width="80%" class='stab'><?=$oname?></td>
				 </tr>                                 
				 <tr>
					<th>주&nbsp;&nbsp;소</td>
					<td class='stab'>[<?=$ozipcode?>] <?=$oaddr1?> <?=$oaddr2?></td>
				</tr>
				<tr>
					<th>유선전화</td>
					<td class='stab'><?=$otel1?> - <?=$otel2?> - <?=$otel3?></td>
				</tr>
				<tr>
					<th>휴대전화</td>
					<td class='stab'><?=$ohp1?> - <?=$ohp2?> - <?=$ohp3?></td>
				</tr>
				<tr>
					<th>E-mail</td>
					<td class='stab'><?=$oemail?></td>
				</tr>
			</table>		
		</td>
	</tr>
</table>
<!---------------------          주문자정보  END    ----------------------------->


<br><br><br>


<!---------------------        배송지정보      ----------------------------->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td class="order_ttl" width="110">배송지정보</td>
					<td style='padding:0px 0px 0px 10px;'></td>
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
				<tr>
					<th width="20%">성&nbsp;&nbsp;명</th>
					<td width="80%" class='stab'><?=$pname?></td>
				 </tr>                                 
				 <tr>
					<th>주&nbsp;&nbsp;소</th>
					<td class='stab'>[<?=$pzipcode?>] <?=$paddr1?> <?=$paddr2?></td>
				</tr>
				<tr>
					<th>유선전화</th>
					<td class='stab'><?=$ptel1?> - <?=$ptel2?> - <?=$ptel3?></td>
				</tr>
				<tr>
					<th>휴대전화</th>
					<td class='stab'><?=$php1?> - <?=$php2?> - <?=$php3?></td>
				</tr>
				<tr>
					<th>배송메세지</th>
					<td class='stab'><?=$ment?></td>
				</tr>
			</table>

		
		</td>
	</tr>
</table>

