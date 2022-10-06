<script language="javascript">
	function searchID(){
		frm = document.frm01;
		if(isFrmEmptyModal(frm.f_name, "이름을 입력해 주십시오."))	return;
		if(isFrmEmptyModal(frm.f_email, "이메일 주소를 입력해 주십시오."))	return;

		id = setTimeout(function(){
			var params = jQuery("#frm01").serialize();
			jQuery.ajax({
				url: '../module/searchID.php',
				type: 'POST',
				data:params,
				dataType: 'html',
				success: function(result){
					if(result){
						GblMsgBox('회원아이디 : '+result,'');
						return;

					}else{
						GblMsgBox('입력하신 정보와 일치하는 아이디 정보가 없습니다.','');
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
					<td><label for="f_name"><input type="text" name='f_name' placeholder="이름을 입력하세요" class="login_id input" onkeypress="if(event.keyCode==13){searchID();}"></label></td>
				</tr>
				<tr>
					<td><label for="f_email"><input type="text" name='f_email' placeholder="이메일 주소를 입력하세요" class="login_pw input" onkeypress="if(event.keyCode==13){searchID();}"></label></td>
				</tr>
			</table>
		</div>

		<div class="login-btn">
			<a class="login_go" href="javascript:searchID();">입력완료</a>
		</div>
		<div class="find-btn">
			<a href="join.php">회원가입</a>
			<a href="search02.php" class="IdPwd_open">비밀번호찾기</a>
		</div>
	</div>

</form>