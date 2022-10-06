<script language='javascript'>
function setUpDown01(mode){
	var form = document.frm01;
    var code_list = form.code_list01;
	var intPos = code_list.selectedIndex;
	var intLen = code_list.length;
	var strValue, strText;

	
	if(intPos == -1){
		GblMsgBox('분류를 선택해 주십시오.','');
		return;

	}else{

		if(mode=='up'){
			if(intPos!=0 && intLen>=2){
				strValue = code_list[intPos-1].value;
				strText = code_list[intPos-1].text;
				code_list[intPos-1].value = code_list[intPos].value;
				code_list[intPos-1].text = code_list[intPos].text;
				code_list[intPos].value = strValue;
				code_list[intPos].text = strText;
				code_list[intPos-1].selected = true;
			}
		}else{
			if(intPos!=intLen-1 && intLen>=2){
				strValue = code_list[intPos+1].value;
				strText = code_list[intPos+1].text;
				code_list[intPos+1].value = code_list[intPos].value;
				code_list[intPos+1].text = code_list[intPos].text;
				code_list[intPos].value = strValue;
				code_list[intPos].text = strText;
				code_list[intPos+1].selected = true;
			}
		}


	}


}


function saveOrder01(){
	var form = document.frm01;
	var order_list = "";

    code_list = form.code_list01;
	
	for (i=0; i<code_list.length; i++){
		order_list += code_list[i].value+"|+|";
	}	

	form.sort_cade01.value=order_list;

	form.type.value = 'sort';
	form.action = 'proc.php';
	form.submit();
}

function selChk01(){
	c1 = $('#code_list01').find('option:selected').val();

	form = document.frm01;

	form.e_cade01.value = c1;
	form.o_cade01.value = c1;
}


function cade01_save(){
	form = document.frm01;
	if(isFrmEmptyModal(form.w_cade01,"분류명을 입력해 주십시오"))	return;
	
	form.type.value = 'write';
	form.action = 'proc.php';
	form.submit();
}



function cade01_modify(){
	form = document.frm01;
	var code_list = form.code_list01;
	var intPos = code_list.selectedIndex;

	if(intPos == -1){
		GblMsgBox('수정하실 분류를 선택해 주십시오.','');
		return;

	}else{
		if(isFrmEmptyModal(form.e_cade01,"분류명을 입력해 주십시오"))	return;
	
		form.type.value = 'edit';
		form.action = 'proc.php';
		form.submit();

	}
}


function cade01_delete(){
	form = document.frm01;
	var code_list = form.code_list01;
	var intPos = code_list.selectedIndex;

	if(intPos == -1){
		alert('삭제하실 분류를 선택해 주십시오');
		return;

	}else{
		strText = code_list[intPos].text;
		if(confirm(strText+'을(를) 삭제하시겠습니까?')){
			form.type.value = 'del';
			form.action = 'proc.php';
			form.submit();

		}else{
			return;

		}

	}
}

function setData(obj,chk){
	eChk = document.getElementsByName(obj);
	season = '';

	for(var i=0;i<eChk.length;i++){
		if(i == chk){
			eChk[i].checked = true;
			$('.'+obj+i).css('color','#ff0000');
			season = eChk[i].value;
		}else{
			eChk[i].checked = false;
			$('.'+obj+i).css('color','#666666');
		}
	}

	$('#e_cade01').val('');

	//대분류
	$.post('json.php',{'season':season}, function(c1){
		//대분류 selectbox 초기화
		$('#code_list01').empty();

		c1 = urldecode(c1);
		parData = JSON.parse(c1);

		//대분류 selectbox 옵션설정	
		for(i=0; i<parData.length; i++){	
			txt = parData[i];
			option = $("<option value='"+txt+"' style='padding:5px;'>"+txt+"</option>");
			$('#code_list01').append(option);
		}
	});
}
</script>




<input type='hidden' name='o_cade01' value="<?=$cade01?>">
<input type='hidden' name='sort_cade01' value="">

<div class='mCadeTit02' style='margin-bottom:3px;'>코드관리</div>
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
	<tr>
		<th width="17%">학기</th>
		<td width="83%">
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td>
						<div class="squaredThree" id='sexBox'>
							<input type="checkbox" value="봄" id="sT1" name="season" onclick='setData(this.name,0);' <?if($season == '봄'){echo 'checked';}?>>
							<label for="sT1"></label>
						</div>
						<p style='margin:3px 0 0 25px;' class='season0'>1학기</p>
					</td>
					<td style='padding:0 0 0 25px;'>
						<div class="squaredThree">
							<input type="checkbox" value="여름" id="sT2" name="season" onclick='setData(this.name,1);' <?if($season == '여름'){echo 'checked';}?>>
							<label for="sT2"></label>
						</div>
						<p style='margin:3px 0 0 25px;' class='season1'>2학기</p>
					</td>
					<td style='padding:0 0 0 25px;'>
						<div class="squaredThree">
							<input type="checkbox" value="가을" id="sT3" name="season" onclick='setData(this.name,2);' <?if($season == '가을'){echo 'checked';}?>>
							<label for="sT3"></label>
						</div>
						<p style='margin:3px 0 0 25px;' class='season2'>3학기</p>
					</td>
					<td style='padding:0 0 0 25px;'>
						<div class="squaredThree">
							<input type="checkbox" value="겨울" id="sT4" name="season" onclick='setData(this.name,3);' <?if($season == '겨울'){echo 'checked';}?>>
							<label for="sT4"></label>
						</div>
						<p style='margin:3px 0 0 25px;' class='season3'>4학기</p>
					</td>
					<td style='padding:0 0 0 25px;'>
						<div class="squaredThree">
							<input type="checkbox" value="상시" id="sT5" name="season" onclick='setData(this.name,4);' <?if($season == '상시'){echo 'checked';}?>>
							<label for="sT5"></label>
						</div>
						<p style='margin:3px 0 0 25px;' class='season4'>그외(상시)</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr> 
		<th>분류등록</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='w_cade01' value="" style='width:200px;'></td>
					<td width='5'></td>
					<td><a href="javascript:cade01_save();"><img src='./img/reg.gif'></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr> 
		<th>순서변경</th>
		<td>

			<table cellpadding='0' cellspacing='0' border='0' valign='top'>
				<tr>
					<td bgcolor='#ffffff' class='s' style='padding-left:1px;'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%' height='100%'>
							<tr>
								<td valign='top'>									


							<?
								$sql = "select * from ks_programCode where season='$season' order by sort asc";
								$result = mysql_query($sql);
								$num = mysql_num_rows($result);

								if($num<=2) $sel_size=4;
								else $sel_size=$num;

								if($cade01)		$cade01 = eregi_replace("\\\'", "'", $cade01);
							?>

									<select name="code_list01" id="code_list01" size='<?=$sel_size?>' style="width:200px;height:auto !important;" onchange="selChk01();">

							<?

								for($i=0; $i<$num; $i++){
									$row = mysql_fetch_array($result);
									$db_cade01 = $row[cade01];

									if($cade01 == $db_cade01)	$chk = 'selected';
									else	$chk = '';


									echo ("<option value=\"$db_cade01\" style='padding:5px;' $chk>$db_cade01</option>");
								}
							?>

									</select>
								</td>
								<td width=29>
									<table cellpadding=0 cellspacing=0 border=0 width=29>
										<tr>
											<td width=5></td>
											<td><a href="javascript:setUpDown01('up')"><img src="./img/up.gif" border=0></a></td>
											<td width=5></td>
										</tr>
										<tr>
											<td height=3 colspan=3></td>
										</tr>
										<tr>
											<td width=5></td>
											<td><a href="javascript:setUpDown01('down')"><img src="./img/down.gif" border=0></a></td>
											<td width=5></td>
										</tr>
									</table>
								</td>
								<td width=50><a href="javascript:saveOrder01();"><img src="./img/save.gif" border=0></a></td>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

		</td>
	</tr>

	<tr> 
		<th>분류수정</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='e_cade01' id='e_cade01' value="<?=$cade01?>" style='width:200px;color:#52809a;'></td>
					<td width='5'></td>
					<td><a href='javascript:cade01_modify();'><img src='./img/modify.gif'></a></td>
					<td width='5'></td>
					<td><a href='javascript:cade01_delete();'><img src='./img/delete.gif'></a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>





<script>
$(document).ready(function () {
	//학기
	if('<?=$season?>' == '봄')				$('.season0').css("color","#ff0000");
	else if('<?=$season?>' == '여름')	$('.season1').css("color","#ff0000");
	else if('<?=$season?>' == '가을')	$('.season2').css("color","#ff0000");
	else if('<?=$season?>' == '겨울')	$('.season3').css("color","#ff0000");
	else if('<?=$season?>' == '그외')	$('.season4').css("color","#ff0000");
});
</script>