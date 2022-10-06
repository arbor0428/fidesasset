<script language='javascript'>
function checkID(c){
	form = document.FRM;

	if(isFrmEmpty(form.userid,"아이디를 입력해 주십시오."))	return true;

	ID = form.userid.value;

	for( var i=0 ; i < ID.length ; i++ ){
		if( i == 0 ){
			if( (ID.charAt(i) >= '0' && ID.charAt(i) <= '9') ){
				alert("아이디 첫글자는 영문이어야 합니다.");
				form.userid.focus();
				return true;
			}
		}
	}

	if(!isAlphaModal(form.userid, "아이디는 영문자와 숫자만 입력해 주세요."))	return true;

	if(ID.length < 4 || ID.length > 12){
		alert("아이디는 4~12자 이내입니다.");
		form.userid.focus();
		return true;
	}

	if(c){
		userid = $('#userid').val();

		$.post('../module/common/UserIdCheck.php',{'userid':userid}, function(cnt){
			if(cnt != 0){
				alert('사용할 수 없는 아이디입니다.');
				form.userid.focus();

			}else{
				alert('사용 가능한 아이디입니다.');
				form.pwd.focus();
			}
		});
	}
}

function check_form(){
	form = document.FRM;

	//아이디 유효성검사
	if(checkID())	return;

	userid = $('#userid').val();

	$.post('../module/common/UserIdCheck.php',{'userid':userid}, function(cnt){
		if(cnt != 0){
			alert('사용할 수 없는 아이디입니다.');
			form.userid.focus();

		}else{
			if(isFrmEmpty(form.pwd,"비밀번호를 입력해 주십시오."))	return;
			if(isFrmEmpty(form.re_pwd,"비밀번호를 한번더 입력해 주십시오."))	return;

			PWD = form.pwd.value;

			if(form.pwd.value != form.re_pwd.value){
				alert("비밀번호를 확인해 주십시오.");
				form.re_pwd.focus();
				return;
			}

			if(PWD.length < 6 || PWD.length > 10){
				alert("비밀번호는 6~10자 이내입니다.");
				form.pwd.focus();
				return;
			}

			if(isFrmEmpty(form.name,"사용자명을 입력해 주십시오."))	return;

			form.type.value = 'write';
			form.target = '';
			form.action = 'tutorProc.php';
			form.submit();
		}
	});
}

function pwdChk(){
	pwd01 = $('#pwd').val();
	pwd02 = $('#re_pwd').val();

	pwdTxt = '';
	pwdColor = '#fff';

	if(pwd01 && pwd02){
		if(pwd01 == pwd02){
			pwdTxt = '비밀번호 일치';
			pwdColor = '#0000ff';
		}else{
			pwdTxt = '비밀번호 불일치';
			pwdColor = '#ff0000';
		}
	}

	$('#pwdTxt').css('color',pwdColor);
	$('#pwdTxt').text(pwdTxt);
}
</script>