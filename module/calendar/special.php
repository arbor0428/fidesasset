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
.all { border-width:1; border-color:#cccccc; border-style:solid; }
font {font-size: 18px; color:#505050;}
font.title {font-size: 22px; font-weight: bold; color:#2579CF;}


.week {font-family:NanumGothic;background-color:#eeeeee;color:#464646;font-size:12px;font-weight:bold;letter-spacing:-1;height:30px;}


.sholy{font-family:NanumGothic; font-size:12px; color:#FF6C21;text-decoration: none;}
/*
.sholy:link{font-family:NanumGothic; font-size:12px; color:#FF6C21;text-decoration: none;}
.sholy:hover{font-family:NanumGothic; font-size:12px; color:#FF6C21;text-decoration: none;font-weight:bold;}
.sholy:visited{font-family:NanumGothic; font-size:12px; color:#FF6C21;text-decoration: none;}
.sholy:active{font-family:NanumGothic; font-size:12px; color:#FF6C21;text-decoration: none;}
*/

.ssat{font-family:NanumGothic; font-size:12px; color:#0000ff;text-decoration: none;}
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
.snum2:link{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;}
.snum2:hover{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
.snum2:visited{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;}
.snum2:active{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;}

.sover{font-family:NanumGothic; font-size:12px; color:#0000ff;text-decoration: none;font-weight:bold;}


.sover2{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
.sover2:link{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
.sover2:hover{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
.sover2:visited{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
.sover2:active{font-family:NanumGothic; font-size:12px; color:#bbbbbb;text-decoration: none;font-weight:bold;}

.toDayBox{background:#ecf1fa;border:1px solid #3667b3;min-height:<?=$cellh?>px;}

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


$dailyArr = Array();

//기존에 설정된 적용요금
$sql = "select * from ks_daily_charge where userid='$GBL_USERID' and scode='$GBL_SCODE' and rYear='$year' and rMonth='$month' order by rTime";
$result = mysql_query($sql);
$num = mysql_num_rows($result);

for($i=0; $i<$num; $i++){
	$row = mysql_fetch_array($result);
	$rDay = $row['rDay'];

	$dailyArr[$rDay] = $row['smode'];
}


//기간별 배경색
$sColorArr = Array();
$sColorArr['비수기 주중'] = '#acc000';
$sColorArr['비수기 금요일'] = '#6fbc00';
$sColorArr['비수기 주말'] = '#00b361';
$sColorArr['준성수기 주중'] = '#00b2c7';
$sColorArr['준성수기 금요일'] = '#00a0eb';
$sColorArr['준성수기 주말'] = '#0071d0';
$sColorArr['성수기 주중'] = '#ffa800';
$sColorArr['성수기 금요일'] = '#ff6c00';
$sColorArr['성수기 주말'] = '#ff5432';
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

function setTxtColor(obj){
	ov = obj.value;

//	$('#'+obj.name).css('color','#fff');

	if(ov == '비수기 주중')				$('#'+obj.name).css('background','#acc000');
	else if(ov == '비수기 금요일')		$('#'+obj.name).css('background','#6fbc00');
	else if(ov == '비수기 주말')		$('#'+obj.name).css('background','#00b361');
	else if(ov == '준성수기 주중')		$('#'+obj.name).css('background','#00b2c7');
	else if(ov == '준성수기 금요일')	$('#'+obj.name).css('background','#00a0eb');
	else if(ov == '준성수기 주말')		$('#'+obj.name).css('background','#0071d0');
	else if(ov == '성수기 주중')		$('#'+obj.name).css('background','#ffa800');
	else if(ov == '성수기 금요일')		$('#'+obj.name).css('background','#ff6c00');
	else if(ov == '성수기 주말')		$('#'+obj.name).css('background','#ff5432');
}
</script>

<table cellSpacing='0' cellPadding='0' width='<?=$tablew?>' border='0'>
	<tr>
		<td align='center'>
			<table cellSpacing='0' cellPadding='0' border='0'>
				<tr>
					<td><a href="javascript:setCalendar('<?=$prevyear?>','<?=$prevmonth?>');" onfocus='this.blur()'><img src='/images/go_left.gif' border='0' onfocus='this.blur();' align='absmiddle'></a></td>
					<td style='padding:0 20px' align='center'><font class='title'><?=$year?>년 <?=$month?>월</font></td>
					<td><a href="javascript:setCalendar('<?=$nextyear?>','<?=$nextmonth?>');" onfocus='this.blur()'><img src='/images/go_right.gif' border='0' onfocus='this.blur();' align='absmiddle'></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style='padding:10px 0 0 0;'>
			<table width="100%" border="0" cellspacing="0" cellpadding="5" class='cal_table'>
				<tr align='center'>
					<td width='14%' class='week'>일</td>            
					<td width='14%' class='week'>월</td>
					<td width='14%' class='week'>화</td>
					<td width='14%' class='week'>수</td>
					<td width='14%' class='week'>목</td>
					<td width='14%' class='week'>금</td>
					<td width='14%' class='week'>토</td>
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
		$smodeTxt = '비수기 주중';

	}elseif($offset == 5){
		$style = "snum";
		$smodeTxt = '비수기 금요일';

	}elseif($offset == 6){
		$style = "ssat";
		$smodeTxt = '비수기 주말';

	}else{
		$style = "snum";
		$smodeTxt = '비수기 주중';
	}

	//저장된 정보가 있는경우...
	if($dailyArr[$date]){
		$smodeTxt = $dailyArr[$date];

	//휴일전날처리
	}elseif(in_array("$month-$date",$BEFOREDAY)){
		$smodeTxt = '비수기 주말';
	}

	$date_title = '';
	
	for($i=0;$i<count($HOLIDAY);$i++){	   
		if($HOLIDAY[$i][0] =="$month-$date") {
			$style="sholy"; 
			$date_title = "title='{$month}월 {$date}일은 ".$HOLIDAY[$i][1]." 입니다'";    
			break;
		}	   
	}




	//배경색설정
	$smodeColor = $sColorArr[$smodeTxt];


	
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
			<div style='margin:3px 0 0 3px;' class='<?=$style?>'>
				<span style='font-size:16px;'><?=$date2?></span>
			</div>
			<div style='text-align:center;margin:25px 0 0 0;'>
				<select name='smode_<?=$date?>' id='smode_<?=$date?>' style="height:28px;color:#fff;background:<?=$smodeColor?>;cursor:pointer;" onchange="setTxtColor(this);">
					<option value='비수기 주중' <?if($smodeTxt == '비수기 주중'){echo 'selected';}?> style='color:#212121;'>비수기 주중</option>
					<option value='비수기 금요일' <?if($smodeTxt == '비수기 금요일'){echo 'selected';}?> style='color:#212121;'>비수기 금요일</option>
					<option value='비수기 주말' <?if($smodeTxt == '비수기 주말'){echo 'selected';}?> style='color:#212121;'>비수기 주말</option>

					<option value='준성수기 주중' <?if($smodeTxt == '준성수기 주중'){echo 'selected';}?> style='color:#0000ff;'>준성수기 주중</option>
					<option value='준성수기 금요일' <?if($smodeTxt == '준성수기 금요일'){echo 'selected';}?> style='color:#0000ff;'>준성수기 금요일</option>
					<option value='준성수기 주말' <?if($smodeTxt == '준성수기 주말'){echo 'selected';}?> style='color:#0000ff;'>준성수기 주말</option>

					<option value='성수기 주중' <?if($smodeTxt == '성수기 주중'){echo 'selected';}?> style='color:#ff0000;'>성수기 주중</option>
					<option value='성수기 금요일' <?if($smodeTxt == '성수기 금요일'){echo 'selected';}?> style='color:#ff0000;'>성수기 금요일</option>
					<option value='성수기 주말' <?if($smodeTxt == '성수기 주말'){echo 'selected';}?> style='color:#ff0000;'>성수기 주말</option>
				</select>
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