<script>
	function userLogin(){
		form = document.LOG;
		if(isFrmEmptyModal(form.userid, "아이디를 입력해 주십시오."))	return;
		if(isFrmEmptyModal(form.pwd, "비밀번호를 입력해 주십시오."))	return;

		if(isObject(form.isSave)){
			if(form.isSave.checked==true){
				setCookie("save_userid", "Y", 1);
				setCookie("ck_userid", form.userid.value, 1);
			}else{
				setCookie("save_userid", "", 1);
			}
		}

		form.target = 'ifra_login';
		form.action = '/module/login/login_proc.php';
		form.submit();
	}
</script>

<iframe name='ifra_login' src='about:blank' width='0' height='0' frameborder='0' scrolling='no' style='display:none;' title="로그인"></iframe>

<form name='LOG' method='post' action=''>
	<style>
	@media only screen and (max-width:600px){
		.login_btn p{font-size:1.1em;}
		.bt_btn a{font-size:1.4em;}
		.lg_btn a{font-size:1.1em;}
	}
</style>

<form name='LOG' method='post' action='/module/login/login_proc.php'>
	<div class="order_wrap noborder">
		<div class="login_st">
			<div class="login-id">
				<label for="userid"><input type="email" name='userid' value='' placeholder="아이디" style='ime-mode:disabled;' onkeypress="if(event.keyCode==13){userLogin();}"></label>
			</div>
			<div class="login-pw">
				<label for="pwd"><input type="password" name='pwd' value=''  placeholder="비밀번호" class='pwdBox' onkeypress="if(event.keyCode==13){userLogin();}"></label>
			</div>

			
			<div class="id-chk clearfix">
				<div class="squaredThree">
					<input type="checkbox" value="None" id="squaredThree" name="isSave" />
					<label for="squaredThree"></label>
				</div>
				<p>아이디 저장</p>
			</div>
		</div>

		<div class="login-btn">
			<a class="login_go" href="javascript:userLogin();">로그인</a>
		</div>

		<div class="find-btn">
			<a href="join.php">회원가입</a>
			<a href="search01.php" class="IdPwd_open">아이디/비밀번호 찾기</a>
		</div>
	</div>

</form>


<link type='text/css' rel='stylesheet' href='/module/js/placeholder.css'><!-- 웹킷브라우져용 -->
<script src="/module/js/jquery.placeholder.js"></script><!-- placeholder 태그처리용 -->
<script>
	$('input, textarea').placeholder();
	if('<?=$GBL_USERID?>' == ''){
		set_auto('0');
	}
</script>