<?
	include "../login/head.php";
	include "../class/class.DbCon.php";
	include "../class/class.Msg.php";

	if($GBL_MTYPE != 'A' && $bno != ''){
		Msg::backMsg('접근오류');
		exit;
	}

	//배너정보
	$sql = "select * from ks_banner where bno='$bno'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$sql2 = "select * from ks_banner";
	$result2= mysql_query($sql2);

	while($row2 = mysql_fetch_array($result2)){

		if($row2['upfile01'])	$osty[] = "style='color:#ff0000;'";
		else			$osty[] = '';

	}
	






	if($num){
		$row = mysql_fetch_array($result);
		$upfile01 = $row['upfile01'];
		$realfile01 = $row['realfile01'];
		$linkTxt = $row['linkTxt'];

		$type = 'edit';

	}else{
		$type = 'write';
	}
?>

<script language='javascript'>
function chkBno(){
	form = document.frm01;
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function check_form(){
	form = document.frm01;
	form.target = 'ifra_gbl';
	form.action = '/module/common/banner00_proc.php';
	form.submit();
}

function inquiryClose(){
	parent.$(".multiBox_close").click();
}
</script>

<form name='frm01' action="" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='dbfile01' value='<?=$upfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>

<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
	<tr align="cneter">
		<td style="PADDING:20 20 10 20">						
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td style="padding-bottom:5px; color:#385392; font-size:20px; font-family:Malgun Gothic; "><strong>메인이미지설정</strong></td>
				</tr>
				<tr>
					<td height="2" bgcolor="#385392"></td>
				</tr>

				<tr>
					<td style="padding:20 0">
						<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
							<tr> 
								<th width='20%'>순서</th>
								<td width='80%'>
									<select name='bno' style='height:28px;' onchange='chkBno();'>
										<option value='10' <?if($bno == '10'){echo 'selected';}?> <?=$osty[0]?>>1</option>
										<option value='11' <?if($bno == '11'){echo 'selected';}?> <?=$osty[1]?>>2</option>
										<option value='12' <?if($bno == '12'){echo 'selected';}?> <?=$osty[2]?>>3</option>
										<option value='13' <?if($bno == '13'){echo 'selected';}?> <?=$osty[3]?>>4</option>
										<option value='14' <?if($bno == '14'){echo 'selected';}?> <?=$osty[4]?>>5</option>
										<option value='15' <?if($bno == '15'){echo 'selected';}?> <?=$osty[5]?>>6</option>
										<option value='16' <?if($bno == '16'){echo 'selected';}?> <?=$osty[6]?>>7</option>
										<option value='17' <?if($bno == '17'){echo 'selected';}?> <?=$osty[7]?>>8</option>
										<option value='18' <?if($bno == '18'){echo 'selected';}?> <?=$osty[8]?>>9</option>
										<option value='19' <?if($bno == '19'){echo 'selected';}?> <?=$osty[9]?>>10</option>
									</select>
								</td>
							</tr>
							<tr> 
								<th>이미지</th>
								<td>
									<table cellpadding='0' cellspacing='0' border='0'>
										<tr>
											<td>
											<?
												if($upfile01){
											?>
												<div style="width:350px;height:139px;background:url('/upfile/<?=$upfile01?>') no-repeat center;background-size:contain;"></div>
												<div style='margin:10px 0;'>
													<div class="enable_btn">
														<div class="squaredThree">
															<input type="checkbox"  id="squaredDel01" type="checkbox" name="del_upfile01" value="Y" />
															<label for="squaredDel01"></label>										
														</div>
														<p style='margin:0 0 0 25px;'>삭제&nbsp;&nbsp;(<?=$realfile01?>)</p>
													</div>
												</div>
											<?
												}
											?>
												<div class="file_input">
													<input type="text" readonly title="File Route" id="file_route01">
													<label>찾아보기<input type="file" name="upfile01" onchange="javascript:document.getElementById('file_route01').value=this.value"></label>
												</div>
											</td>
										</tr>
									</table>
									<div style='margin:3px 0 0 0;font-size:11px;'>(가로:580px * 세로:400px)</div>
								</td>
							</tr>

							<tr>
								<th>연결주소</th>
								<td><input type='text' name='linkTxt' value="<?=$linkTxt?>" style='padding:0 0 0 5px;width:100%;' placeholder='http://'></td>
							</tr>

						</table>


						<div style="padding-top:15px; ">
							<div style="float:left; padding-left:15px;">
								<a href="javascript:check_form();" class='ClassName04' style="color:#ffffff">저장하기</a>
							</div>
							<div style="float:right; padding-right:5px;">
								<a href="javascript:inquiryClose();" class='ClassName05' style="color:#ffffff">취소</a>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td height="2" bgcolor="#454545"></td>
				</tr>
			</table>

		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td height="100%" bgcolor="#ffffff"></td>
	</tr>
</table>

</form>

</body>
</html>