<style type='text/css'>
#loadTxt{position:absolute !important;margin-top:30px;;left:45% !important;z-index:9999 !important;display:none;}
</style>

<!-- Respomsive slider -->
<link href="./css/responsive-calendar.css" rel="stylesheet">

<div class="container" style="width:258px;height:198px;border:1px solid #ddd;background:url('/images/calTop.gif') repeat-x top;">
	<!-- Responsive calendar - START -->
	<div class="responsive-calendar">
		<div class="controls" style="margin:10px 10px 30px 10px;border:1px solid transparent;color:#fff;font-weight:800;">
			<li style='float:left;width:25%;'><a class="pull-left" data-go="prev">◀</a></li>
			<li style='float:left;width:50%;'><h4><span data-head-year></span>&nbsp;&nbsp;<span data-head-month></span></h4></li>
			<li style='float:right;width:25%;'><a class="pull-right" data-go="next">▶</a></li>
		</div>

		<div class="day-headers" style='margin:10px 0 5px 0;'>
			<div class="day header" style='color:#ff0000;'>Su</div>
			<div class="day header">Mo</div>
			<div class="day header">Tu</div>
			<div class="day header">We</div>
			<div class="day header">Th</div>
			<div class="day header">Fr</div>
			<div class="day header" style='color:#1095cd;'>Sa</div>
		</div>



		<div style='position:relative;'>
			<div id='loadTxt'><img src='/images/loader.gif'></div>
		</div>

		<div class="days" data-group="days"></div>
	</div>
	<!-- Responsive calendar - END -->
</div>




<script src="./js/responsive-calendar.js"></script>



<?
	$year = date('Y');
	$month = date('m');

	//공연전시 > 월간일정 데이터를 가져온다.
	$sql = "select distinct(data03) from tb_board_list where table_id='table_1512604967' and data01='$year' and data02='$month' order by data03";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
?>


<script language='javascript'>
function addLeadingZero(num){
	if(num < 10){
		return "0" + num;
	}else{
		return "" + num;
	}
}

function reloadCalendar(cYear,cMonth){
	$('#loadTxt').css('display','block');
	$('.responsive-calendar').responsiveCalendar('clearAll');


	id = setTimeout(function(){
		$.post('./calendarData.php',{'cYear':cYear,'cMonth':cMonth}, function(result){
			if(result){
				dateArr = result.split('/');

				str = '{';
				for(i=0; i<dateArr.length; i++){
					dateTxt = dateArr[i];
					urlTxt = "/sub01/sub02.php?year="+cYear+"&month="+cMonth;

					if(i > 0)	str += ',';

					str += '"' + dateTxt + '":{"url":"'+urlTxt+'"}';
				}
				str += '}';

				parData = JSON.parse(str);


				$('.responsive-calendar').responsiveCalendar('edit',
					parData
				);
			}

			$('#loadTxt').css('display','none');
		});
	}, 500);
}

$(document).ready(function(){
	dateArr = new Array();

	<?
		for($i=0; $i<$num; $i++){
			$row = mysql_fetch_array($result);
			$data03 = $row['data03'];

			$rDate = $year.'-'.$month.'-'.sprintf('%02d',$data03);
	?>
		dateArr['<?=$i?>'] = '<?=$rDate?>';
	<?
		}
	?>


	str = '{';
	for(i=0; i<dateArr.length; i++){
		dateTxt = dateArr[i];
		urlTxt = "/sub01/sub02.php?year=<?=$year?>&month=<?=$month?>";

		if(i > 0)	str += ',';

		str += '"' + dateTxt + '":{"url":"'+urlTxt+'"}';
	}
	str += '}';

	parData = JSON.parse(str);


	/* Initialize calendar */
	$(".responsive-calendar").responsiveCalendar({
		events: parData,

		onMonthChange: function(events){
			cYear = $(this)[0].currentYear;
			cMonth = $(this)[0].currentMonth + 1;
			reloadCalendar(cYear,cMonth);
		}
	});
});
</script>