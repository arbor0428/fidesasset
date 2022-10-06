<?
	include "../module/login/head.php";
	include "../module/class/class.DbCon.php";
	include "../module/class/class.Util.php";
	include "../module/class/class.Msg.php";
?>
<html >
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="euc-kr">
<meta name="viewport" content="width=1300, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
<meta name="viewport" content="width=1300">
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />

<meta property="og:url" content="http://ggwc.i-sign.kr">
<meta property="og:title" content="광교종합사회복지관">
<meta property="og:type" content="website">
<meta property="og:image" content="http://ggwc.i-sign.kr/images/logo.png">
<meta property="og:description" content="광교종합사회복지관">
<title>광교종합사회복지관</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="/module/js/jquery.popupoverlay.js"></script>
<script type="text/javascript" src="/module/js/common.js"> </script> 

<link rel="stylesheet" type="text/css" href="/module/js/style.css">
<link rel="stylesheet" type="text/css" href="/module/js/button.css">
<link rel="stylesheet" type="text/css" href="/module/js/NanumGothic.css">
<link type='text/css' rel='stylesheet' href='/module/js/admin.css'>

<link type='text/css' rel='stylesheet' href='/module/js/placeholder.css'><!-- 웹킷브라우져용 -->
<script src="/module/js/jquery.placeholder.js"></script><!-- placeholder 태그처리용 -->
</head>

<?
	include 'tutorScript.php';
?>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value=''>


<div style='width:100%;'>
	<div class='mCadeTit02' style='margin-bottom:10px;'>강사등록신청</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='formTable'>
		<tr>
			<th><div class='eqc'>*</div>아이디</th>
			<td colspan='3'><input name="userid" id="userid" style="width:250px;" type="text" value="">  <a href="javascript:checkID(1);" class="super cbtn black">중복체크</a></td>
		</tr>

		<tr>
			<th><div class='eqc'>*</div>비밀번호</th>
			<td colspan='3'><input name="pwd" id="pwd" style="width:250px;" type="password" onkeyup='pwdChk();'> ※ 6자 ~ 10자 이내</td>
		</tr>

		<tr>
			<th><div class='eqc'>*</div>비밀번호 확인</th>
			<td colspan='3'><input name="re_pwd" id="re_pwd" style="width:250px;" type="password" onkeyup='pwdChk();'> <span id='pwdTxt'></span></td>
		</tr>

		<tr>
			<th><div class='eqc'>*</div>사용자명</th>
			<td colspan='3'><input name="name" id="name" style="width:250px;" type="text" value="<?=$name?>"></td>
		</tr>

		<tr>
			<th>휴대전화</th>
			<td colspan='3'>
				<select name='mobile01' id='mobile01' style='border:1px solid #ccc;width:70px;height:30px;'>
					<option value=''>==</option>
					<option value='010' <?if($mobile01 == '010'){echo 'selected';}?>>010</option>
					<option value='011' <?if($mobile01 == '011'){echo 'selected';}?>>011</option>
					<option value='016' <?if($mobile01 == '016'){echo 'selected';}?>>016</option>
					<option value='017' <?if($mobile01 == '017'){echo 'selected';}?>>017</option>
					<option value='018' <?if($mobile01 == '018'){echo 'selected';}?>>018</option>
					<option value='019' <?if($mobile01 == '019'){echo 'selected';}?>>019</option>
				</select> - 
				<input name="mobile02" id="mobile02" style="width:75px;" type="text" value="<?=$mobile02?>" class='numberOnly' maxlength='4'> - 
				<input name="mobile03" id="mobile03" style="width:75px;" type="text" value="<?=$mobile03?>" class='numberOnly' maxlength='4'>
			</td>
		</tr>

		<tr>
			<th>이메일</th>
			<td colspan='3'>
				<input name="email01" id="email01" style="width:150px;" type="text" value="<?=$email01?>"> @
				<input name="email02" id="email02" style="width:150px;" type="text" value="<?=$email02?>" placeholder="직접입력">
				<select style='border:1px solid #ccc;height:30px;' onchange="document.FRM.email02.value=this.options[this.selectedIndex].value;">
					<option value="">:: 직접입력 ::</option>
					<option value="naver.com">naver.com</option>
					<option value="hanmail.net">hanmail.net</option>
					<option value="gmail.com">gmail.com</option>
					<option value="nate.com">nate.com</option>
					<option value="daum.net">daum.net</option>
					<option value="hotmail.com">hotmail.com</option>
				</select>
			</td>
		</tr>
	</table>

	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td align='center' style='padding:30px 0;'>
				<a href="javascript:check_form();" class='big cbtn blue'>등록신청</a>
			</td>
		</tr>
	</table>
</div>

</form>