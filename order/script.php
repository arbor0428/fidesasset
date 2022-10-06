<script language='javascript'>
function setChkBox(obj,chk){
	eChk = document.getElementsByName(obj);

	if(eChk[chk].checked){
		for(var i=0;i<eChk.length;i++){
			if(i == chk)	eChk[i].checked = true;
			else			eChk[i].checked = false;
		}

		if(chk == 0 || chk == 1){
			$('#payColumn').text('');
			$('#cashDiv').hide();
			$('input[name^=cashBill]').prop('checked', false);

			if(chk == 1){
				VaccConfirm();
			}

		}else if(chk == 2){
			$('#payColumn').html("<div class='eqc'>*</div>현금영수증");
			$('#cashDiv').show();
		}

	}else{
		$('#payColumn').text('');
		$('#cashDiv').hide();
		$('input[name^=cashBill]').prop('checked', false);
	}
}

function setChkBill(obj,chk){
	eChk = document.getElementsByName(obj);

	for(var i=0;i<eChk.length;i++){
		if(i == chk)	eChk[i].checked = true;
		else			eChk[i].checked = false;
	}
}

function check_form(){
/*
	GblMsgBox('시스템 점검중입니다.\n잠시후 신청해 주시기 바랍니다.','');
	return;
*/

	if($('#proList').val() == ''){
		GblMsgBox('신청강좌 정보가 없습니다.\n다시 신청해 주시기 바랍니다.','');
		return;
	}

	form = document.frm01;

	if(isFrmEmptyModal(form.phone01,"핸드폰 번호를 입력해 주십시오."))	return;

	if($('#ok01').is(":checked") == false){
		GblMsgBox('개인정보 수집·이용에 동의해 주십시오.','');
		return;
	}

	if($('#ok02').is(":checked") == false){
		GblMsgBox('강좌프로그램 이용을 위한 환불규정에 동의해 주십시오.','');
		return;
	}

	if($('#ok03').is(":checked") == false){
		GblMsgBox('문화강좌 이용 지침에 동의해 주십시오.','');
		return;
	}

	payAmt = $('#payAmt').val();

	kcp = false;

	if(payAmt > 0){
		pchk01 = $('#pT1').is(":checked");		//신용카드
		pchk02 = $('#pT2').is(":checked");		//가상계좌
//		pchk03 = $('#pT3').is(":checked");		//현금
		pchk03 = false;

		if(pchk01 == false && pchk02 == false && pchk03 == false){
			GblMsgBox('결제수단을 선택해 주십시오.','');
			return;

		}else{
			if(pchk01 || pchk02){
				kcp = true;

			}else if(pchk03){
				cchk01 = $('#cT1').is(":checked");
				cchk02 = $('#cT2').is(":checked");

				if(cchk01 == false && cchk02 == false){
					GblMsgBox('현금영수증 발행유무를 선택해 주십시오.','');
					return;
				}
			}
		}


		//2019-08-15 ~ 2019-08-31 설문지
		research = $('#research').val();
		researchChk = $('#researchChk').val();

		if(research){
			if(researchChk == ''){
				window.open('https://form.office.naver.com/form/responseView.cmd?formkey=YWQ0OWRlMDUtZjIyNy00ZGU3LWE5NjQtMjY1MGQ0NjJlZjhj&sourceId=mail&sf=f');
				$('#researchChk').val('1');
				return;
			}
		}


		if('<?=$UserOS?>' == 'pc'){
			form.type.value = '';
			form.target = '';
			form.action = 'payment.php';
			form.submit();
		}else{
			form.type.value = '';
			form.target = '';
			form.action = '/module/kcp/mobile_sample/order_mobile.php';
			form.submit();
		}




	}else if(payAmt == 0){
		form.type.value = 'write';
		form.target = 'ifra_gbl';
		form.action = 'orderProc.php';
		form.submit();
	}
}
</script>