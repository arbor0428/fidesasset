<script language='javascript'>
function searchChk(){
	form = document.frm_search;
	
	if(isFrmEmpty(form.sokNum, "인증번호를 입력해 주십시오"))	return;

	form.target = 'ifra_gbl';
	form.action = 'searchUserChk.php';
	form.submit();
}

function smsSend(){
	form = document.frm_search;

	if(isFrmEmpty(form.sname, "회원자명을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.suserNum, "생년월일을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.suserMobile, "휴대폰번호를 입력해 주십시오"))	return;

	id = setTimeout(function(){
		var params = jQuery("#frm_search").serialize();
		jQuery.ajax({
			url: '../module/JoinSmsSend.php',
			type: 'POST',
			data:params,
			dataType: 'html',
			success: function(result){
				if(result == '200'){
					$('#sname').prop('readonly',true);
					$('#fpicker2').prop('readonly',true);
					$('#suserMobile').prop('readonly',true);
					$('#okBtn').html("<input type='button' class='btn_notice_reg' value='인증번호 확인' onclick='searchChk();'>");
					$('#okNumChk').fadeIn();
					return;

				}else if(result == 'userid'){
					alert('이미 아이디가 발급된 회원입니다.');
					return;

				}else if(result == 'done'){
					alert('일치하는 회원정보가 없습니다.');
					return;
				}
			},
			error: function(error){
				alert('통신오류');
				return;
			}
		});
	}, 100);
}

$(function(){
	$('.IdPwd_close').click(function(){
		$('#sname').val('');
		$('#fpicker2').val('');
		$('#suserMobile').val('');
		$('#sokNum').val('');
		$('#okNumChk').hide();
		$('#okBtn').html("<input type='button' class='btn_notice_reg' value='확인' onclick='smsSend();'>");
	});
});
</script>

<!-- 아이디/비번찾기 -->
<div id="IdPwd" class="popup_background" style="min-width:250px;display:none;">
	<div class="popup_notice">
		<div class="clearfix">
			<div class="img_clear"><img src="/module/popupoverlay/ico_notice.gif"></div>
			<div class="pop_ttl0" id='multi_ttl'>회원정보찾기</div>
			<div class="cls_buttonali"><button class="IdPwd_close close_button_pop"></button></div>
		</div>

		<form name='frm_search' id='frm_search' method='post' action=''>
		<table cellpadding='0' cellspacing='0' border='0' style='width:400px;margin-top:15px;' class='zTable'>
			<tr>
				<th width='25%'>회원자명</th>
				<td width='75%'><input name="sname" id="sname" type="text" value='' style='width:100%;height:32px;' placeholder="회원자명을 입력해 주십시오."></td>
			</tr>
			<tr height='40'>
				<th>생년월일</th>
				<td><input name="suserNum" id="fpicker2" type="text" value='' style='width:100%;height:32px;' placeholder="생년월일을 입력해 주십시오." readonly></td>
			</tr>
			<tr height='40'>
				<th>휴대폰번호</th>
				<td><input name="suserMobile" id="suserMobile" type="text" value='' style='width:100%;height:32px;' placeholder="휴대폰번호를 입력해 주십시오." class="numberOnly" maxlength='11'></td>
			</tr>

			<tr height='40' id='okNumChk' style='display:none;'>
				<th>인증번호</th>
				<td><input name="sokNum" id="sokNum" type="text" value='' style='width:100%;height:32px;' placeholder="인증번호를 입력해 주십시오." onkeypress="if(event.keyCode==13){searchChk();}"></td>
			</tr>
		</table>	
		<div class="exp_findip" style='margin:5px 0 25px 0;font-size:12px;float:right;' id='okTxt'>(기존에 가입된 정보를 불러올 수 있습니다.)</div>
		</form>

		<div class="btn_ali_pop2" id="okBtn"><input type="button" class="btn_notice_reg" value="확인" onclick='smsSend();'></div>
	</div>
</div>

<!-- 팝업 스크립트 -->
<script>
$(document).ready(function () {
	$('#IdPwd').popup({
		transition: 'all 0.3s',
		blur: false,
		escape:false,
		scrolllock: true
	});
});
</script>
<!-- 팝업 스크립트 -->