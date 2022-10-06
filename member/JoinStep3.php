<?
	if($type == 'write')	include 'JoinTop.php';

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

		$uid = $row["uid"];
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
		$bank = $row["bank"];
		$accName = $row["accName"];
		$account = $row["account"];
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
		$upfile02 = $row["upfile02"];
		$realfile02 = $row["realfile02"];
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

		$chkList01 = $row["chkList01"];
		$chkList02 = $row["chkList02"];


		$healthArr = explode(',',$health);

		//비고
//		if($memo)	$memo = Util::textareaDecodeing($memo);

	}else{
		$status = '2';
		$healthArr = Array();
		$getDate = date('Y-m-d');
		$cokEmail = '1';
		$cokSms = '1';

		//kcb인증관련
		$kcbNo = $_POST['kcbNo'];
		$kcbName = $_POST['kcbName'];
		$kcbBdate = $_POST['kcbBdate'];
		$kcbSex = $_POST['kcbSex'];
		$kcbMobile = $_POST['kcbMobile'];



		$name = $kcbName;
		$bDate = $kcbBdate;
		$sex = $kcbSex;
		$phone01 = $kcbMobile;

		//본인인증체크
		$kcbChk = true;

		if($kcbNo){
			$userip = $_SERVER['REMOTE_ADDR'];

			$sql = "select * from ks_kcb_log where TX_SEQ_NO='$kcbNo' and (RSLT_CD='B000' || RSLT_CD='T000') and userip='$userip'";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			if($num){
				$kcbChk = true;
			}
		}

		if($_SERVER['REMOTE_ADDR'] == '106.246.92.237'){
			$kcbChk = true;
		}

		if($kcbChk == false){
			Msg::backMsg('접근오류');
			exit;
		}
	}


	include 'script.php';
?>

<style type='text/css'>
.zTable th, .zTable td{font-size:14px;}
.zTable .w1{width:250px;}
.zTable .w2{width:250px;}

.zTable input[type=text]{font-size:14px;}

label{cursor:pointer;}

.join_btn{font-size:12px;}

.addr li{clear:both;width:100%;}
.addr li:nth-child(2){margin:7px 0;}
.addr li input{max-width:500px;}
.selectBox{width:80px;padding-left:10px;color:#777;font-size:16px;}

.btn_con {
    color: #fff;
    text-align: center;
    margin-top: 30px;
}
.join_f_btn {
    padding: 10px 20px !important;
    text-align: center;
    font-size: 14px;
}
.btn_st2 {
    display: inline-block;
    padding: 0 15px 2px 15px;
    color: #9a8c7e;
    background-color: #c7c7c7;
    line-height: 32px;
}
.btn_st1 {
    display: inline-block;
    padding: 0 15px 2px 15px;
    color: #fff;
    background-color: #043b73;
    line-height: 32px;
}
.btn_st1:hover {
    color: #fff;
    background-color: #f47c46;
}
.btn_st3 {
    display: inline-block;
    padding: 2px 20px 3px 20px;
    color: #9a8c7e;
    background-color: #999;
    line-height: 30px;
	border-radius:5px
}
.btn_st3:hover {
    color: #fff;
    background-color: #f47c46;
}

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
	display:block;
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
.eq2{background:none;}
</style>

<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='dbfile01' value='<?=$upfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>
<input type='hidden' name='dbfile02' value='<?=$upfile02?>'>
<input type='hidden' name='realfile02' value='<?=$realfile02?>'>
<input type='hidden' name='status' value=''>


<div class="contents">
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<caption></caption>
		<colgroup>
			<col width='20%'>
			<col width='80%'>
		</colgroup>
	<?
		if($type == 'write'){
	?>
		<tr>
			<th><span class='eq'></span>아이디</th>
			<td>
				<label for="userid"><input type='text' name='userid' id='userid' value='<?=$userid?>' style='text-transform:lowercase;' class='textBox01 w1'></label> 
				<a class="btn_st3 join_btn pers1" style="color:#fff;" href="javascript:checkID(1);">중복체크</a>
			</td>
		</tr>
		<tr>
			<th><span class='eq'></span>비밀번호</th>
			<td><label for="pwd"><input type='password' name='pwd' id='pwd' value='' class='textBox01 w1' onkeyup='pwdChk();' placeholder='※ 영문 대/소문자~'></label> </td>
		</tr>
		<tr>
			<th><span class='eq'></span>비밀번호 확인</th>
			<td><label for="re_pwd"><input type='password' name='re_pwd' id='re_pwd' value='' class='textBox01 w1' onkeyup='pwdChk();'></label>  <span id='pwdTxt'></span></td>
		</tr>
	<?
		}else{
	?>
		<tr>
			<th><span class='eq'></span>아이디</th>
			<td><?=$userid?><label for="userid"><input class="ip_1 join_id ipfl" type='hidden' name='userid' id='userid' value='<?=$userid?>'></label></td>
		</tr>
		<tr>
			<th><span class='eq'></span>비밀번호</th>
			<td><label for="pwd"><input type='password' name='pwd' id='pwd' value='' class='textBox01 w1' placeholder='※ 변경시에만 입력'></label></td>
		</tr>
	<?
		}
	?>

		<tr>
			<th><span class='eq'></span>성명</th>
			<td><label for="name"><input type='text' name='name' value='<?=$name?>' class='textBox01 w1'></label></td>
		</tr>

		<tr>
			<th><span class='eq'></span>성별</th>
			<td>
				<label for="s1"><input type="radio" value="남" id="s1" name="sex" <?if(!$sex || $sex == '남'){echo 'checked';}?>>남</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<label for="s2"><input type="radio" value="여" id="s2" name="sex" <?if($sex == '여'){echo 'checked';}?>>여</label>
			</td>
		</tr>

		<tr>
			<th><span class='eq'></span>생년월일</th>
			<td><label for="bDate"><input type='text' name='bDate' id='fpicker1' value='<?=$bDate?>' class='textBox01' readonly></label></td>
		</tr>
		
		<tr>
			<th><span class='eq'></span>회원구분</th>
			<td>
				<label for="s3"><input type="radio" value="일반" id="s3" name="userType" <?if(!$userType || $userType == '일반'){echo 'checked';}?> onclick='setChkBox(this.name,0);'>일반회원</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<label for="s4"><input type="radio" value="약사" id="s4" name="userType" <?if($userType == '약사'){echo 'checked';}?> onclick='setChkBox(this.name,1);'>약사회원</label>
			</td>
		</tr>

		<tr id="saleBox02" <?if($userType == '일반' || $userType == ''){echo "style='display:none;'";}?>>
			<th><span class='eq'></span>사업자등록증</th>
			<td>
				<div class="file_input">
					<input type="text" readonly title="File Route" id="file_route01" style="width:250px;padding:0 0 0 10px;" class="textBox01" placeholder="사업자등록증 서류를 첨부해주세요.">
					<label>파일선택<input type="file" name="upfile01" id="upfile01" onchange="fileChk('01');"></label>
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
			</td>
		</tr>

		<tr id="saleBox03" <?if($userType == '일반' || $userType == ''){echo "style='display:none;'";}?>>
			<th><span class='eq'></span>약사면허증</th>
			<td>
				<div class="file_input">
					<input type="text" readonly title="File Route" id="file_route02" style="width:250px;padding:0 0 0 10px;" class="textBox01" placeholder="약사면허증 서류를 첨부해주세요.">
					<label>파일선택<input type="file" name="upfile02" id="upfile02" onchange="fileChk('02');"></label>
				</div>


			<?
				if($upfile02){
			?>	
				<div style="margin-top:10px">
					<div class="squaredThree" style="float:left;">
						<input type="checkbox" value="Y" id="fDel" name="del_upfile02">
						<label for="fDel"></label>
					</div>
					<p style='margin:0 0 0 25px;float:left' >삭제&nbsp;&nbsp;(<?=$realfile02?>)</p>
					<a style="margin-left:5px" href="javascript:filedownload();" class='small cbtn green'>다운로드</a>
				</div>
			<?
				}
			?>	
			</td>
		</tr>

		<tr style='display:none;'>
			<th><span class='eq'></span>차량소유</th>
			<td>
				<label for="c1"><input type="radio" value="" id="c1" name="car" onclick='setChkBox(this.name,0);' <?if($car == ''){echo 'checked';}?>>아니오</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<label for="c2"><input type="radio" value="예" id="c2" name="car" onclick='setChkBox(this.name,1);' <?if($car == '예'){echo 'checked';}?>>예</label>
			</td>
		</tr>

		<tr id='carBox' style='display:none;'>
			<th><span class='eq'></span>차량번호</th>
			<td><label for="carNum"><input name="carNum" id="carNum" class='textBox01' type="text" value="<?=$carNum?>" placeholder="차량번호"><span style='font-size:11px;position:relative;top:5px'></label></td>
		</tr>

		<tr>
			<th><span class='eq'></span>주 소</th>
			<td class='addr'>
				<li><label for="zipcode"><input type='text' name='zipcode' id='zipcode' value='<?=$zipcode?>' style="width:100px;" class='textBox01' placeholder='우편번호' maxlength='5' oninput="maxLengthCheck(this)"></label> <a class="btn_st3 join_btn" style="color:#fff;" href="javascript:openDaumPostcode();">주소검색</a></li>
				<li><label for="addr01"><input type='text' name='addr01' id='addr01' value='<?=$addr01?>' style="width:100%;" class='textBox01'></label></li>
			<!--
				<li><input type='text' name='addr02' id='addr02' value='<?=$addr02?>' style="width:100%;" class='textBox01' placeholder='상세주소'></li>
			-->
			</td>
		</tr>

		<tr style='display:none;'>
			<th><span class='eq'></span>계좌정보</th>
			<td>
				<label for="bank"><input class="textBox01" name="bank" id="bank" style="width:150px;" type="text" value="<?=$bank?>" placeholder="은행명"></label>
				<label for="accName"><input class="textBox01" name="accName" id="accName" style="width:150px;" type="text" value="<?=$accName?>" placeholder="예금주"></label>
				<label for="account"><input class="textBox01" name="account" id="account" style="width:150px;" type="text" value="<?=$account?>" placeholder="계좌번호"></label>
			</td>
		</tr>

		<tr>
			<th><span class='eq'></span>이메일</th>
			<td>
				<label for="email01"><input class="textBox01" name="email01" id="email01" style="width:150px;" type="text" value="<?=$email01?>"></label> @
				<label for="email02"><input class="textBox01 ipmt10" name="email02" id="email02" style="width:150px;" type="text" value="<?=$email02?>" placeholder="직접입력"></label>
				<label>
					<select class="ipmt10 textBox01" style='border:1px solid #ccc;padding:5px 25px 5px 5px' onchange="document.FRM.email02.value=this.options[this.selectedIndex].value;">
						<option value="">:: 직접입력 ::</option>
						<option value="naver.com">naver.com</option>
						<option value="hanmail.net">hanmail.net</option>
						<option value="gmail.com">gmail.com</option>
						<option value="nate.com">nate.com</option>
						<option value="daum.net">daum.net</option>
						<option value="hotmail.com">hotmail.com</option>
					</select>
				</label>
			</td>
		</tr>


		<tr>
			<th><span class='eq'></span>연락처</th>
			<td>
				<label for="phone01"><input class="textBox01" name="phone01" id="phone01" style="width:150px;float:left;" type="text" value="<?=$phone01?>" placeholder="연락처"></label>
			</td>
		</tr>

		<tr>
			<th><span class='eq'></span>이메일 수신동의</th>
			<td>
				<div>오스틴제약(주)에서 발송하는 이메일을 받아보시겠습니까?</div>
				<label for="ec1"><input type="radio" value="1" id="ec1" name="cokEmail" <?if($cokEmail){echo 'checked';}?>>예</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<label for="ec2"><input type="radio" value="" id="ec2" name="cokEmail" <?if($cokEmail == ''){echo 'checked';}?>>아니오</label>
				
			</td>
		</tr>

		<tr>
			<th><span class='eq'></span>문자 수신동의</th>
			<td>
				<div>오스틴제약(주)에서 발송하는 안내문자를 받아보시겠습니까?</div>
				<label for="sc1"><input type="radio" value="1" id="sc1" name="cokSms" <?if($cokSms){echo 'checked';}?>>예</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<label for="sc2"><input type="radio" value="" id="sc2" name="cokSms" <?if($cokSms == ''){echo 'checked';}?>>아니오</label>
			</td>
		</tr>

		<tr style='display:none;'>
			<th><span class='eq'></span>가입일</th>
			<td>
				<span id='getDateTxt'><?=$getDate?></span>
				<label for="getDate"><input type='hidden' name='getDate' id='getDate' value='<?=$getDate?>'></label>
			</td>
		</tr>
	</table>
</div>

</div>
<?
	if($type == 'write'){
?>	


		<div class="btn_con">
			<a class="btn_st2 join_f_btn" style="color:#fff;margin-right:10px;" href="/">회원가입 취소</a>
			<a class="btn_st1 join_f_btn" style="color:#fff;" href="javascript:check_form();">회원가입 신청</a>					
		</div>

<?
	}else{
?>



		<div class="btn_con">
			<a class="btn_st2 join_f_btn" style="color:#fff;margin-right:10px;" href="/">취소</a>
			<a class="btn_st1 join_f_btn" style="color:#fff;" href="javascript:check_form();">정보수정</a>			
			<a class="btn_st1 join_f_btn" style="color:#fff;margin-left:10px;background:#ce0606" href="javascript:class_del();">회원탈퇴</a>			
		</div>

<?
	}
?>


</form>