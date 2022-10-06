<?
	//제이쿼리 달력
	$sRange = '90';
	$eRange = '0';
	include '../../module/Calendar.php';
?>

<script language='javascript'>
function go_search(){
	form = document.frm01;
	form.type.value = '';
	form.record_start.value = '';
	form.taget = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reset_search(){
	form = document.frm01;

	form.f_code.value = '';
	form.f_name.value = '';	
	form.f_guest.value = '';	
	form.f_carNum.value = '';

	form.record_start.value = '';
	form.taget = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
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

	$('#fpicker1').val(setdate);
	$('#fpicker2').val(setdate);
}

//금일
function SetToday() {
    var mydate = new Date();

    mydate.setDate(mydate.getDate() - 1);

	setdate = formatDate(new Date());

	$('#fpicker1').val(setdate);
	$('#fpicker2').val(setdate);
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
	$('#fpicker1').val(setdate);

	setdate = formatDate(weekEndDate);
	$('#fpicker2').val(setdate);
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
	$('#fpicker1').val(setdate);

	setdate = formatDate(d33);
	$('#fpicker2').val(setdate);   
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
	$('#fpicker1').val(setdate);

	setdate = formatDate(d33);
	$('#fpicker2').val(setdate);   

}

</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
				<tr>
					<th width='17%'>일련번호</th>
					<td width='33%'><input type='text' name='f_code' style='width:190px;' value='<?=$f_code?>'></td>
					<th width='17%'>등록자</th>
					<td width='33%'><input type='text' name='f_name' style='width:190px;' value='<?=$f_name?>'></td>
				</tr>
				<tr>
					<th>방문자</th>
					<td><input type='text' name='f_guest' style='width:190px;' value='<?=$f_guest?>'></td>
					<th>차량번호</th>
					<td><input type='text' name='f_carNum' style='width:190px;' value='<?=$f_carNum?>'></td>
				</tr>
				<tr>
					<th>등록일자</th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
									<input type='text' name='f_rDate01' id='fpicker1' value='<?=$f_rDate01?>' readonly> ~ 
									<input type='text' name='f_rDate02' id='fpicker2' value='<?=$f_rDate02?>' readonly>
								</td>
								<td style='padding:0 0 0 20px;'>
									<a href="javascript:SetYesterday();" class="small cbtn black">어제</a>
									<a href="javascript:SetToday();" class="small cbtn black">금일</a>
									<a href="javascript:SetWeek();" class="small cbtn black">이번주</a>
									<a href="javascript:SetPrevMonthDays();" class="small cbtn black">지난달</a>
									<a href="javascript:SetCurrentMonthDays();" class="small cbtn black">이번달</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>						
	<tr>
		<td align='center' style='padding-top:10px;'>
			<a href='javascript:go_search();' class='small cbtn blue'>검색</a>
			<a href='javascript:reset_search();' class='small cbtn black'>초기화</a>
		</td>
	</tr>						
</table>

<br><br>