

<ul class="clearfix ggform1">
	<li class="mr">
		<div class="formttl1"><span class="required">*</span>성함</div>
		<div><input required type="text" name="name" id="name" value="<?=$name?>" class="ip_1" disabled></div>
	</li>

	<li class="chk_iro clearfix">
		<div class="formttl1"><span class="required">*</span>성별</div>
		<div class="vms_wrap clearfix">
			<label class="male ss1">
			<input required type="radio" name="sex" id="sex" value="여" <?if($sex == '여'){echo 'checked';}?> disabled>
			<div class="box_radio nrb">여성</div>
			</label>

			<label class="female ss1">
			<input required type="radio" name="sex" id="sex" value="남" <?if($sex == '남'){echo 'checked';}?> disabled>
			<div class="box_radio ">남성</div>
			</label>
		</div>
	</li>
	</li>
	
	<li class="mr">
		<div class="formttl1"><span class="required">*</span>핸드폰</div>
		<div><input required type="text" name="phone01" id="phone01" value="<?=$phone01?>" class="ip_1 numberOnly"></div>
	</li>
	
	<li class="">
		<div class="formttl1"><span class="required">*</span>생년월일</div>
		<div><input type="text" name="bDate"  value="<?=$bDate?>" class="ip_1" disabled></div>
	</li>
	
</ul>




<div class="con_margin20"></div>

<div class="subcon_ttl w100">
	<div class="sut_01">개인정보 및 고유식별정보 수집·이용 동의</div>
	<div class="sut_02"><img src="/images/sub/sub_cloud.png" alt="" /></div>
</div>

<div class="con_margin20"></div>
<div class="agree_form01 bgc_fff bdtb" style="height:200px;overflow-y:scroll">
	 본 기관은 [개인정보보호법] 제 15조(개인정보의 수집·이용) 및 기타 관련 법률 등에 의거하여 정보 주체로부터 개인정보 수집함에 있어 아래와 같이 동의를 구합니다.<br><br>

	 1.수집 및 이용목적 : 프로그램 접수 안내, 신규강좌 안내, 프로그램 이벤트 및 기타 정보안내, 회원 만족도 조사 등<br>
	 ※SMS, 전자우편 및 우편물 형태로, 수신 가능 정보주체자가 제공한 모든 정보는 위의 목적에 필요한 용도 이외로는 사용되지 않으며 이용 목적이 변경될 시에는 사전 동의를 구할 것입니다.<br><br>

	 2.개인정보의 수집·이용 항목 : 성명, 성별, 생년월일, 주소, 연락처, 비상연락처, 이메일<br><br>

	 3.보유 및 이용기간 수집 : 회원 가입일로부터 서비스를 제공하는 기간 동안에 한하여 정보주체자의 개인정보를 보유 및 이용하게 됩니다.<br><br>

	 4.보유기간 : 회원 탈퇴 요청 시까지<br><br>


	 <p style="text-align:center;font-weight:600">
		본 기관은 수집 · 보유한 모든 정보는 [개인정보보호법]에 의거하여<br>본인의 사전동의 없이 제3자에게 제공 또는 공유하지 않습니다. 
	 </p>

	 <p style="text-align:center;margin-top:10px;">
		※ 회원의 주소, 전화번호, 휴대폰번호 등 인적사항의 변경이 있을 때에는<br>소정의 약식에 의하여 즉시 통보하여야 합니다.<br>
		(통지를 하지 않고 발생한 손해는 회원이 부담하여야 합니다.) 

	 </p>
</div>

<div class="agree_wrap clearfix">
	<div class="fl">
		<div class="squaredThree">
			<input required type="checkbox" value="" id="ok01" name="">
			<label for="ok01"></label>
		</div>
		<div class="agreeex" style="margin-left:30px">개인정보 및 고유식별정보 수집·이용에 동의합니다.</div>
	</div>
</div>


<div class="con_margin80"></div>

<div class="subcon_ttl w100">
	<div class="sut_01">환불규정 동의</div>
	<div class="sut_02"><img src="/images/sub/sub_cloud.png" alt="" /></div>
</div>

<div class="con_margin20"></div>
<style type="text/css">
.bloom2{
font-size:13px;
color:#666;
}
.recta_refund{
width:90%;
padding:3%;
font-size:14px;
line-height:22px;
border:1px solid #d2d2d2;
margin:10px 0;
background-color:#fafafa;
}

.refund_table,.refund_table td, .refund_table th{
width:100%;
border-collapse:collapse;
border:1px solid #d2d2d2;
font-family: 'Noto Sans KR', sans-serif;
}

.refund_table caption{
background-color:#f3f3f3;
border-top:1px solid #d2d2d2;
padding:5px 0;
}

.refund_table th{
border-collapse:collapse;
border:1px solid #d2d2d2;
width:20%;
padding:3px;
background-color:#f3f3f3;
}

.refund_table td{
border-collapse:collapse;
border:1px solid #d2d2d2;
width:80%;
padding:3px;
background:#fff;
}
.bloom{
font-size:13px;
color:#454545;
}

.bloom2{
font-size:13px;
color:#666;
}

.recta_refund{
width:90%;
padding:3%;
font-size:14px;
line-height:22px;
border:1px solid #d2d2d2;
margin:10px 0;
background-color:#fafafa;
}

</style>
<div class="agree_form01 bgc_fff bdtb" style="height:200px;overflow-y:scroll">
	 
	
		<div class="recta_refund">
			- 천재지변 또는 구청장 및 수탁자의 귀책으로 인하여 수강이 불가능한 경우 수강료 전액 환불<br>
			- 정원미달로 폐강 시 : 전액환불<br>
			- 개강일 전 : 전액환불<br>
			- 개강일 후 : 회원의 귀책사유일 경우 이용일수에 해당하는 금액을 공제 후 환불<br>
		</div>
	

		<p class="bloom2">※ 조례규정에 따라 [정부가 고시한 「소비자분쟁해결기준 제5장 제16조 제2항 관련」의거합니다.</p>


		<table class="refund_table">
		<caption>결제수단 별 환불안내</caption>
		<tr>
			<th style="width:21%;min-width:90px">단말기</th>
			<td style="background:#ffeeee">환불신청 후 <strong style="color:#ff5311">직접 내방</strong>하여 카드 환불을 진행하셔야 합니다.</td>
		</tr>
		<tr>
				<th>신용카드(온라인)</th>
				<td>환불신청일 기준 3~5일 소요</td>
			</tr>
		<tr>
				<th>현금/계좌이체 </th>
				<td>환불신청일 기준 3~5일 소요 / 본인명의 계좌로 입금</td>
			</tr>
			<tr>
				<th>가상계좌 </th>
				<td>원결제일 기준으로 최소 2주 소요 / 본인명의 계좌로 입금</td>
			</tr>
			<tr>
				<td colspan='2'>
					<p class="bloom">※ 단말기를 제외한 다른 결제수단의 경우 복지관에 내방하지 않으셔도 됩니다.</p>
					<p class="bloom">※ 현금/가상계좌/계좌이체 환불 시 본인 명의 계좌가 아닐 경우,가족명의계좌와 가족관계증명서가 필요합니다.</p>
				</td>
			</tr>
		<!--tr>
			<th>구비 서류</th>
			<td>
				※반드시 결제 영수증 지참 / 영수증 분실 시에는 결제수단의 승인번호를 알아오셔야 합니다. (신용카드 결제 혹은 현금영수증 발행시)<br>
				-현금결제시 : 신청자 본인 또는 보호자 명의의 통장과 본인이 아닌 경우 가족임을 증명할 수 있는 서류지참<br>
				-카드결제시 : 접수 시 사용했던 카드<br>

			
			</td-->
		</tr>
	</table>


</div>

<div class="agree_wrap clearfix">
	<div class="fl">
		<div class="squaredThree">
			<input required type="checkbox" value="" id="ok02" name="">
			<label for="ok02"></label>
		</div>
		<div class="agreeex" style="margin-left:30px">강좌프로그램 이용을 위한 환불규정에 동의합니다.</div>
	</div>
</div>



<div class="con_margin80"></div>

<div class="subcon_ttl w100">
	<div class="sut_01">문화강좌 이용 지침</div>
	<div class="sut_02"><img src="/images/sub/sub_cloud.png" alt="" /></div>
</div>

<div class="con_margin20"></div>
<div class="agree_form01 bgc_fff bdtb" style="height:200px;overflow-y:scroll">
	※ 수강 신청 시 이용수칙 이행 동의서를 작성하셔야 하며, 이용수칙 미 이행 시 강좌 수강이 불가능합니다.<br><br>

	① 강좌 이용 중 마스크를 꼭 착용해주세요. <br>
	② 입구에서 방문자 명부 작성, 발열 체크, 손소독 이후 입장합니다.<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(부분개방으로 인한 주차가 불가합니다.)<br>
	③ 37.5도 이상의 발열 혹은 호흡기 증상이 있을 시 입장이 불가능합니다.<br>
	④ 회관 내 음식물 섭취, 공용물품 이용이 금지됩니다. <br>
	⑤ 수강 중 틈틈이 손 소독제를 이용해주세요.<br>
	⑥ 의심증상이 나타날 경우, 강사나 재단 직원에게 말씀해주세요.<br><br>
</div>

<div class="agree_wrap clearfix">
	<div class="fl">
		<div class="squaredThree">
			<input required type="checkbox" value="" id="ok03" name="">
			<label for="ok03"></label>
		</div>
		<div class="agreeex" style="margin-left:30px">문화강좌 이용 지침에 동의합니다.</div>
	</div>
</div>