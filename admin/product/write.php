<?
	if($type=='edit' && $uid){
		$sql = "select * from ks_medicine where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$title = $row["title"];
		$memo = $row["memo"];
		$cade01 = $row["cade01"];
		$cade02 = $row["cade02"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$data04 = $row["data04"];
		$data05 = $row["data05"];
		$data06 = $row["data06"];
		$data07 = $row["data07"];
		$data08 = $row["data08"];
		$data09 = $row["data09"];
		$upfile01 = $row["upfile01"];
		$realfile01 = $row["realfile01"];
		$upfile02 = $row["upfile02"];
		$realfile02 = $row["realfile02"];

		//비고
		if($data04)	$data04 = Util::textareaDecodeing($data04);
		if($data05)	$data05 = Util::textareaDecodeing($data05);
		if($data06)	$data06 = Util::textareaDecodeing($data06);
		if($data07)	$data07 = Util::textareaDecodeing($data07);
		if($data08)	$data08 = Util::textareaDecodeing($data08);
		if($data09)	$data09 = Util::textareaDecodeing($data09);


	}

	include 'script.php';
?>

<form name='frm_filedown' method='post'>
	<input type='hidden' name='downfiledir' value='../../upfile/'>
	<input type='hidden' name='file_name' value="<?=$upfile01?>">
	<input type='hidden' name='file_rename' value="<?=$realfile01?>">
</form>
<form name='frm_filedown2' method='post'>
	<input type='hidden' name='downfiledir' value='../../upfile/'>
	<input type='hidden' name='file_name' value="<?=$upfile02?>">
	<input type='hidden' name='file_rename' value="<?=$realfile02?>">
</form>


<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='dbfile01' id='dbfile01' value='<?=$upfile01?>'>
<input type='hidden' name='realfile01' id='realfile01' value='<?=$realfile01?>'>
<input type='hidden' name='oldUser' value='<?=$oldUser?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_userNum' value='<?=$f_userNum?>'>
<input type='hidden' name='f_sex' value='<?=$f_sex?>'>
<input type='hidden' name='f_bDate01' value='<?=$f_bDate01?>'>
<input type='hidden' name='f_bDate02' value='<?=$f_bDate02?>'>
<input type='hidden' name='f_status' value='<?=$f_status?>'>
<input type='hidden' name='f_userType' value='<?=$f_userType?>'>
<input type='hidden' name='f_reduction' value='<?=$f_reduction?>'>
<input type='hidden' name='f_carNum' value='<?=$f_carNum?>'>
<input type='hidden' name='f_phone' value='<?=$f_phone?>'>
<input type='hidden' name='f_sort' value='<?=$f_sort?>'>
<input type='hidden' name='f_record' value='<?=$f_record?>'>
<!-- /검색관련 -->

<div style='width:1000px;'>
	<div class='mCadeTit02' style='margin-bottom:3px;'>회원 정보</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		

		<tr>
			<th width='17%'><?=$ico01?> 구분</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="squaredThree" id='sexBox'>
								<input type="checkbox" value="일반의약품" id="jT1" name="cade01" onclick='setChkBox(this.name,0);' <?if(!$cade01 || $cade01 == '일반의약품'){echo 'checked';}?>>
								<label for="jT1"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='status0'>일반의약품</p>
						</td>
						<td style='padding:0 0 0 25px;'>
							<div class="squaredThree">
								<input type="checkbox" value="전문의약품" id="jT2" name="cade01" onclick='setChkBox(this.name,1);' <?if($cade01 == '전문의약품'){echo 'checked';}?>>
								<label for="jT2"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='status1'>전문의약품</p>
						</td>
						<td style='padding:0 0 0 25px;'>
							<div class="squaredThree">
								<input type="checkbox" value="건강기능식품" id="jT3" name="cade01" onclick='setChkBox(this.name,2);' <?if($cade01 == '건강기능식품'){echo 'checked';}?>>
								<label for="jT3"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='status2'>건강기능식품</p>
						</td>
						<td style='padding:0 0 0 25px;'>
							<div class="squaredThree">
								<input type="checkbox" value="기타" id="jT4" name="cade01" onclick='setChkBox(this.name,3);' <?if($cade01 == '기타'){echo 'checked';}?>>
								<label for="jT4"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='status3'>기타</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th width='17%'><?=$ico01?> 제품명</th>
			<td colspan='3'><input name="title" id="title" style="width:100%;" type="text" value="<?=$title?>"></td>
		</tr>
		<tr>
			<th width='17%'><?=$ico01?> 간단설명</th>
			<td colspan='3'><input name="memo" id="memo" style="width:100%;" type="text" value="<?=$memo?>"></td>
		</tr>

		<tr>
			<th>제품이미지</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="file_input">
								<input type="text" readonly title="File Route" id="file_route01" style="width:200px;padding:0 0 0 10px;" placeholder="제품이미지를 등록해주세요..">
								<label>파일선택<input type="file" name="upfile01" id="upfile01" onchange="fileChk('01');"></label>
							</div>
							<div style='font-size:14px;color:#ce0606;'>
							※ 1:1 비율의 이미지파일을 등록해주세요.
							</div>
						</td>
					<?
						if($upfile01){
					?>
						
						<td style='padding:0 0 0 20px;'><img src='/upfile/<?=$upfile01?>' style='width:100px;'></td>
						<td style='padding:0 0 0 10px;'>
							<div class="squaredThree">
								<input type="checkbox" value="Y" id="fDel" name="del_upfile01">
								<label for="fDel"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>삭제&nbsp;&nbsp;(<?=$realfile01?>)</p>
						</td>
						<td style='padding:0 0 0 20px;'><a href="javascript:filedownload();" class='small cbtn green'>다운로드</a></td>
					<?
						}
					?>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th width='17%'><?=$ico01?> 분류</th>
			<td width='33%'><input name="cade02" id="cade02" style="width:250px;" type="text" value="<?=$cade02?>"></td>

			<th width='17%'><?=$ico01?> 성분/함량</th>
			<td width='33%'><input name="data01" id="data01" style="width:250px;" type="text" value="<?=$data01?>"></td>
		</tr>

		<tr>
			<th width='17%'><?=$ico01?> 보험코드</th>
			<td width='33%'><input name="data02" id="data02" style="width:250px;" type="text" value="<?=$data02?>"></td>

			<th width='17%'><?=$ico01?> 보험약가</th>
			<td width='33%'><input name="data03" id="data03" style="width:250px;" type="text" value="<?=$data03?>"></td>
		</tr>
		<tr>
			<th>의약품 상세정보</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="file_input">
								<input type="text" readonly title="File Route" id="file_route02" style="width:250px;padding:0 0 0 10px;" placeholder="의약품 상세정보 파일을 등록해주세요..">
								<label>파일선택<input type="file" name="upfile02" id="upfile02" onchange="fileChk('02');"></label>
							</div>
						</td>
					<?
						if($upfile02){
					?>
						<td style='padding:0 0 0 10px;'>
							<div class="squaredThree">
								<input type="checkbox" value="Y" id="fDel" name="del_upfile02">
								<label for="fDel"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>삭제&nbsp;&nbsp;(<?=$realfile02?>)</p>
						</td>
						<td style='padding:0 0 0 20px;'><a href="javascript:filedownload2();" class='small cbtn green'>다운로드</a></td>
					<?
						}
					?>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<th>성상</th>
			<td colspan='3'><textarea name='data04' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$data04?></textarea></td>
		</tr>
		<tr>
			<th>성분/함량</th>
			<td colspan='3'><textarea name='data05' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$data05?></textarea></td>
		</tr>
		<tr>
			<th>용법/용량</th>
			<td colspan='3'><textarea name='data06' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$data06?></textarea></td>
		</tr>
		<tr>
			<th>포장단위</th>
			<td colspan='3'><textarea name='data07' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$data07?></textarea></td>
		</tr>
		<tr>
			<th>효능/효과</th>
			<td colspan='3'><textarea name='data08' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$data08?></textarea></td>
		</tr>
		<tr>
			<th>저장방법</th>
			<td colspan='3'><textarea name='data09' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$data09?></textarea></td>
		</tr>

	</table>

<?
	if($type == 'write'){
?>
	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td align='center' style='padding:30px 0;'>
				<a href="javascript:check_form();" class='big cbtn blue'>등록</a>&nbsp;&nbsp;
				<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
			</td>
		</tr>
	</table>

<?
	}else{
?>
<!--
	<div class='mCadeTit02' style='margin:30px 0 3px 0;'>본인인증정보</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th width='17%'>성명</th>
			<td width='33%'><?=$kcbName?></td>
			<th width='17%'>성별</th>
			<td width='33%'><?=$kcbSex?></td>
		</tr>
		<tr>
			<th>생년월일</th>
			<td><?=$kcbBdate?></td>
			<th>휴대폰번호</th>
			<td><?=$kcbMobile?></td>
		</tr>
	</table>
-->
	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td width='20%'></td>
			<td width='40%' align='center' style='padding:30px 0;'>
				<a href="javascript:check_form();" class='big cbtn blue'>정보수정</a>&nbsp;&nbsp;
				<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
			</td>
			<td width='20%' align='right'><a href="javascript:checkDel();" class='big cbtn blood'>이용자삭제</a></td>
		</tr>
	</table>

<?
	}
?>
</div>


</form>



<script>
$(document).ready(function () {
	//승인
	if('<?=$status?>' == '1'){
		$('#jT1').click();
		$('#jT1').prop('checked', true);
	}else if('<?=$status?>' == '2'){
		$('#jT2').click();
		$('#jT2').prop('checked', true);
	}

	//성별
	if('<?=$sex?>' == '남'){
		$('#squaredThree1').click();
		$('#squaredThree1').prop('checked', true);
	}else if('<?=$sex?>' == '여'){
		$('#squaredThree2').click();
		$('#squaredThree2').prop('checked', true);
	}

	//회원구분
	if('<?=$userType?>' == '일반'){
		$('#squaredThree3').click();
		$('#squaredThree3').prop('checked', true);
	}else if('<?=$userType?>' == '감면대상자'){
		$('#squaredThree4').click();
		$('#squaredThree4').prop('checked', true);
	}

	//차량보유
	if('<?=$car?>' == ''){
		$('#cT1').click();
		$('#cT1').prop('checked', true);
	}else if('<?=$car?>' == '예'){
		$('#cT2').click();
		$('#cT2').prop('checked', true);
	}

	//대상자 자료제공
	if('<?=$cok?>' == ''){
		$('#sT7').click();
		$('#sT7').prop('checked', true);
	}else{
		$('#sT8').click();
		$('#sT8').prop('checked', true);
	}

	//선호채널
	if('<?=$cokPost?>'){
		$('#cC1').click();
		$('#cC1').prop('checked', true);
	}

	if('<?=$cokSms?>'){
		$('#cC2').click();
		$('#cC2').prop('checked', true);
	}

	if('<?=$cokEmail?>'){
		$('#cC3').click();
		$('#cC3').prop('checked', true);
	}

	if('<?=$cokPhone?>'){
		$('#cC4').click();
		$('#cC4').prop('checked', true);
	}
});
</script>