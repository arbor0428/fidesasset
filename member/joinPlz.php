<script language='javascript'>
function check_form(){
	if($('#ot1').is(":checked") == false){
		GblMsgBox('개인정보 수집 및 활용에 동의해 주십시오.','');
		return;
	}

	if($('#ot2').is(":checked") == false){
		GblMsgBox('서비스 이용약관에 동의해 주십시오.','');
		return;
	}

	form = document.FRM;
	form.type.value = 'write';
	form.target = '';
	form.action = "<?=$PHP_SELF?>";
	form.submit();
}
</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>

<div>
	<div class="con_margin20"></div>
	<div class="subcon_ttl w100">
		<div class="sut_01">개인정보 수집 및 활용 동의</div>
		<div class="sut_02"><img src='/images/sub/sub_cloud.png'></div>
	</div>
	
	<div class="con_margin20"></div>
	<div class="agree_form01 bgc_fff bdtb"  style="background:#f9f9f9">
		<div class="tac_agree">
			기관의 서비스 이용을 위해 귀 기관이 본인의 개인정보를 수집 · 이용하고자 하는경우에는<br>[개인정보보호법] 제15조 및 제22조의 동의를 얻어야합니다. 
		</div>
		<br>
		
		1.개인정보 수집·이용목적 : 회원관리를 위한 정보수집 및 복지관 소식전달을 위한 수집<br>
		2.수집하는 개인정보 항목 : 성명, 연락처, 주소, 이메일 <br>
		3.개인정보 보유·이용기간 : <span class="boldtxt">동의일로 부터 동의 철회 시 까지</span><br>
		4.동의거부 권리안내 : <span  class="boldtxt">귀하는 상기 동의를 거부할 수 있습니다. 다만, 이에 대한 동의를	하지 않을 경우에
		은평문화재단 홈페이지의 기능관련하여 정상적인 서비스 제공이 불가능 할 수 있음을 알려드립니다.</span>
	</div>
	<div class="agree_wrap clearfix">
		<div class="fr">
			<div class="squaredThree">
				<input type="checkbox" value="1" id="ot1" name="ok01">
				<label for="ot1"></label>
			</div>
			<div class="agreeex">위 개인정보 수집 및 활용에 동의합니다.</div>
		</div>
	</div>
		
	<div class="con_margin40"></div>
	<div class="subcon_ttl w100">
		<div class="sut_01">서비스 이용약관 동의</div>
		<div class="sut_02"><img src='/images/sub/sub_cloud.png'></div>
	</div>

	<div class="con_margin20"></div>
	<textarea class="agree_form01 bgc_fff bdtb"  style="width:100%;height:200px;border-right:none;border-left:none;background:#f9f9f9;resize:none;"><?include 'policy2.php'?></textarea>
	<div class="agree_wrap clearfix">
		<div class="fr">
			<div class="squaredThree">
				<input type="checkbox" value="1" id="ot2" name="ok01">
				<label for="ot2"></label>
			</div>
			<div class="agreeex">위 서비스 이용약관에 동의합니다.</div>
		</div>
	</div>
</div>
</div>
	<div class="form_btn_wrap">
		<div class="fbw1 fbw"><a href="javascript:check_form();">가입진행</a></div>
		<div class="fbw2 fbw"><a href="/">취&nbsp;&nbsp;&nbsp;&nbsp;소</a></div>
	</div>




</form>