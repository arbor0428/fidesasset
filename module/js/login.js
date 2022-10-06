function login(pos)
{
	if(pos=="0")
		var form = document.LOG;
	else
		var form = document.LOG2;

	if(isFrmEmpty(form.userid, "아이디를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.pwd, "비밀번호를 입력해 주십시오"))	return;

	if(isObject(form.isSave)){
		if(form.isSave.checked==true){
			setCookie("save_userid", "Y", 1);
			setCookie("ck_userid", form.userid.value, 1);
		}else{
			setCookie("save_userid", "", 1);
		}
	}

	form.submit();
}

function set_auto(pos)
{
	if(pos=="0")
		var form = document.LOG;
	else
		var form = document.LOG2;

	save_userid = getCookie("save_userid");
	if(save_userid=="Y"){
		form.isSave.checked = true;
		form.userid.value = getCookie("ck_userid");
	}
}

function logout()
{
	 
	top.location.href = "/module/login/logout_proc.php";
}

function logoutA()
{
	location.href = "/module/login/logout_proc.php?ptype=A";
}

function isEnter(pos)
{
	if(event.keyCode==13)
		login(pos);
}


function flash(c,d,e) {
 var flash_tag = "";
 flash_tag = '<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ';
 flash_tag +='codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" ';
 flash_tag +='WIDTH="'+c+'" HEIGHT="'+d+'" >';
 flash_tag +='<param name="wmode" value="transparent">'; 
 //이부분은 플래쉬 배경을 투명으로 설정하는 부분으로 필요없다면 삭제해도 무방함
 flash_tag +='<param name="movie" value="'+e+'">';
 flash_tag +='<param name="quality" value="high">';
 flash_tag +='<embed src="'+e+'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" ';
 flash_tag +='type="application/x-shockwave-flash"  WIDTH="'+c+'" HEIGHT="'+d+'"></embed></object>'
 document.write(flash_tag);
}

function admin()
{
	var form = document.LOG;

	if(isFrmEmpty(form.userid, "아이디를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.pwd, "비밀번호를 입력해 주십시오"))	return;

	if(form.pwd.value!=form.h_pwd.value){
		alert("로그인 실패");
		form.pwd.focus();
		return;
	}

	form.submit();
}



