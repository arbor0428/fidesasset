<?
$today = mktime();
/*
if(!$f_ey)	$f_ey = date('Y',$today);
if(!$f_em)	$f_em = date('m',$today);
if(!$f_ed)	$f_ed = date('d',$today);
*/

?>
<script language='javascript'>
function formSetStart(fname,setdate){
	form = document[fname];
	SCt = setdate.split('-');

	form.f_sy.value = SCt[0];
	form.f_sm.value = SCt[1];
	form.f_sd.value = SCt[2];
}


function formSetEnd(fname,setdate){
	form = document[fname];
	ECt = setdate.split('-');

	form.f_ey.value = ECt[0];
	form.f_em.value = ECt[1];
	form.f_ed.value = ECt[2];
}


function formatDate(date) {

    var mymonth = date.getMonth() + 1;

    var myweekday = date.getDate();

    return (date.getFullYear() + "-" + mymonth + "-" + myweekday);

}



//어제
function SetYesterday(fname) {
    var mydate = new Date();

    mydate.setDate(mydate.getDate() - 1);


	setdate = formatDate(mydate);

	formSetStart(fname,setdate);
	formSetEnd(fname,setdate);  
}



//금일
function SetToday(fname) {
    var mydate = new Date();

    mydate.setDate(mydate.getDate() - 1);


	setdate = formatDate(new Date());

	formSetStart(fname,setdate);
	formSetEnd(fname,setdate);  
}



//이번주
function SetWeek(fname) {
    var now = new Date();

    var nowDayOfWeek = now.getDay();

    var nowDay = now.getDate();

    var nowMonth = now.getMonth();

    var nowYear = now.getFullYear();

    nowYear += (nowYear < 2000) ? 1900 : 0;

    var weekStartDate = new Date(nowYear, nowMonth, nowDay - nowDayOfWeek);

    var weekEndDate = new Date(nowYear, nowMonth, nowDay + (6 - nowDayOfWeek));


	setdate = formatDate(weekStartDate);
	formSetStart(fname,setdate);

	setdate = formatDate(weekEndDate);
	formSetEnd(fname,setdate);
}



//최근7일
function Set7Days(fname) {
    var mydate = new Date();

    mydate.setDate(mydate.getDate() - 7);



	setdate = formatDate(mydate);
	formSetStart(fname,setdate);

	setdate = formatDate(new Date());
	formSetEnd(fname,setdate);
}



function Set30Days(fname) {
    var mydate = new Date();

    mydate.setDate(mydate.getDate() - 30);



	setdate = formatDate(mydate);
	formSetStart(fname,setdate);

	setdate = formatDate(new Date());
	formSetEnd(fname,setdate);
}




function Set90Days(fname) {
    var mydate = new Date();

    mydate.setDate(mydate.getDate() - 90);



	setdate = formatDate(mydate);
	formSetStart(fname,setdate);

	setdate = formatDate(new Date());
	formSetEnd(fname,setdate);

}




// 이번달
function SetCurrentMonthDays(fname) {
    var d2, d22;
    d2 = new Date();
    d22 = new Date(d2.getFullYear(), d2.getMonth());    

    var d3, d33;
    d3 = new Date();
    d33 = new Date(d3.getFullYear(), d3.getMonth() + 1, "");


	setdate = formatDate(d22);
	formSetStart(fname,setdate);

	setdate = formatDate(d33);
	formSetEnd(fname,setdate);   

}



// 지난달
function SetPrevMonthDays(fname) {
    var d2, d22;
    d2 = new Date();
    d22 = new Date(d2.getFullYear(), d2.getMonth() -1);

    var d3, d33;
    d3 = new Date();
    d33 = new Date(d3.getFullYear(), d3.getMonth(), "");


	setdate = formatDate(d22);
	formSetStart(fname,setdate);

	setdate = formatDate(d33);
	formSetEnd(fname,setdate);   

}


//전체
function SetAllDays(fname) {
	form = document[fname];
	form.f_sy.value = '';
	form.f_sm.value = '';
	form.f_sd.value = '';

	setdate = formatDate(new Date());
	formSetEnd(fname,setdate);

}
</script>












<!-- 시작년월일 -->

	<select name="f_sy" style='height:28px;'>
		<option value=''>==</option>
	<?
		$f_year = date('Y') + 1;
		for($i=2014; $i<$f_year; $i++){
			if($f_sy == $i)	$chk = 'selected';
			else	$chk = '';
	?>
		<option value='<?=$i?>' <?=$chk?>><?=$i?></option>
	<?
		}
	?>
	</select>년

	<select name="f_sm" style='height:28px;'>
		<option value=''>==</option>
	<?
		for($i=1; $i<13; $i++){
			if($f_sm == $i)	$chk = 'selected';
			else	$chk = '';
	?>
		<option value='<?=$i?>' <?=$chk?>><?=$i?></option>
	<?
		}
	?>
	</select>월

	<select name="f_sd" style='height:28px;'>
		<option value=''>==</option>
	<?
		for($i=1; $i<32; $i++){
			if($f_sd == $i)	$chk = 'selected';
			else	$chk = '';
	?>
		<option value='<?=$i?>' <?=$chk?>><?=$i?></option>
	<?
		}
	?>
	</select>일~ 

<!-- /시작년월일 -->




<!-- 종료년월일 -->

	<select name="f_ey" style='height:28px;'>
		<option value=''>==</option>
	<?
		$f_year = date('Y') + 1;
		for($i=2014; $i<$f_year; $i++){
			if($f_ey == $i)	$chk = 'selected';
			else	$chk = '';
	?>
		<option value='<?=$i?>' <?=$chk?>><?=$i?></option>
	<?
		}
	?>
	</select>년

	<select name="f_em" style='height:28px;'>
		<option value=''>==</option>
	<?
		for($i=1; $i<13; $i++){
			if($f_em == $i)	$chk = 'selected';
			else	$chk = '';
	?>
		<option value='<?=$i?>' <?=$chk?>><?=$i?></option>
	<?
		}
	?>
	</select>월

	<select name="f_ed" style='height:28px;'>
		<option value=''>==</option>
	<?
		for($i=1; $i<32; $i++){
			if($f_ed == $i)	$chk = 'selected';
			else	$chk = '';
	?>
		<option value='<?=$i?>' <?=$chk?>><?=$i?></option>
	<?
		}
	?>
	</select>일

<!-- 종료년월일 -->



	<a href="javascript:SetYesterday('<?=$SearchDateForm?>');"><img src='/images/common/btn_date01.gif' align='absmiddle'></a>
	<a href="javascript:SetToday('<?=$SearchDateForm?>');"><img src='/images/common/btn_date02.gif' align='absmiddle'></a>
	<a href="javascript:SetWeek('<?=$SearchDateForm?>');"><img src='/images/common/btn_date03.gif' align='absmiddle'></a>
	<a href="javascript:SetPrevMonthDays('<?=$SearchDateForm?>');"><img src='/images/common/btn_date04.gif' align='absmiddle'></a>
	<a href="javascript:SetCurrentMonthDays('<?=$SearchDateForm?>');"><img src='/images/common/btn_date05.gif' align='absmiddle'></a>
	<a href="javascript:SetAllDays('<?=$SearchDateForm?>');"><img src='/images/common/btn_date06.gif' align='absmiddle'></a>