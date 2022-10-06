<?
	if($GBL_USERID){
		$sql = "select * from ks_userlist where userid='$GBL_USERID'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$oname = $row['name'];
		$opoint = $row['point'];
		$ozipcode = $row['zipcode'];
		$oaddr1 = $row['addr01'];
		$oaddr2 = $row['addr02'];
		$otel1 = $row['tel1'];
		$otel2 = $row['tel2'];
		$otel3 = $row['tel3'];
		$ohp1 = $row['hp1'];
		$ohp2 = $row['hp2'];
		$ohp3 = $row['hp3'];
		$oemail01 = $row['email01'];
		$oemail02 = $row['email02'];
		if($oemail01 || $oemail02)	$oemail=$oemail01.'@'.$oemail02;


		if(!$opoint)	$opoint = 0;

	}



	if($_SERVER['REMOTE_ADDR'] == '106.246.92.237') {
		$oname='아이웹';
		$ozipcode='123';
		$oaddr1='서울 서대문구 충정로 53 (충정로2가, 골든타워빌딩)';
		$oaddr2='1601호';
		$otel1='02';
		$otel2='1661';
		$otel3='2327';
		$ohp2='1234';
		$ohp3='5678';
		$oemail='iwebzone@naver.com';
	}

?>

<!--
<script src='http://dmaps.daum.net/map_js_init/postcode.v2.js'></script>
-->
<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
<script language='javascript'>
function openDaumPostcode(fName) {
	new daum.Postcode({
		oncomplete: function(data) {
			// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullAddr = ''; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
			if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
				fullAddr = data.roadAddress;

			} else { // 사용자가 지번 주소를 선택했을 경우(J)
				fullAddr = data.jibunAddress;
			}

			// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
			if(data.userSelectedType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

//			document.getElementById('sample6_postcode').value = data.zonecode; //5자리 새우편번호 사용

			if(fName == 'o'){
/*
				document.getElementById('ozip1').value = data.postcode1;
				document.getElementById('ozip2').value = data.postcode2;
*/
				document.getElementById('ozipcode').value = data.zonecode;
				document.getElementById('oaddr1').value = fullAddr;
				document.getElementById('oaddr2').focus();

			}else if(fName == 'p'){
/*
				document.getElementById('pzip1').value = data.postcode1;
				document.getElementById('pzip2').value = data.postcode2;
*/
				document.getElementById('pzipcode').value = data.zonecode;
				document.getElementById('paddr1').value = fullAddr;
				document.getElementById('paddr2').focus();
			}

		}
	}).open();
}
</script>

<script language='javascript'>
function set_regedit(chk){
	form = document.frm_order;

	if(chk){
		form.pname.value = form.oname.value;
		form.pzipcode.value = form.ozipcode.value;
		form.paddr1.value = form.oaddr1.value;
		form.paddr2.value = form.oaddr2.value;
		form.ptel1.value = form.otel1.value;
		form.ptel2.value = form.otel2.value;
		form.ptel3.value = form.otel3.value;
		form.php1.value = form.ohp1.value;
		form.php2.value = form.ohp2.value;
		form.php3.value = form.ohp3.value;

	}else{
		form.pname.value = '';
		form.pzipcode.value = '';
		form.paddr1.value = '';
		form.paddr2.value = '';
		form.ptel1.value = '';
		form.ptel2.value = '';
		form.ptel3.value = '';
		form.php1.selectedIndex = 0;
		form.php2.value = '';
		form.php3.value = '';
	}
}
</script>



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
					<th width="20%" class='stab_tit_b'>성&nbsp;&nbsp;명</th>
					<td width="80%" class='stab'><input type="text" style="100%;" value="<?=$oname?>" name="oname" class="sinp01" onfocus='inputFocus(this)' onblur='inputBlur(this)'></td>
				 </tr>                                 
				 <tr>
					<th class="stab_tit_b">주&nbsp;&nbsp;소</th>
					<td class='stab'>					
						<table border="0" cellspacing="0" cellpadding="0" width="100%">
							<tr height="40">
								<td>
									<input type="text" class="sinp01" name="ozipcode" id="ozipcode" style="width:45px;" value="<?=$ozipcode?>" maxlength="5" onfocus='inputFocus(this)' onblur='inputBlur(this)'> 
									<a href="javascript:openDaumPostcode('o');" class="big cbtn blue">주소찾기</a>
								</td>
							</tr>
							<tr height="40">
								<td class="font_black"><input type="text" style="width:50%;" name="oaddr1" id="oaddr1" value="<?=$oaddr1?>" class="sinp01" onfocus='inputFocus(this)' onblur='inputBlur(this)'>&nbsp;기본주소</td>
							</tr>
							<tr height="40">
								<td class="font_black"><input type="text" style="width:50%;" name="oaddr2" id="oaddr2" value="<?=$oaddr2?>" class="sinp01" onfocus='inputFocus(this)' onblur='inputBlur(this)'>&nbsp;나머지주소</td>
							</tr>
						</table>
						
					</td>
				</tr>
				<tr>
					<th>유선전화</td>
					<td class='stab'>
						<input type='text' class="sinp01" maxlength="4" style="width:47px;" value="<?=$otel1?>" name="otel1" onfocus='inputFocus(this)' onblur='inputBlur(this)'> - 
						<input type='text' class="sinp01" maxlength="4" style="width:45px;" value="<?=$otel2?>" name="otel2" onfocus='inputFocus(this)' onblur='inputBlur(this)'> - 
						<input type='text' class="sinp01" maxlength="4" style="width:45px;" value="<?=$otel3?>" name="otel3" onfocus='inputFocus(this)' onblur='inputBlur(this)'>
					</td>
				</tr>
				<tr>
					<th>휴대전화</td>
					<td class='stab'>
						<select name='ohp1' class="sinp01">
							<option value='010' <?if($ohp1=='010'){echo 'selected';}?>>010</option>
							<option value='011' <?if($ohp1=='011'){echo 'selected';}?>>011</option>
							<option value='016' <?if($ohp1=='016'){echo 'selected';}?>>016</option>
							<option value='017' <?if($ohp1=='017'){echo 'selected';}?>>017</option>
							<option value='018' <?if($ohp1=='018'){echo 'selected';}?>>018</option>
							<option value='019' <?if($ohp1=='019'){echo 'selected';}?>>019</option>
						</select>
						-
						<input type='text' class="sinp01" maxlength="4" style="width:45px;" value="<?=$ohp2?>" name="ohp2" onfocus='inputFocus(this)' onblur='inputBlur(this)'>
						-
						<input type='text' class="sinp01" maxlength="4" style="width:45px;" value="<?=$ohp3?>" name="ohp3" onfocus='inputFocus(this)' onblur='inputBlur(this)'>
					</td>
				</tr>
				<tr>
					<th>E-mail</td>
					<td class='stab'><input type='text' class="sinp01" style="width:30%;" value="<?=$oemail?>" name="oemail" onfocus='inputFocus(this)' onblur='inputBlur(this)'><br>- 반드시 수신가능한 E-mail 주소를 입력해 주십시오.</td>
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
					<td style='padding:0px 0px 0px 10px;'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td style='padding:0px 0px 0px 20px;'><input type='checkbox' name='schk' value='1' onclick="set_regedit(this.checked);"> 주문자와 동일</td>
							</tr>
						</table>
					</td>
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
					<th width="20%" class="stab_tit_b">성&nbsp;&nbsp;명</th>
					<td width="80%" class='stab'><input type="text" style="width:190px" value="" name="pname" class="sinp01" onfocus='inputFocus(this)' onblur='inputBlur(this)'></td>
				 </tr>                                 
				 <tr>
					<th>주&nbsp;&nbsp;소</td>
					<td class='stab'>					
						<table border="0" cellspacing="0" cellpadding="0" width="100%">
							<tr height="40">
								<td>
									<input type="text" class="sinp01" name="pzipcode" id="pzipcode" style="width:45px;" value="" maxlength="5" onfocus='inputFocus(this)' onblur='inputBlur(this)'> <a href="javascript:openDaumPostcode('p');" class="big cbtn blue">주소찾기</a>
								</td>
							</tr>
							<tr height="40">
								<td class="font_black"><input type="text" style="width:50%" name="paddr1" id="paddr1" value="" class="sinp01" onfocus='inputFocus(this)' onblur='inputBlur(this)'>&nbsp;기본주소</td>
							</tr>
							<tr height="40">
								<td class="font_black"><input type="text" style="width:50%" name="paddr2" id="paddr2" value="" class="sinp01" onfocus='inputFocus(this)' onblur='inputBlur(this)'>&nbsp;나머지주소</td>
							</tr>
						</table>
						
					</td>
				</tr>
				<tr>
					<th>유선전화</td>
					<td class='stab'>
						<input type='text' class="sinp01" maxlength="4" style="width:48px;" value="" name="ptel1" onfocus='inputFocus(this)' onblur='inputBlur(this)'> - 
						<input type='text' class="sinp01" maxlength="4" style="width:45px;" value="" name="ptel2" onfocus='inputFocus(this)' onblur='inputBlur(this)'> - 
						<input type='text' class="sinp01" maxlength="4" style="width:45px;" value="" name="ptel3" onfocus='inputFocus(this)' onblur='inputBlur(this)'>
					</td>
				</tr>
				<tr>
					<th>휴대전화</td>
					<td class='stab'>
						<select name='php1' class="sinp01">
							<option value='010'>010</option>
							<option value='011'>011</option>
							<option value='016'>016</option>
							<option value='017'>017</option>
							<option value='018'>018</option>
							<option value='019'>019</option>
						</select>
						-
						<input type='text' class="sinp01" maxlength="4" style="width:45px;" value="" name="php2" onfocus='inputFocus(this)' onblur='inputBlur(this)'>
						-
						<input type='text' class="sinp01" maxlength="4" style="width:45px;" value="" name="php3" onfocus='inputFocus(this)' onblur='inputBlur(this)'>
					</td>
				</tr>
				<tr>
					<th>배송메세지</td>
					<td class='stab'>
						
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="26">
									<textarea class="sinp01" name="ment" style='width:100%;height:70px;resize:none;border:1px solid #d1d1d1;' onfocus='inputFocus(this)' onblur='inputBlur(this)'></textarea>
								</td>
							</tr>
							<tr>
								<td height="20" class="font_black">&nbsp;&nbsp;- 배송메세지란에는 배송시 참고할 사항이 있으면 적어주십시오.</td>
							</tr>
						</table>
					
					</td>
				</tr>
			</table>

		
		</td>
	</tr>
</table>

<br><br><br>