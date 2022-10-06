<?
	include 'head.php';

	if($GBL_MTYPE == 'A' || $GBL_MTYPE == 'M'){
		Msg::goNext('/adm/');
		exit;
	}
?>

<script>
function masterLogin(){
	form = document.frmLogin;

	if(isFrmEmptyModal(form.userid,"아이디를 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.pwd,"비밀번호를 입력해 주십시오."))	return;

	form.target = 'ifra_gbl';
	form.submit();
}
</script>

<link rel="stylesheet" href="/login/css/style.css">
<script src="/login/js/script.js"></script>


<form name='frmLogin' class="user" method='post' action='/module/login/login_proc.php'>
<input type='text' style='display:none;'>
<style>
.videowrap {position: relative;width:100%;height:100%;}
.videowrap::before {
        content: "";
        background: url(/images/login_bg.jpg) center center;
        background-size: cover;
        opacity: 0.5;
        position: absolute;
        top: 0px;
        left: 0px;
        right: 0px;
        bottom: 0px;
}
</style>
<div id="login_container">
	<div class="videowrap" >
		<!--
		<video autoplay loop muted>
			<source src="/images/production ID_5183314.mp4">
		</video>
		<div class="video_bg"></div>
		-->
	</div>
	<!-- <a class="homeBtn" href="#" title="홈으로">홈버튼</a> -->
	<div class="loginWrap">
		<!-- <h1 class="logo"><a href="#"><img src="/images/logo.png" alt="logo"></a></h1> -->
		<a class="useBtn" href="#" title="useBtn">오스틴제약 쇼핑몰이동</a>
		<div class="loginBox">
			<!-- <h2>스터디센스 로그인</h2> -->
			<div class="id_box">
				<input id="id" name="userid" type="text" placeholder="아이디" onkeypress="if(event.keyCode==13){masterLogin();}">
			</div>
			<div class="pass_box">
				<input id="password" name="pwd" type="password" placeholder="비밀번호" onkeypress="if(event.keyCode==13){masterLogin();}">
			</div>
			<a id="login_btn" href='javascript:masterLogin();'>로그인</a>
			<div style='text-align:center;'>
				<a href='./member.php' class="dt">회원가입</a>
			</div>
		</div>

	</div>
</div>
</form>
<?
	include '../module/popupoverlay.php';
?>