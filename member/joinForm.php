<?
	//감면구분
	$reductionArr = Array('국가유공자','장애인할인');

	//가입경로
	$joinTypeArr = Array('인터넷검색','지인추천');

	if($type=='edit' && $GBL_USERID){
		$sql = "select * from ks_userlist where userid='$GBL_USERID'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		if($num == 0){
			Msg::backMsg('일반사용만 이용이 가능합니다');
			exit;
		}

		$row = mysql_fetch_array($result);

		$status = $row["status"];
		$userid = $row["userid"];
		$pwd = $row["pwd"];
		$name = $row["name"];
		$userNum = $row["userNum"];
		$sex = $row["sex"];
		$bDate = $row["bDate"];
		$userType = $row["userType"];
		$car = $row["car"];
		$carNum = $row["carNum"];
		$zipcode = $row["zipcode"];
		$addr01 = $row["addr01"];
		$addr02 = $row["addr02"];
		$email01 = $row["email01"];
		$email02 = $row["email02"];
		$phone01 = $row["phone01"];
		$phone01Txt = $row["phone01Txt"];
		$phone02 = $row["phone02"];
		$phone02Txt = $row["phone02Txt"];
		$memo = $row["memo"];
		$reduction = $row["reduction"];
		$upfile01 = $row["upfile01"];
		$realfile01 = $row["realfile01"];
		$cok = $row["cok"];
		$cokPost = $row["cokPost"];
		$cokSms = $row["cokSms"];
		$cokEmail = $row["cokEmail"];
		$cokPhone = $row["cokPhone"];
		$health = $row["health"];
		$healthBaby = $row["healthBaby"];
		$healthEtc = $row["healthEtc"];
		$joinType = $row["joinType"];
		$getDate = $row["getDate"];

		$healthArr = explode(',',$health);

		//비고
//		if($memo)	$memo = Util::textareaDecodeing($memo);

	}else{
		$status = '2';
		$healthArr = Array();
		$getDate = date('Y-m-d');
	}

	include 'script.php';
?>

<style type='text/css'>
.userTypeMemo1{
	display:none;
	width:400px;
	border-radius: 6px;
	padding: 5px;
	position: absolute;
	z-index: 1;
	transition:all 2s;
	border:1px solid #d2d2d2;
	background-color:#fbd99f;
	color:#333;
	line-height:17px;
	height:auto;
	right:0;
	bottom:10px;
}

.userType1:hover .userTypeMemo1{
	display:none;
}
.userTypeMemo1 table{
background-color:#FFF;
width:100%;
}
.userTypeMemo1 td{font-size:13px !important;}
.formTable input[type=text], .formTable input[type=password], .formTable input[type=file] {
	height:auto;
    border: 1px solid #ccc;
}
</style>

<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='dbfile01' value='<?=$upfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>

<input type='hidden' name='DBuserType' value='<?=$userType?>'>
<input type='hidden' name='DBreduction' value='<?=$reduction?>'>


<div>

	<ul class="formTable clearfix ggform1">
	<?
		if($type == 'write'){
	?>

	<!--
		<li class="li100">
			<div class="ppbox">
			<p>※ 기존에 가입하신 경우 가입정보를 불러올 수 있습니다.</p>
			
			<a href="javascript://" class="IdPwd_open" id="IdPwd_open">정보검색</a>
		</li>
	-->
		
		<li class="li100">
			<div class="formttl1"><span style="color:red">*</span>아이디</div>
			<div class="clearfix"><input class="ip_1 join_id ipfl" name="userid" id="userid" type="text" value="">  <a href="javascript:checkID(1);" class="bntstyle1">중복체크</a></div>
		</li>

		<li class="mr">
			<div class="formttl1"><span style="color:red">*</span>비밀번호<span style="font-size:13px;font-weight:400">&nbsp;(6자 ~ 10자 이내)</span></div>
			<div><input name="pwd" id="pwd" class="ip_1" style="width:100%;height:40px;" type="password" onkeyup='pwdChk();'></div>
		</li>
		
		<li>
			<div class="formttl1"><span style="color:red">*</span>비밀번호 확인</div>
			<div><input class="ip_1" name="re_pwd" id="re_pwd" style="width:100%;height:40px;" type="password" onkeyup='pwdChk();'> <span id='pwdTxt'></span></div>
		</li>

		
	<?
		}else{
	?>
		
		<li class="mr">
			<div class="formttl1"><span style="color:red">*</span>아이디</div>
			<div class="editinfo"><?=$userid?><input class="ip_1 join_id ipfl" type='hidden' name='userid' id='userid' value='<?=$userid?>'></div>
		</li>

		<li>
			<div class="formttl1"><span style="color:red">*</span>비밀번호</div>
			<div><input class="ip_1" name="pwd" id="pwd" style="width:250px;height:40px;" type="password" value="<?=$pwd?>"> <span style="font-size:13px;">※ 6자 ~ 10자 이내</span></div>
		</li>
	<?
		}
	?>

		<li class="mr">
			<div class="formttl1"><span style="color:red">*</span>회원명</div>
			<div><input class="ip_1" name="name" id="name" style="width:100%;" type="text" value="<?=$name?>"></div>
		</li>

		<li>
			<div class="formttl1">회원번호<span style="font-size:13px;font-weight:400">&nbsp;(자동으로 입력됩니다.)</span></div>
			<div style="width:100%;background:#c3c3c3;height:40px;line-height:40px;border:1px solid #d2d2d2"><span id='userNumTxt'><?=$userNum?></span><input class="ip_1" type='hidden' name='userNum' id='userNum' value='<?=$userNum?>' style="color:#000"></div>
		</li>

		<li class="mr chk_iro clearfix">
			<div class="formttl1"><span style="color:red">*</span>성별</div>

			<div class="vms_wrap clearfix" id="vmsBox">
				<label class="male ss1" for="squaredThree1">
				<input type="checkbox" value="남" id="squaredThree1" name="sex" onclick='setChkBox(this.name,0);' <?if($sex == '남'){echo 'checked';}?>>
				<div class="box_radio nrb">남</div>				
				</label>

				<label class="female ss1" for="squaredThree2">
				<input type="checkbox" value="여" id="squaredThree2" name="sex" onclick='setChkBox(this.name,1);' <?if($sex == '여'){echo 'checked';}?>>
				<div class="box_radio ">여</div>
				</label>
			</div>
		</li>

		<li>
			<div class="formttl1"><span style="color:red">*</span>생년월일</div>
			<div ><input style='border:1px solid #d2d2d2;height:40px;background:#fff;width:100%' type='text' name='bDate' id='fpicker1' value='<?=$bDate?>' readonly></div>
		</li>

		<li class="li100 chk_iro clearfix">
			<div class="formttl1"><span style="color:red">*</span>감면대상자 구분</div>

				<div class="vms_wrap clearfix" id="vmsBox">
					<label class="male ss1" for="squaredThree3">
					<input type="checkbox" value="일반" id="squaredThree3" name="userType" onclick='setChkBox(this.name,0);' <?if($userType == '일반'){echo 'checked';}?>>
					<div class="box_radio nrb">해당없음</div>				
					</label>

					<label class="female ss1 userType1" for="squaredThree4" style="position:relative">
					<input type="checkbox" value="감면대상자" id="squaredThree4" name="userType" onclick='setChkBox(this.name,1);' <?if($userType == '감면대상자'){echo 'checked';}?>>
					<div class="box_radio ">감면대상자</div>
					<div class="userTypeMemo1 shadow2">
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
									① 국민기초생활보장수급 대상자<br>
									<p style='padding:0 0 0 10px;'>
									- 생계·의료 100% 감면<br>
									- 주거·교육 50% 감면<br>
									- 증빙서류 필요
									</p>
								 </td>
								<td>
									② 장애인<br>
									<p style='padding:0 0 0 10px;'>
									- 1~3급 50% 감면<br>
									- 4~6급 20% 감면<br>
									- 복지카드 사본 지참
									</p>
								 </td>
							</tr>

							<tr>
								<td>
									③ 국가보훈대상<br>
									<p style='padding:0 0 0 10px;'>
									- 본인 및 직계가족 50% 감면<br>
									- 증명카드 사본 및 가족관계증명서
									</p>
								 </td>
								<td>
									④ 차상위계층<br>
									<p style='padding:0 0 0 10px;'>
									- 50% 감면<br>
									- 증빙서류 필요
									</p>
								 </td>
							</tr>

							<tr>
								<td>
									⑤ 다자녀(자녀 3명이상) 가족<br>
									<p style='padding:0 0 0 10px;'>
									- 만 18세 이하 자녀 및 부모 50% 감면<br>
									- 주민등록등본
									</p>
								 </td>
								<td>
									⑥ 경로(만 65세이상)<br>
									<p style='padding:0 0 0 10px;'>
									- 본인 50% 감면<br>
									- 신분증 사본 필요
									</p>
								 </td>
							</tr>

							<tr>
								<td colspan='2'>
									※ 감면혜택기준
									<p style='padding:0 0 0 10px;'>
									- 수원시 거주자 (경로감면은 무관)<br>
									- 1인당 1과목만 감면<br>
									- 중복감면 적용 안됨
									</p>
								</td>
							</tr>
						</table>
					</div>
					</label>
					
				</div>

			</td>
		</li>

		<li class='mr' id="saleBox01" <?if($userType == '일반' || $userType == ''){echo "style='display:none;'";}?>>
			<div class="formttl1"><span style="color:red">*</span>감면구분</div>
			<select name='reduction' id='reduction'class="ipmt10" style='border:1px solid #ccc;height:46px;width:100%'>
				<option value=''>:: 선택 ::</option>
			<?
				for($i=0; $i<count($reductionArr); $i++){
					$rTxt = $reductionArr[$i];
					if($reduction == $rTxt)	$chk = 'selected';
					else							$chk = '';

					echo ("<option value='$rTxt' $chk>$rTxt</option>");
				}
			?>
			</select>			
		</li>

		<li id="saleBox02" <?if($userType == '일반' || $userType == ''){echo "style='display:none;'";}?>>
			<div class="formttl1">감면자료</div>

			<div class="file_input2 clearfix">
				<input class="filenm"  type="text" readonly title="File Route" id="file_route01" placeholder="감면관련 서류를 첨부해주세요.">
				<label class="clearfix filebtn" style="height:46px;line-height:46px;font-size:13px">파일선택<input  style='border:1px solid #ccc;height:46px;' type="file" name="upfile01" id="upfile01" onchange="fileChk('01');"></label>
			</div>					

		<?
			if($upfile01){
		?>	
			<div style="margin-top:10px">
				<div class="squaredThree" style="float:left;">
					<input type="checkbox" value="Y" id="fDel" name="del_upfile01">
					<label for="fDel"></label>
				</div>
				<p style='margin:0 0 0 25px;float:left' >삭제&nbsp;&nbsp;(<?=$realfile01?>)</p>
				<a style="margin-left:5px" href="javascript:filedownload();" class='small cbtn green'>다운로드</a>
			</div>
		<?
			}
		?>			
		</li>


		<li class="li100 chk_iro clearfix">
			<div class="formttl1">차량소유</div>
			
			<div class="vms_wrap clearfix" id="vmsBox">
				<label class="male ss1" for="cT1" style="width:50%">
				<input type="checkbox" value="" id="cT1" name="car" onclick='setChkBox(this.name,0);' <?if($car == ''){echo 'checked';}?>>
				<div class="box_radio nrb">아니오</div>				
				</label>

				<label class="female ss1" for="cT2" style="width:50%">
				<input type="checkbox" value="예" id="cT2" name="car" onclick='setChkBox(this.name,1);' <?if($car == '예'){echo 'checked';}?>>
				<div class="box_radio ">예</div>
				</label>
				<div id='carBox' style='display:none;width:50%;float:left;'><input name="carNum" id="carNum" style="width:50%;height:44px;line-height:44px;" type="text" value="<?=$carNum?>" placeholder="차량번호"><span style='font-size:11px;position:relative;top:5px'>예) 12가3456</span></div>
			</div>
		</li>

		<li class="li100">
			<div class="formttl1"><span style="color:red">*</span>주소</div>
			<div class="clearfix"><input class="ip_1 ipfl" name="zipcode" id="zipcode" style="width:150px;" type="text" value="<?=$zipcode?>" maxlength='5' placeholder="우편번호">&nbsp;&nbsp;&nbsp;<a href="javascript:openDaumPostcode();" class='bntstyle1'>주소찾기</a>
			
			</div>
		</li>
		<li class="li100">
			<div>
			<input class="ip_1 add001" name="addr01" id="addr01" type="text" value="<?=$addr01?>" placeholder="기본주소" readonly onclick="openDaumPostcode();">
			<input class="ip_1 add002" name="addr02" id="addr02" type="text" value="<?=$addr02?>" placeholder="상세주소">
			</div>
		</li>

		<li class="li100">
			<div class="formttl1"><span style="color:red">*</span>이메일</div>
			<div>
				<input class="ip_1" name="email01" id="email01" style="width:150px;" type="text" value="<?=$email01?>"> @
				<input class="ip_1 ipmt10" name="email02" id="email02" style="width:150px;" type="text" value="<?=$email02?>" placeholder="직접입력">
				<select class="ipmt10" style='border:1px solid #ccc;height:44px;' onchange="document.FRM.email02.value=this.options[this.selectedIndex].value;">
					<option value="">:: 직접입력 ::</option>
					<option value="naver.com">naver.com</option>
					<option value="hanmail.net">hanmail.net</option>
					<option value="gmail.com">gmail.com</option>
					<option value="nate.com">nate.com</option>
					<option value="daum.net">daum.net</option>
					<option value="hotmail.com">hotmail.com</option>
				</select>
			</div>
		</li>

		<li>
			<div class="formttl1"><span style="color:red">*</span>연락처1</div>
			<div class="clearfix">
				<input class="ip_1" name="phone01" id="phone01" style="width:150px;float:left;" type="text" value="<?=$phone01?>" placeholder="연락처">
				<select name="phone01Txt" id="phone01Txt" style="float:left;border:1px solid #ccc;height:44px;">
					<option value="본인" <?if($phone01Txt == '본인'){echo 'selected';}?>>본인</option>
					<option value="부모" <?if($phone01Txt == '부모'){echo 'selected';}?>>부모</option>
					<option value="자녀" <?if($phone01Txt == '자녀'){echo 'selected';}?>>자녀</option>
				</select>
			</div>
		</li>

<?
	if($phone02Txt == '' || $phone02Txt == '본인' || $phone02Txt == '부모' || $phone02Txt == '자녀'){
		$phoneDis = "display:none;";
	}else{
		$phoneDis = '';
	}
?>

		<li>
			<div class="formttl1">연락처2</div>
			<div class="clearfix">
				<input class="ip_1" name="phone02" id="phone02" style="width:150px;float:left;" type="text" value="<?=$phone02?>" placeholder="연락처">
				<select name="phone02Sel" id="phone02Sel" style="float:left;border:1px solid #ccc;height:44px;" onchange="phone02Box();">
					<option value="">:: 선택 ::</option>
					<option value="본인" <?if($phone02Txt == '본인'){echo 'selected';}?>>본인</option>
					<option value="부모" <?if($phone02Txt == '부모'){echo 'selected';}?>>부모</option>
					<option value="자녀" <?if($phone02Txt == '자녀'){echo 'selected';}?>>자녀</option>
					<option value="직접입력" <?if($phone02Txt){echo 'selected';}?>>직접입력</option>
				</select>
				<input class="ip_1" name="phone02Txt" id="phone02Txt" style="width:110px;float:left;<?=$phoneDis?>" type="text" value="<?=$phone02Txt?>" placeholder="관계">
			</div>			
		</li>

	<!--
		<li class="li100">
			<div class="formttl1">비고</div>
			<div>
				<textarea name='memo' id='memo' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$memo?></textarea>
			</div>
		</li>
	-->

<!--
		<tr>
			<th>대상자 자료제공</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="squaredThree">
								<input type="checkbox" value="" id="sT7" name="cok" onclick='setChkBox(this.name,0);'>
								<label for="sT7"></label>
							</div>
							<p style='margin:0 0 0 25px;' class='cok0'>제공안함</p>
						</td>
						<td style='padding:0 0 0 40px;'>							
							<div class="squaredThree">
								<input type="checkbox" value="1" id="sT8" name="cok" onclick='setChkBox(this.name,1);'>
								<label for="sT8"></label>
							</div>
							<p style='margin:0 0 0 25px;' class='cok1'>제공</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
-->
		<li class="li100 chk_iro clearfix" id='cokBox'>
			<div class="formttl1">선호채널</div>
			<div class="vms_wrap clearfix" id="sTypeBox">
				<label class="male ss1" for="cC2">
					<input required type="checkbox" value="문자메세지" id="cC2" name="cokSms" onclick='setClickBox(this.name);' <?if($cokSms){echo 'checked';}?>>
					<div class="box_radio nrb bdtn mbdr">문자메세지</div>			
				</label>

				<label class="female ss1 userType1" for="cC3" style="position:relative">
					<input required type="checkbox" value="이메일" id="cC3" name="cokEmail" onclick='setClickBox(this.name);' <?if($cokEmail){echo 'checked';}?>>
					<div class="box_radio nrb bdtn mbdr">이메일</div>
				</label>
			<!--
				<label class="female ss1 mulpum cms2" for="cC4">
					<input required type="checkbox" value="전화" id="cC4" name="cokPhone" onclick='setClickBox(this.name);' <?if($cokPhone){echo 'checked';}?>>
					<div class="box_radio nrb bdtn mbdr">전화</div>
				</label>
			-->
			</div>
				
		</li>
<!--
		<tr>
			<th>질병 및 건강상태</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr height='40'>
						<td>
							<div class="squaredThree">
								<input type="checkbox" value="심장질환" id="sT1" name="healthList[]" <?if(in_array('심장질환',$healthArr)){echo 'checked';}?>>
								<label for="sT1"></label>
							</div>
							<p style='margin:0 0 0 25px;'>심장질환</p>
						</td>
						<td style='padding:0 0 0 40px;'>
							<div class="squaredThree">
								<input type="checkbox" value="고혈압 및 당뇨" id="sT2" name="healthList[]" <?if(in_array('고혈압 및 당뇨',$healthArr)){echo 'checked';}?>>
								<label for="sT2"></label>
							</div>
							<p style='margin:0 0 0 25px;'>고혈압 및 당뇨</p>
						</td>
						<td style='padding:0 0 0 40px;'>
							<div class="squaredThree">
								<input type="checkbox" value="전염성피부병 및 호흡기질환" id="sT3" name="healthList[]" <?if(in_array('전염성피부병 및 호흡기질환',$healthArr)){echo 'checked';}?>>
								<label for="sT3"></label>
							</div>
							<p style='margin:0 0 0 25px;'>전염성피부병 및 호흡기질환</p>
						</td>
					</tr>

					<tr height='40'>
						<td>
							<table cellpadding='0' cellspacing='0' border='0'>
								<tr>
									<td>
										<div class="squaredThree">
											<input type="checkbox" value="임산부" id="sT4" name="healthList[]" <?if(in_array('임산부',$healthArr)){echo 'checked';}?>>
											<label for="sT4"></label>
										</div>
										<p style='margin:0 0 0 25px;'>임산부</p>
									</td>
									<td style='padding-left:5px;'><input type='text' name='healthBaby' id='healthBaby' value="<?=$healthBaby?>" style='width:60px;' placeholder='주차'></td>
								</tr>
							</table>
						</td>
						<td style='padding:0 0 0 40px;'>
							<table cellpadding='0' cellspacing='0' border='0'>
								<tr>
									<td>
										<div class="squaredThree">
											<input type="checkbox" value="기타" id="sT5" name="healthList[]" <?if(in_array('기타',$healthArr)){echo 'checked';}?>>
											<label for="sT5"></label>
										</div>
										<p style='margin:0 0 0 25px;'>기타</p>
									</td>
									<td style='padding-left:5px;'><input type='text' name='healthEtc' id='healthEtc' value="<?=$healthEtc?>" style='width:150px;'></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<li class="li100">
			<div class="formttl1">가입경로</div>
			<td colspan='3'>
				<input name="joinType" id="joinType" class="ip_1" style="width:150px" type="text" value="<?=$joinType?>">
				<select name='joinTypeTxt' id='joinTypeTxt' style="border:1px solid #ccc;height:44px;" onchange="$('#joinType').val(this.options[this.selectedIndex].value);">
					<option value=''>:: 직접입력 ::</option>
				<?
					for($i=0; $i<count($joinTypeArr); $i++){
						$txt = $joinTypeArr[$i];

						echo ("<option value='$txt'>$txt</option>");
					}
				?>
				</select>
			</td>
		</li>
-->
		<li>
			<div class="formttl1">가입일</div>
			<span id='getDateTxt'><?=$getDate?></span>
			<input type='hidden' name='getDate' id='getDate' value='<?=$getDate?>'>
		</li>
	</ul>
</div>

</div>
<?
	if($type == 'write'){
?>	


	<div class="form_btn_wrap">
		<div class="fbw1 fbw"><a href="javascript:check_form();">가입신청</a></div>
		<div class="fbw2 fbw"><a href="join.php">취&nbsp;&nbsp;&nbsp;&nbsp;소</a></div>
	</div>

<?
	}else{
?>
	<div class="form_btn_wrap">
		<div class="fbw1 fbw"><a href="javascript:check_form();" >정보수정</a></div>
		<div class="fbw2 fbw"><a href="/">취&nbsp;&nbsp;&nbsp;&nbsp;소</a></div>
	</div>
<?
	}
?>





</form>



<script>
$(document).ready(function () {
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

	//주차권발급
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