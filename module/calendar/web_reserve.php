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

.toDayBox{background:#ecf1fa;border:1px solid #3667b3;min-height:<?=$cellh?>px;}

.endDayBox{background:#eee;}

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


$ny = date('Y');
$nm = date('m')+3;	//3개월까지만 예약가능

$nt = mktime(0,0,0,$nm,1,$ny);

$chkYear = date('Y',$nt);
$chkMonth = date('n',$nt);


//3개월이후 달력선택불가
$tt = mktime(0,0,0,$month,1,$year);
if($tt > $nt)	ErrorMsg("해당 달력은 선택할 수 없습니다.");

//이전달력선택불가
$bt = mktime(0,0,0,date('m'),1,$ny);
if($tt < $bt)	ErrorMsg("해당 달력은 선택할 수 없습니다.");



//양음변환 및 휴일정의
include "lun2sol.php";


$dailyArr = Array();

//기존에 설정된 적용요금
$sql = "select * from ks_daily_charge where scode='$scode' and rYear='$year' and rMonth='$month' order by rTime";
$result = mysql_query($sql);
$num = mysql_num_rows($result);

for($i=0; $i<$num; $i++){
	$row = mysql_fetch_array($result);
	$rDay = $row['rDay'];

	$dailyArr[$rDay] = $row['smode'];
}



$roomArr = Array();		//객실명 & 객실ID
$chargeArr = Array();		//객실별 이용요금
$rnumArr = Array();		//객실수



//객실정보
$sql = "select * from ks_product where scode='$scode' order by uid";
$result = mysql_query($sql);
$num = mysql_num_rows($result);

for($i=0; $i<$num; $i++){
	$row = mysql_fetch_array($result);
	$uid = $row['uid'];
	$title = $row['title'];
	$rnum = $row['rnum'];
	$roomArr[$uid] = $title;

	$bprice01 = $row['bprice01'];	//비수기주중
	$bprice02 = $row['bprice02'];	//비수기금요일
	$bprice03 = $row['bprice03'];	//비수기주말

	$jprice01 = $row['jprice01'];		//준성수기주중
	$jprice02 = $row['jprice02'];		//준성수기금요일
	$jprice03 = $row['jprice03'];		//준성수기주말

	$sprice01 = $row['sprice01'];	//성수기주중
	$sprice02 = $row['sprice02'];	//성수기금요일
	$sprice03 = $row['sprice03'];	//성수기주말

	$chargeArr[$uid][0] = $bprice01;
	$chargeArr[$uid][1] = $bprice02;
	$chargeArr[$uid][2] = $bprice03;
	$chargeArr[$uid][4] = $jprice01;
	$chargeArr[$uid][5] = $jprice02;
	$chargeArr[$uid][6] = $jprice03;
	$chargeArr[$uid][7] = $sprice01;
	$chargeArr[$uid][8] = $sprice02;
	$chargeArr[$uid][9] = $sprice03;

	$rnumArr[$uid] = $rnum;
}






//일자별요금정보
$startTime = mktime(0,0,0,$month,1,$year);
$endTime = mktime(0,0,0,$month,$maxdate,$year);

$etcArr = Array();

$sql = "select * from ks_roomAmt where scode='$scode' and rTime>='$startTime' and rTime<='$endTime' order by uid";
$result = mysql_query($sql);
$num = mysql_num_rows($result);
if($num){
	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$roomID = $row['roomID'];
		$rTime = $row['rTime'];
		$price = $row['price'];

		$etcArr[$roomID][$rTime] = $price;
	}
}






//예약정보
$startTime = mktime(0,0,0,$month,1,$year) - (86400 * 6);
$endTime = mktime(0,0,0,$month,$maxdate,$year) + (86400 * 6);

$reserveArr = Array();			//예약상태
$reserveArr01 = Array();		//예약자명
$reserveArr02 = Array();		//예약자연락처

$sql = "select * from ks_reserve where scode='$scode' and revTime>=$startTime and revTime<=$endTime order by revTime asc, revRoom asc, uid asc";
$result = mysql_query($sql);
$num = mysql_num_rows($result);

for($i=0; $i<$num; $i++){
	$row = mysql_fetch_array($result);
	$revRoom = $row['revRoom'];
	$revTimeList = $row['revTimeList'];
	$status = $row['status'];
	$name = Util::NameCutStr($row['name'],'1','*');
	$mobile01 = $row['mobile01'];
	$mobile02 = $row['mobile02'];
	$mobile03 = $row['mobile03'];

	$mobile = '';
	if($mobile02 || $mobile03){
		$mobile = $mobile01;
		if($mobile02)	$mobile .= '-****';
		if($mobile03)	$mobile .= '-'.$mobile03;
	}

	$revTimeEx = explode(',',$revTimeList);
	for($r=0; $r<count($revTimeEx); $r++){
		$revTime = $revTimeEx[$r];
		$reserveArr[$revRoom][$revTime][] = $status;
		$reserveArr01[$revRoom][$revTime][] = $name;
		$reserveArr02[$revRoom][$revTime][] = $mobile;
	}
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

function reserve(d,r){
	form = document.frm01;
	form.day.value = d;
	form.roomID.value = r;
	form.target = '';
	form.action = 'reserve01.php';
	form.submit();
}

function setTxtColor(obj){
	ov = obj.value;
	oarr = ov.split(' ');

	if(oarr[0] == '비수기')			$('#'+obj.name).css('color','#212121');
	else if(oarr[0] == '준성수기')	$('#'+obj.name).css('color','#0000ff');
	else if(oarr[0] == '성수기')		$('#'+obj.name).css('color','#de712e');
}

function reserveInfo(name, mobile, thisID, week){
	if(name != ''){
		var pos = $('#'+thisID).offset();
		$('#revUserName').html(name);
		$('#revUserMobile').html(mobile);

		nameTxt = name.split('<br>');
		nameLen = nameTxt.length;

		mt = 45-71;
		if(nameLen == 2)			mt = 35-71;
		else if(nameLen == 3)	mt = 27-71;
		else if(nameLen == 4)	mt = 15-71;
		else if(nameLen == 5)	mt = 5-71;
		else if(nameLen == 6)	mt = -5-71;
		else if(nameLen == 7)	mt = -15-71;
		else if(nameLen == 8)	mt = -27-71;
		else if(nameLen == 9)	mt = -35-71;
		else if(nameLen == 10)	mt = -43-71;

		if(week == "6"){
			$('.reserveInfoBox').attr('class','reserveInfoBoxSat');
			if(mobile == ""){
				$('.reserveInfoBoxSat').css('top',pos.top-$('.reserveInfoBoxSat').height()-mt);
			}else{
				$('.reserveInfoBoxSat').css('top',pos.top-102);
			}                
			$('.reserveInfoBoxSat').css('left',pos.left-$('.reserveInfoBoxSat').width()-40);
			$('.reserveInfoBoxSat').show();

		}else{
			if(mobile == ""){
				$('.reserveInfoBox').css('top',pos.top-$('.reserveInfoBox').height()-mt);
			}else{
				$('.reserveInfoBox').css('top',pos.top-102);
			}
			
			$('.reserveInfoBox').css('left',($('#'+thisID).width()+pos.left)+10);
			$('.reserveInfoBox').show();
		}
	}
}

function reserveInfoClose(){
	$('.reserveInfoBoxSat').attr('class','reserveInfoBox');
	$('.reserveInfoBox').hide();
}

function roomCharge(c){
	if(c)	$('.rc').show();
	else	$('.rc').hide();
}
</script>

<div class="reserveInfoBox" onmouseleave="reserveInfoClose();">
	<div class="reserveInfoTitle">예약자</div>
	<div class="reserveInfoContent">
		<p id="revUserName" style='line-height:20px;'></p>
		<p id="revUserMobile"></p>
	</div>
</div>


<table cellSpacing='0' cellPadding='0' width='<?=$tablew?>' border='0'>
	<tr>
		<td align='center'>
			<table cellSpacing='0' cellPadding='0' border='0'>
				<tr>
					<td>
					<?
						if($month != date('m')){
					?>
						<a href="javascript:setCalendar('<?=$prevyear?>','<?=$prevmonth?>');" onfocus='this.blur()'><img src='/images/go_left.gif' border='0' onfocus='this.blur();' align='absmiddle'></a>
					<?
						}
					?>
					</td>
					<td style='padding:0 20px' align='center'><font class='title'><?=$year?>년 <?=$month?>월</font></td>
					<td>
					<?
						if($year == $chkYear && $month == $chkMonth){
						}else{
					?>
						<a href="javascript:setCalendar('<?=$nextyear?>','<?=$nextmonth?>');" onfocus='this.blur()'><img src='/images/go_right.gif' border='0' onfocus='this.blur();' align='absmiddle'></a>
					<?
						}
					?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style='padding:20px 0 10px 0;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td>
						<span class='Bico01'>가</span> 예약가능&nbsp;&nbsp;&nbsp;&nbsp;
						<span class='Jico01'>대</span> 입금대기&nbsp;&nbsp;&nbsp;&nbsp;
						<span class='Sico03'>완</span> 예약완료&nbsp;&nbsp;&nbsp;&nbsp;
						<span class='Nico01'>불</span> 예약불가
					</td>
					<td width='130'>
						<div class="rc_btn">
							<div class="squaredThree">
								<input type="checkbox" value="1" id="squaredThree1" name="rcChk" onclick='roomCharge(this.checked);'>
								<label for="squaredThree1"></label>
							</div>
							<p>일자별 요금보기</p>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
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
$todayTime = mktime();

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

	$smodeArr = explode(' ',$smodeTxt);
	if($smodeArr[0] == '비수기')			$sTxtColor = '#212121';
	elseif($smodeArr[0] == '준성수기')	$sTxtColor = '#0000ff';
	elseif($smodeArr[0] == '성수기')		$sTxtColor = '#de712e';


	//비수기,준성수기,성수기 문구표시안함
	$smodeTitle = $smodeTxt;
	if($bHide)	$smodeTitle = str_replace('비수기 ','',$smodeTitle);
	if($jHide)		$smodeTitle = str_replace('준성수기 ','',$smodeTitle);
	if($sHide)	$smodeTitle = str_replace('성수기 ','',$smodeTitle);


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

	$thisDayTime = mktime(23,59,59,$month,$date,$year);
	$bgc = '';

	//지난일자 배경색지정
	if($thisDayTime < $todayTime){
		$bgc = "class='endDayBox'";
		$sTxtColor = '#bbbbbb';
		$smodeTitle = '예약종료';
	}
?>


	<!-- 날짜출력 -->
	<td valign='top' <?=$bgc?> <?=$date_title?>>
	<?
		if($toChk){
			echo ("<div class='toDayBox'>");
		}
	?>

			<div style='margin:3px 0 0 3px;' class='<?=$style?>'>
				<span style='font-size:16px;'><?=$date2?></span> <span style='margin:0 0 0 15px;color:<?=$sTxtColor?>;'><?=$smodeTitle?></span>
			</div>
			<div style='width:100%;margin:15px 0 10px 5px;'>
		<?
			$this_sTime = mktime(0, 0, 0, $month, $date, $year);
			$this_eTime = mktime(23, 59, 59, $month, $date, $year);

			//금일이후에만 객실을 표시한다
			if($todayTime < $this_eTime){
				foreach($roomArr as $key => $vals){

					//객실요금
					$roomCharge = 0;
					if($smodeTxt == '비수기 주중')				$roomCharge = $chargeArr[$key][0];
					elseif($smodeTxt == '비수기 금요일')		$roomCharge = $chargeArr[$key][1];
					elseif($smodeTxt == '비수기 주말')			$roomCharge = $chargeArr[$key][2];
					elseif($smodeTxt == '준성수기 주중')		$roomCharge = $chargeArr[$key][4];
					elseif($smodeTxt == '준성수기 금요일')	$roomCharge = $chargeArr[$key][5];
					elseif($smodeTxt == '준성수기 주말')		$roomCharge = $chargeArr[$key][6];
					elseif($smodeTxt == '성수기 주중')			$roomCharge = $chargeArr[$key][7];
					elseif($smodeTxt == '성수기 금요일')		$roomCharge = $chargeArr[$key][8];
					elseif($smodeTxt == '성수기 주말')			$roomCharge = $chargeArr[$key][9];

					$onlyAmt = '';

					//일자별적용요금확인
					if($etcArr[$key][$this_sTime] != ''){
						$onlyAmt = " <span style='color:#52809a;'><strike>".number_format($roomCharge)."원</strike></span>";
						$roomCharge = $etcArr[$key][$this_sTime];
					}

					$roomChargeTxt = number_format($roomCharge).'원';


					//객실수
					$rn = $rnumArr[$key];

					//예약수
					$ro = count($reserveArr[$key][$this_sTime]);

					//예약자정보
					$reserveIcon = '';
					$reserveName = '';
					$reservePhone = '';
					$reserveBlock = 0;

					for($r=0; $r<$ro; $r++){
						//객실수가 1개이상인 경우
						if($rn > 1){
							if($reserveName)		$reserveName .= "<br>";

							if($reserveArr[$key][$this_sTime][$r] == '입금대기'){
								$reserveIcon = "<span class=\'Jico01\'>대</span>";
							}elseif($reserveArr[$key][$this_sTime][$r] == '예약완료'){
								$reserveIcon = "<span class=\'Sico03\'>완</span>";
							}elseif($reserveArr[$key][$this_sTime][$r] == '예약불가'){
								$reserveIcon = "<span class=\'Nico01\'>불</span>";
								$reserveBlock++;
							}

							$reserveName .= $reserveIcon." ".$reserveArr01[$key][$this_sTime][$r];
							$reservePhone = '';

						}else{
							$reserveName .= $reserveArr01[$key][$this_sTime][$r];
							$reservePhone .= $reserveArr02[$key][$this_sTime][$r];
						}
					}


					if($rn > 1){
						if($ro >= $rn){
							$rs = '예약완료';
						}else{
							$rs = '';
							$rm = $rn - $ro;		//남은객실수
							$vals .= ' ('.$rm.')';
						}

						if($reserveBlock == $rn)		$rs = '예약불가';

					}else{
						//예약상태
						$rs = $reserveArr[$key][$this_sTime][0];
					}					

		?>
				<li style='margin:8px 0 0 0;'>
				<?
					if($rs == '입금대기'){
				?>
					<span class='Jico01'>대</span> 
					<label onmouseenter="reserveInfo('<?=$reserveName?>','<?=$reservePhone?>',this.id, '<?=$offset?>');"  id="rev_<?=$year?><?=$month?><?=$date?>_<?=$key?>" onmouseout="reserveInfoClose();"><?=$vals?></label>
				<?
					}elseif($rs == '예약완료'){
				?>
					<span class='Sico03'>완</span> 
					<label onmouseenter="reserveInfo('<?=$reserveName?>','<?=$reservePhone?>',this.id, '<?=$offset?>');"  id="rev_<?=$year?><?=$month?><?=$date?>_<?=$key?>" onmouseout="reserveInfoClose();"><?=$vals?></label>
				<?
					}elseif($rs == '예약불가'){
				?>
					<span class='Nico01'>불</span> 
					<?=$vals?>
				<?
					}else{
				?>
					<span class='Bico01'>가</span> 
					<a href="javascript:reserve('<?=$date?>','<?=$key?>');" class='revRoom'><?=$vals?></a>
				<?
					}
				?>
				</li>
				<li style='margin:8px 0 0 5px;color:#ff5432;display:none;' class='rc'><?=$roomChargeTxt?><?=$onlyAmt?></li>
		<?
				}
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
	})
});
</script>