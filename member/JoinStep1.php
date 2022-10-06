<?
	include 'JoinTop.php';
?> 

<script language='javascript'>
	function joinCheck(){
		form = document.frmJoin;

		if(!isOneCheckModal(form.agree1,"서비스 이용약관에 동의해 주십시오","fc1"))	return;
		if(!isOneCheckModal(form.agree2,"개인정보 수집 및 이용에 동의해 주십시오","fc2"))	return;

		form.type.value = 'write';
		form.step.value = '3';
		form.action = "<?=$_SERVER['PHP_SELF']?>";
		form.submit();
	}
</script>

<form name='frmJoin' method='post' action=''>
	<label><input type='text' style='display:none;'></label>

	<input type='hidden' name='type' value=''>
	<label for="step"><input type='hidden' name='step' value=''></label>



	<div class="join_sec">

		<div class="join_con clearfix">
			<h2 class='tm1' id='fc1'>1. 서비스 이용약관 동의</h2>
			<div class="privacy_wrap"><? include 'clause01.php'; ?></div>
			<div class="privacy-chk">
				<div class="squaredThree">
					<input type="checkbox" value="1" id="agree1" name="agree1">
					<label for="agree1"></label>
				</div>
				<p class='cm1'>위의 서비스 이용약관에 동의합니다. [필수]</p>
			</div>
		</div>

		<div class="join_con clearfix">
			<h2 class='tm1' id='fc2'>2. 개인정보 수집 및 이용 동의</h2>
			<div tabindex="0" class="privacy_wrap"><? include 'clause02.php'; ?></div>
			<div class="privacy-chk">
				<div class="squaredThree">
					<input type="checkbox" value="1" id="agree2" name="agree2">
					<label for="agree2"></label>
				</div>
				<p class='cm1'>위의 개인정보 수집 및 이용에 동의합니다. [필수]</p>
			</div>
		</div>

	</div>
	<div class="btn_con">
		<a class="btn_st2 join_f_btn" href="/">회원가입 취소</a>
		<a class="btn_st1 join_f_btn" href="javascript:joinCheck();">회원가입 진행</a>					
	</div>
</div>

</form>	

<?
	include 'footer.php';
?>