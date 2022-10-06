<?
//--------------------------------------------------------------------
//  PREVIL Calendar
//
//  - calendar.php / lun2sil.php(open source)
//
//  - Programmed by previl(previl@hanmail.net, http://dev.previl.net)
//
//--------------------------------------------------------------------

?>

<style>
li{list-style:none;word-break:break-all;}
.all { border-width:1; border-color:#cccccc; border-style:solid; }
font {font-size: 18px; color:#505050;}
font.title {font-size: 42px; font-weight: bold; color:#111111;}

.week {color:#ffffff !important;font-size:15px !important;height:40px;}
.week:nth-child(1) {background-color:#FEBC11;}
.week:nth-child(2) {background-color:#F47C46;}
.week:nth-child(3) {background-color:#F15B68;}
.week:nth-child(4) {background-color:#a4358b;}
.week:nth-child(5) {background-color:#5A2A7A;}
.week:nth-child(6) {background-color:#1464B0;}
.week:nth-child(7) {background-color:#5b96cf;}

.sholy{font-family:NanumGothic; font-size:12px; color:#F47C46;text-decoration: none;}
/*
.sholy:link{font-family:NanumGothic; font-size:12px; color:#FF6C21;text-decoration: none;}
.sholy:hover{font-family:NanumGothic; font-size:12px; color:#FF6C21;text-decoration: none;font-weight:bold;}
.sholy:visited{font-family:NanumGothic; font-size:12px; color:#FF6C21;text-decoration: none;}
.sholy:active{font-family:NanumGothic; font-size:12px; color:#FF6C21;text-decoration: none;}
*/

.ssat{font-family:NanumGothic; font-size:12px; color:#1464B0;text-decoration: none;}
/*
.ssat:link{font-family:NanumGothic; font-size:12px; color:#0000ff;text-decoration: none;}
.ssat:hover{font-family:NanumGothic; font-size:12px; color:#0000ff;text-decoration: none;font-weight:bold;}
.ssat:visited{font-family:NanumGothic; font-size:12px; color:#0000ff;text-decoration: none;}
.ssat:active{font-family:NanumGothic; font-size:12px; color:#0000ff;text-decoration: none;}
*/

.snum{font-family:NanumGothic; font-size:12px;color:#505050;text-decoration: none;}
/*
.snum:link{font-family:NanumGothic; font-size:12px;color:#505050;text-decoration: none;}
.snum:hover{font-family:NanumGothic; font-size:12px;color:#505050;text-decoration: none;font-weight:bold;}
.snum:visited{font-family:NanumGothic; font-size:12px;color:#505050;text-decoration: none;}
.snum:active{font-family:NanumGothic; font-size:12px;color:#505050;text-decoration: none;}
*/

.snum2{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;}
/*
.snum2:link{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;}
.snum2:hover{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
.snum2:visited{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;}
.snum2:active{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;}
*/

.sover{font-family:NanumGothic; font-size:12px; color:#0000ff;text-decoration: none;font-weight:bold;}

.sover2{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
/*
.sover2:link{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
.sover2:hover{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
.sover2:visited{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
.sover2:active{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
*/

.toDayBox{background:#f5f5f5;border:1px solid #dddddd;min-height:<?=$cellh?>px;}

.domiNum{
	color:#ff0000;
	font-weight:600;
}
</style>

<?
//--------------------------------------------------------------------
//  FUNCTION
//--------------------------------------------------------------------


function ErrorMsg($msg)
{
  echo " <script>                ";
  echo "   window.alert('$msg'); ";
  echo "   history.go(-1);       ";
  echo " </script>               ";
  exit;
}

function SkipOffset($no,$sdate='',$edate='')
{
  for($i=1;$i<=$no;$i++) {
    $ck = $no-$i+1;
    if($sdate) $num = date('d',$sdate-((3600*24)*$ck));
	if($edate) $num=$i;
    echo "  <TD align=center><a href='/' class=snum2>$num</a></TD> \n";
  }
}

//---- 오늘 날짜
$thisyear  = date('Y');  // 2000
$thismonth = date('n');  // 1, 2, 3, ..., 12
$today     = date('j');  // 1, 2, 3, ..., 31

//------ $year, $month 값이 없으면 현재 날짜
if(!$year)	$year = $thisyear;
if(!$month)	$month = $thismonth;
if(!$day)		$day = $today;


//------ 날짜의 범위 체크
if (($year > 2040) or ($year < 2000)) ErrorMsg("연도는 2000~2040년만 가능합니다.");
if (($month > 12) or ($month < 0)) ErrorMsg("달은 1~12만 가능합니다.");

$maxdate = date(t, mktime(0, 0, 0, $month, 1, $year));   // the final date of $month

if ($day>$maxdate) ErrorMsg("$month 월 에는 $lastday 일이 마지막 날입니다.");

$prevmonth = $month - 1;
$nextmonth = $month + 1;
$prevyear = $nextyear=$year;
if ($month == 1) {
  $prevmonth = 12;
  $prevyear = $year - 1;
} elseif ($month == 12) {
  $nextmonth = 1;
  $nextyear = $year + 1;
}

//양음변환 및 휴일정의
include "lun2sol.php";






//예약정보
$startTime = mktime(0,0,0,$month,1,$year) - (86400 * 6);
$endTime = mktime(0,0,0,$month,$maxdate,$year) + (86400 * 6);

//일자별 대관정보
$revHall = Array();
$revTeam = Array();
$revStatus = Array();

$sql = "select * from ks_reserve_list where revTime>=$startTime and revTime<=$endTime order by revTime asc, hallNo asc";
$result = mysql_query($sql);
$num = mysql_num_rows($result);


for($i=0; $i<$num; $i++){
	$row = mysql_fetch_array($result);
	$revTime = $row['revTime'];
	$hall = $row['hall'];
	$team = Util::NameCutStr($row['team'],'2','*');
	$status = $row['status'];

	$revHall[$revTime][] = $hall;
	$revTeam[$revTime][] = $team;
	$revStatus[$revTime][] = $status;
}
?>

<script language='javascript'>
function setCalendar(y,m){
	form = document.frm01;
	form.year.value = y;
	form.month.value = m;
	form.day.value = '1';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reserveInfo(name, thisID, week){
	if(name != ''){
		var pos = $('#'+thisID).offset();
		$('#revUserName').html(name);

		if(week == "6"){
			$('.reserveInfoBox').attr('class','reserveInfoBoxSat');
			$('.reserveInfoBoxSat').css('top',pos.top-$('.reserveInfoBoxSat').height()+27);
			$('.reserveInfoBoxSat').css('left',pos.left-$('.reserveInfoBoxSat').width()-42);
			$('.reserveInfoBoxSat').fadeIn("fast");

		}else{
			$('.reserveInfoBox').css('top',pos.top-$('.reserveInfoBox').height()+27);
			$('.reserveInfoBox').css('left',($('#'+thisID).width()+pos.left)+12);
			$('.reserveInfoBox').fadeIn("fast");
		}
	}
}

function reserveInfoClose(){
	$('.reserveInfoBoxSat').attr('class','reserveInfoBox');
	$('.reserveInfoBox').hide();
}
</script>

<div class="reserveInfoBox" onmouseleave="reserveInfoClose();" style='z-index:9999;'>
	<div class="reserveInfoTitle">예약자 정보</div>
	<div class="reserveInfoContent">
		<p id="revUserName" style='line-height:20px;'></p>
	</div>
</div>


<table cellSpacing='0' cellPadding='0' width='<?=$tablew?>' border='0'>
	<tr>
		<td align='center'>
			<table cellSpacing='0' cellPadding='0' border='0'>
				<tr>
					<td><a href="javascript:setCalendar('<?=$prevyear?>','<?=$prevmonth?>');" onfocus='this.blur()'><img src='<?=$c_path?>/img/prev.jpg'
					border='0' onfocus='this.blur();' align='absmiddle' style='margin-bottom:2px;'></a></td>
					<td style='padding:0 20px' align='center'><font class='title'><?=$year?>년 <?=$month?>월</font></td>
					<td><a href="javascript:setCalendar('<?=$nextyear?>','<?=$nextmonth?>');" onfocus='this.blur()'><img src='<?=$c_path?>/img/next.jpg'
					border='0' onfocus='this.blur();' align='absmiddle' style='margin-bottom:2px;'></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style='padding:20px 0 10px 0;' align='right'>
			<span class='Jico01'>대</span> 입금대기&nbsp;&nbsp;&nbsp;&nbsp;
			<span class='Sico03'>승</span> 대관승인
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="5" class='cal_table'>
				<tr align='center'>
					<td width='14%' class='week'>Sun</td>
					<td width='14%' class='week'>Mon</td>
					<td width='14%' class='week'>Tue</td>
					<td width='14%' class='week'>Wed</td>
					<td width='14%' class='week'>Thu</td>
					<td width='14%' class='week'>Fri</td>
					<td width='14%' class='week'>Sat</td>
				</tr>

				<tr height=<?=$cellh?>>


        <!-- 날짜 테이블 -->


<?

$date   = 1;
$offset = 0;
$ck_row=0; //프레임 사이즈 조절을 위한 체크인자

while ($date <= $maxdate){
	if ($date < 10) $date2 = "&nbsp;".$date;
	else $date2 = $date;

	if($date == '1'){
		$offset = date('w', mktime(0, 0, 0, $month, $date, $year));  // 0: sunday, 1: monday, ..., 6: saturday
		$no = $offset;
		$sdate = mktime(0, 0, 0, $month, $date, $year);
		$edate = '';
		include $c_path.'/specialOffset.php';
	}

	if($offset == 0){
		$style = "sholy";

	}elseif($offset == 5){
		$style = "snum";

	}elseif($offset == 6){
		$style = "ssat";

	}else{
		$style = "snum";
	}



	$date_title = '';

	for($i=0;$i<count($HOLIDAY);$i++){
		if($HOLIDAY[$i][0] =="$month-$date") {
			$style="sholy";
			$date_title = "title='{$month}월 {$date}일은 ".$HOLIDAY[$i][1]." 입니다'";
			break;
		}
	}

	//오늘날짜표시
	if($date == $today  &&  $year == $thisyear &&  $month == $thismonth){
		$style = 'snum';
		$toChk = true;
	}else{
		$toChk = false;
	}
?>


	<!-- 날짜출력 -->
	<td valign='top' <?=$date_title?>>
	<?
		if($toChk){
			echo ("<div class='toDayBox'>");
		}
	?>

			<div style='margin:3px 0 0 3px;' onmouseover="reserveInfoClose();"><span class='<?=$style?>' style='font-size:16px;'><?=$date2?></span></div>
			<div style='width:100%;margin:15px 0 10px 5px;'>
			<?
				$this_sTime = mktime(0, 0, 0, $month, $date, $year);

				$reserveCnt = $revHall[$this_sTime];

				for($i=0; $i<count($reserveCnt); $i++){
					$reserveHall = $revHall[$this_sTime][$i];
					$reserveTeam = $revTeam[$this_sTime][$i];
					$reserveStatus = $revStatus[$this_sTime][$i];
			?>
				<li style='margin:8px 0 0 0;'>
				<?
					if($reserveStatus == '입금대기')	$sTxt = "<span class='Jico01'>대</span> ";
					else										$sTxt = "<span class='Sico03'>승</span> ";
				?>
					<?=$sTxt?>
					<label onmouseenter="reserveInfo('<?=$reserveTeam?>',this.id, '<?=$offset?>');"  id="rev_<?=$year?><?=$month?><?=$date?>_<?=$i?>" onmouseout="reserveInfoClose();"><?=$reserveHall?></label>
				</li>
			<?
				}
			?>
			</div>


	<?
		if($toChk){
			echo ("</div>");
		}
	?>
	</td>



<?
  $date++;
  $offset++;

  if($offset == 7){
	  echo ("</tr>");
	  if($date <= $maxdate){
		  echo ("<tr height=$cellh>");
		  $ck_row++;
	  }
	  $offset = 0;
  }
} // end of while

if($offset != 0){
//  SkipOffset((7-$offset),'',mktime(0, 0, 0, $month, $date, $year));
  $no = 7-$offset;
  $sdate = '';
  $edate = mktime(0, 0, 0, $month, $date, $year);
  include $c_path.'/specialOffset.php';
  echo ("</tr>");
}

?>
<!-- 날짜 테이블 끝 -->


					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>



<script language='javascript'>
$(document).ready(function(){
	$(window).resize(function(){
		reserveInfoClose();
	});
});
</script>