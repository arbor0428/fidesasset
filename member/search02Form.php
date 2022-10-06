<script language="javascript">
	function searchPWD(){
		frm = document.frm01;
		if(isFrmEmptyModal(frm.f_userid, "아이디를 입력해 주십시오."))	return;
		if(isFrmEmptyModal(frm.f_name, "회원 닉네임을 입력해 주십시오."))	return;
		if(isFrmEmptyModal(frm.f_email, "회원 이메일 주소를 입력해 주십시오"))	return;

		id = setTimeout(function(){
			var params = jQuery("#frm01").serialize();
			jQuery.ajax({
				url: '../module/searchPWD.php',
				type: 'POST',
				data:params,
				dataType: 'html',
				success: function(result){
					if(result == 'ok'){
						GblMsgBox('기재하신 이메일로 신규 비밀번호가 발급되었습니다.',"location.href='/';");
						return;

					}else{
						GblMsgBox('입력하신 정보와 일치하는 회원 정보가 없습니다.','');
						return;
					}
				},
				error: function(error){
					GblMsgBox('전송오류');
					return;
				}
			});
		}, 100);
	}
</script>

<form name='frm01' id='frm01' method='post' action=''>

	<div class="order_wrap">
		<div class="order_info_wrap">	
			<table class="login_st">
				<tr>
					<td><label for="f_userid"><input type="text" name='f_userid' placeholder="아이디를 입력하세요" class="login_id input" onkeypress="if(event.keyCode==13){searchPWD();}"></label></td>
				</tr>
				<tr>
					<td><label for="f_name"><input type="text" name='f_name' placeholder="이름을 입력하세요" class="login_id input" onkeypress="if(event.keyCode==13){searchPWD();}"></label></td>
				</tr>
				<tr>
					<td><label for="f_email"><input type="text" name='f_email' placeholder="이메일 주소를 입력하세요" class="login_pw input" onkeypress="if(event.keyCode==13){searchPWD();}"></label></td>
				</tr>
			</table>	
		</div>

		<div class="login-btn">
			<a class="login_go" href="javascript:searchPWD();">입력완료</a>
		</div>
		<div class="find-btn">
			<a href="join.php">회원가입</a>
			<a href="search01.php" class="IdPwd_open">아이디찾기</a>
		</div>
	</div>

</form>