<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="/module/js/datepicker.js"></script>
<script src="/module/js/jquery.ui.monthpicker.js"></script>

<script language='javascript'>

function formatDate(date) {

    var mymonth = date.getMonth() + 1;

    var myweekday = date.getDate();

	if(mymonth < 10)			mymonth = '0'+mymonth;
	if(myweekday < 10)		myweekday = '0'+myweekday;

    return (date.getFullYear() + "-" + mymonth + "-" + myweekday);
}
//어제
function SetYesterday() {
    var mydate = new Date();
	
    mydate.setDate(mydate.getDate() - 1);
	
	setdate = formatDate(mydate);

	$('#f_rDate01').val(setdate);
	$('#f_rDate02').val(setdate);
}

//금일
function SetToday() {
    var mydate = new Date();

    mydate.setDate(mydate.getDate() - 1);

	setdate = formatDate(new Date());

	$('#f_rDate01').val(setdate);
	$('#f_rDate02').val(setdate);
}

//이번주
function SetWeek() {
    var now = new Date();

    var nowDayOfWeek = now.getDay();

    var nowDay = now.getDate();

    var nowMonth = now.getMonth();

    var nowYear = now.getFullYear();

    nowYear += (nowYear < 2000) ? 1900 : 0;

    var weekStartDate = new Date(nowYear, nowMonth, nowDay - nowDayOfWeek);

    var weekEndDate = new Date(nowYear, nowMonth, nowDay + (6 - nowDayOfWeek));	


	setdate = formatDate(weekStartDate);
	$('#f_rDate01').val(setdate);

	setdate = formatDate(weekEndDate);
	$('#f_rDate02').val(setdate);
}

// 이번달
function SetCurrentMonthDays() {
    var d2, d22;
    d2 = new Date();
    d22 = new Date(d2.getFullYear(), d2.getMonth());    

    var d3, d33;
    d3 = new Date();
    d33 = new Date(d3.getFullYear(), d3.getMonth() + 1, "");


	setdate = formatDate(d22);
	$('#f_rDate01').val(setdate);

	setdate = formatDate(d33);
	$('#f_rDate02').val(setdate);   
}

// 지난달
function SetPrevMonthDays() {
    var d2, d22;
    d2 = new Date();
    d22 = new Date(d2.getFullYear(), d2.getMonth() -1);

    var d3, d33;
    d3 = new Date();
    d33 = new Date(d3.getFullYear(), d3.getMonth(), "");


	setdate = formatDate(d22);
	$('#f_rDate01').val(setdate);

	setdate = formatDate(d33);
	$('#f_rDate02').val(setdate);   

}
</script>
<script language='javascript'>
function go_search(){
	form = document.frm01;
	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reset_search(){
	form = document.frm01;

	form.f_reg.value = '';
	form.f_oname.value = '';
	form.f_userid.value = '';
	form.f_paymode.selectedIndex = 0;
	form.f_status.selectedIndex = 0;

	form.f_sy.value = '';
	form.f_sm.value = '';
	form.f_sd.value = '';
	form.f_ey.value = '';
	form.f_em.value = '';
	form.f_ed.value = '';

	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}


</script>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
				<tr>
					<th width='17%'>주문번호</td>
					<td class='tab' width='83%' colspan='3'><input type='text' name='f_reg' style='width:116px;' value='<?=$f_reg?>'></td>
				</tr>
				<tr>
					<th width='17%'>주문자</td>
					<td class='tab' width='33%'><input type='text' name='f_oname' style='width:216px;' value='<?=$f_oname?>'></td>
					<th width='17%'>주문회원 아이디</td>
					<td class='tab' width='33%'><input type='text' name='f_userid' style='width:216px;' value='<?=$f_userid?>'></td>
				</tr>
				<tr>
					<th>결제방법</td>
					<td class='tab'>
						<select name='f_paymode'>
							<option value=''>==</option>
							<option value='신용카드' <?if($f_paymode=='신용카드'){echo 'selected';}?>>신용카드</option>
							<option value='계좌이체' <?if($f_paymode=='계좌이체'){echo 'selected';}?>>계좌이체</option>
							<option value='무통장입금' <?if($f_paymode=='무통장입금'){echo 'selected';}?>>무통장입금</option>
						</select>
					</td>
					<th>주문상태</td>
					<td class='tab'>
						<select name='f_status'>
							<option value=''>==</option>
							<option value='접수' <?if($f_status=='접수'){echo 'selected';}?>>접수</option>
							<option value='입금대기' <?if($f_status=='입금대기'){echo 'selected';}?>>입금대기</option>
							<option value='결제완료' <?if($f_status=='결제완료'){echo 'selected';}?>>결제완료</option>
							<option value='입금확인' <?if($f_status=='입금확인'){echo 'selected';}?>>입금확인</option>
							<option value='발송준비' <?if($f_status=='발송준비'){echo 'selected';}?>>발송준비</option>
							<option value='발송완료' <?if($f_status=='발송완료'){echo 'selected';}?>>발송완료</option>
							<option value='주문취소' <?if($f_status=='주문취소'){echo 'selected';}?>>주문취소</option>
						</select>
					</td>
				</tr>


				<tr> 
					<th>주문일자</td>
					<td class='tab' colspan='3'>
						<div class="date_wrap" style='width:100%;display:inline-block;'>
							<li style='float:left;margin-right:20px;'>
								<input type='text' name='f_rDate01' id='f_rDate01' value='<?=$f_rDate01?>' class='fpicker textBox01' autocomplete='off' onkeyup="autoDateFormat(event, this)" onkeypress="autoDateFormat(event, this)" maxlength="10"> ~ 
								<input type='text' name='f_rDate02' id='f_rDate02' value='<?=$f_rDate02?>' class='fpicker textBox01' autocomplete='off' onkeyup="autoDateFormat(event, this)" onkeypress="autoDateFormat(event, this)" maxlength="10">
							</li>
							<li style='float:left;'>
								<div class='pcWarp' style='padding-top:3px;'>
									<a href="javascript:SetYesterday();" class="small cbtn black">어제</a>
									<a href="javascript:SetToday();" class="small cbtn black">금일</a>
									<a href="javascript:SetWeek();" class="small cbtn black">이번주</a>
									<a href="javascript:SetPrevMonthDays();" class="small cbtn black">지난달</a>
									<a href="javascript:SetCurrentMonthDays();" class="small cbtn black">이번달</a>
								</div>
								<div class='mobileWarp' style='display:none;'>
									<select name='f_period' id='f_period' style='width:80px;height:30px !important;padding-left:10px;font-size:16px;color:#777;' class='selectBox' onchange="selectBoxDate(this.options[this.selectedIndex].value);">
										<option value=''>==</option>
										<option value='yesterday'>어제</option>
										<option value='today'>금일</option>
										<option value='week'>이번주</option>
										<option value='prevMonth'>지난달</option>
										<option value='thisMonth'>이번달</option>
									</select>
								</div>
							</li>
						</div>
					</td>
				</tr>

			</table>
		</td>
	</tr>							
	<tr>
		<td align='center' style="padding:10px 0 50px 0;">
			<a href='javascript:go_search();' class='small cbtn blue'>검색</a>
			<a href='javascript:reset_search();' class='small cbtn black'>초기화</a>
		</td>
	</tr>						
</table>

<br><br>