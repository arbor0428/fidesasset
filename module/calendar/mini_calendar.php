<?
//--------------------------------------------------------------------
//  PREVIL Calendar
//
//  - calendar.php / lun2sil.php(open source)
//
//  - Programmed by previl(previl@hanmail.net, http://dev.previl.net)
//  
//--------------------------------------------------------------------

if(!$c_path) $c_path=".";
if(!$cellh) $cellh  = 30;  // date cell height
if(!$tablew) $tablew = 190; //table width
?>


<style>
body{margin:0px;}
.all { border-width:1; border-color:#cccccc; border-style:solid; }
font {font-family:굴림체; font-size: 12px; color:#505050;}
font.title {font-family: 굴림체; font-size: 12px; font-weight: bold; color:#2579CF;}
font.week {font-family:돋움,돋움체; color:#ffffff;font-size:8pt;letter-spacing:-1}
font.num {font-family:tahoma; font-size:12px;}
font.holy {font-family:tahoma; font-size:12px; color:#FF6C21;}
font.num2 {font-family:tahoma; font-size:12px; color:#bbbbbb;}
a{text-decoration:none;}
</style>



<script language='javascript'>
function chk_day(daytxt){
	form = parent.document['<?=$form?>'];
	form['<?=$field?>'].value = daytxt;

	CL = parent.document.getElementById("CalendarLayer");
	CL.style.display = 'none';
}
</script>

<?
//--------------------------------------------------------------------
//  FUNCTION
//--------------------------------------------------------------------
include "lun2sol.php";   //양음변환 인클루드

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
    echo "  <TD align=center><font class=num2>$num</font></TD> \n";	
  }
}

//---- 오늘 날짜
$thisyear  = date('Y');  // 2000
$thismonth = date('n');  // 1, 2, 3, ..., 12
$today     = date('j');  // 1, 2, 3, ..., 31

//------ $year, $month 값이 없으면 현재 날짜
if (!$year=$HTTP_GET_VARS['year']) $year = $thisyear;
if (!$month=$HTTP_GET_VARS['month']) $month = $thismonth;
if (!$day=$HTTP_GET_VARS['day']) $day = $today;

//------ 날짜의 범위 체크
if (($year > 2038) or ($year < 1900)) ErrorMsg("연도는 1900~2038년만 가능합니다.");
if (($month > 12) or ($month < 0)) ErrorMsg("달은 1~12만 가능합니다.");
/*
while (checkdate($month,$day,$year)): 
    $date++; 
endwhile; 
$maxdate = date-1;
*/
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

/****************** 휴일 정의 ************************/
$HOLIDAY = Array();
$HOLIDAY[] = array(0=>'1-1',1=>'신정'); 
$HOLIDAY[] = array(0=>'3-1',1=>'삼일절');
//$HOLIDAY[] = array(0=>'4-5',1=>'식목일');
$HOLIDAY[] = array(0=>'5-5',1=>'어린이날');
$HOLIDAY[] = array(0=>'6-6',1=>'현충일');
//$HOLIDAY[] = array(0=>'7-17',1=>'제헌절');
$HOLIDAY[] = array(0=>'8-15',1=>'광복절');
$HOLIDAY[] = array(0=>'10-3',1=>'개천절');
$HOLIDAY[] = array(0=>'10-9',1=>'한글날');
$HOLIDAY[] = array(0=>'12-25',1=>'성탄절');

$tmp = lun2sol($year."0101");   //설날
$HOLIDAY[] = array(0=>date("n-j",($tmp-(3600*24))),1=>'설연휴');
$HOLIDAY[] = array(0=>date("n-j",$tmp),1=>'설날');
$HOLIDAY[] = array(0=>date("n-j",($tmp+(3600*24))),1=>'설연휴');;

$tmp = lun2sol($year."0408");   //석탄일
$HOLIDAY[] = array(0=>date("n-j",$tmp),1=>'석탄일');

$tmp = lun2sol($year."0815");   //추석
$HOLIDAY[] = array(0=>date("n-j",($tmp-(3600*24))),1=>'추석연휴');;
$HOLIDAY[] = array(0=>date("n-j",$tmp),1=>'추석');;
$HOLIDAY[] = array(0=>date("n-j",($tmp+(3600*24))),1=>'추석연휴');;

unset($tmp);

/****************** 휴일 정의 ************************/

// Style에서 띄어쓰면 안됨
echo("
<DIV align=center>
<TABLE cellSpacing=0 cellPadding=0 width=$tablew border=0>
<TR><TD width=1></TD><TD align=center>
        <TABLE cellSpacing=0 cellPadding=0 width=90% border=0 height=11>  
		<TR>
		    <TD width=1%></TD>
		    <TD width=14% align=center valign=bottom><img src='$c_path/img/box_top_line1.gif' width=5 height=3></TD>
			<TD width=14% align=center valign=bottom><img src='$c_path/img/box_top_line1.gif' width=5 height=3></TD>
			<TD width=14% align=center valign=bottom><img src='$c_path/img/box_top_line1.gif' width=5 height=3></TD>
			<TD width=14% align=center valign=bottom><img src='$c_path/img/box_top_line1.gif' width=5 height=3></TD>
			<TD width=14% align=center valign=bottom><img src='$c_path/img/box_top_line1.gif' width=5 height=3></TD>
			<TD width=14% align=center valign=bottom><img src='$c_path/img/box_top_line1.gif' width=5 height=3></TD>
			<TD width=14% align=center valign=bottom><img src='$c_path/img/box_top_line1.gif' width=5 height=3></TD>
			<TD width=1%></TD>
        </TR>
		</TABLE>
    </TD><TD width=1></TD>
</TR>
</TABLE>

<TABLE cellSpacing=0 cellPadding=0 width=$tablew border=0 class=all>
<TR><TD height=13 background='$c_path/img/box_top_bg.gif' align=center>
        <TABLE cellSpacing=0 cellPadding=0 width=90% border=0 height=13>  
		<TR>
		    <TD width=1%></TD>  
		    <TD width=14% align=center valign=top><img src='$c_path/img/box_top_line2.gif' width=5 height=7></TD>
			<TD width=14% align=center valign=top><img src='$c_path/img/box_top_line2.gif' width=5 height=7></TD>
			<TD width=14% align=center valign=top><img src='$c_path/img/box_top_line2.gif' width=5 height=7></TD>
			<TD width=14% align=center valign=top><img src='$c_path/img/box_top_line2.gif' width=5 height=7></TD>
			<TD width=14% align=center valign=top><img src='$c_path/img/box_top_line2.gif' width=5 height=7></TD>
			<TD width=14% align=center valign=top><img src='$c_path/img/box_top_line2.gif' width=5 height=7></TD>
			<TD width=14% align=center valign=top><img src='$c_path/img/box_top_line2.gif' width=5 height=7></TD>
			<TD width=1%></TD>
        </TR>
		</TABLE>
    </TD>
</TR>
<TR><TD align=center>
        <TABLE cellSpacing=0 cellPadding=0 width=90% border=0>
        <TR><TD height=3></TD></TR>   
		<TR><TD height=1 colspan=3 bgcolor=efefef></TD></TR>
		<TR><TD height=3></TD></TR>
		<TR><TD width=15% align=center>
		        <a href=$PHP_SELF?year=$prevyear&month=$prevmonth&day=1&form=$form&field=$field onfocus='this.blur()'><img src='$c_path/img/c_pre.gif' border=0 onfocus='this.blur();' align=absmiddle width=8 height=7></a>        
            </TD>
			<TD width=70% align=center>
				<font class=title>{$year}년 {$month}월</font>
            </TD>
			<TD width=15% align=center>
				<a href=$PHP_SELF?year=$nextyear&month=$nextmonth&day=1&form=$form&field=$field onfocus='this.blur()'><img src='$c_path/img/c_next.gif' border=0 onfocus='this.blur();' align=absmiddle width=8 height=7></a>
	        </TD>
		</TR>		
		</TABLE>
    </TD>
</TR>
<TR><TD height=3></TD></TR>
<TR><TD align=center>
        <TABLE cellSpacing=0 cellPadding=0 width=90% border=0>  
		<TR>
		    <TD bgcolor=#68AFF7><TABLE cellSpacing=0 cellPadding=0 width=1 height=1 border=0><TR><TD bgcolor=ffffff></TD></TR></TABLE></TD>
		    <TD colspan=7 bgcolor=#68AFF7 height=1></TD>
			<TD bgcolor=#68AFF7 align=right><TABLE cellSpacing=0 cellPadding=0 width=1 height=1 order=0><TR><TD bgcolor=ffffff></TD></TR></TABLE></TD>
		</TR>
		<TR><TD colspan=9 bgcolor=#68AFF7 height=3></TD></TR>
		<TR bgcolor=#68AFF7>
		    <TD width=1%></TD>
			<TD width=14% align=center><font class=week>일</font></TD>            
			<TD width=14% align=center><font class=week>월</font></TD>
			<TD width=14% align=center><font class=week>화</font></TD>
			<TD width=14% align=center><font class=week>수</font></TD>
			<TD width=14% align=center><font class=week>목</font></TD>
			<TD width=14% align=center><font class=week>금</font></TD>
			<TD width=14% align=center><font class=week>토</font></TD>
			<TD width=1%></TD>
        </TR>
		<TR><TD colspan=9 bgcolor=#68AFF7 height=1></TD></TR>
		<TR>
		    <TD bgcolor=#68AFF7><TABLE cellSpacing=0 cellPadding=0 width=1 height=1 border=0><TR><TD bgcolor=ffffff></TD></TR></TABLE></TD>
		    <TD colspan=7 bgcolor=#68AFF7 height=1></TD>
			<TD bgcolor=#68AFF7 align=right><TABLE cellSpacing=0 cellPadding=0 width=1 height=1 order=0><TR><TD bgcolor=ffffff></TD></TR></TABLE></TD>
		</TR>
");

echo("
		<TR height=$cellh><TD></TD>
        <!-- 날짜 테이블 -->
");

$date   = 1;
$offset = 0;
$ck_row=0; //프레임 사이즈 조절을 위한 체크인자

while ($date <= $maxdate) {   
   if ($date < 10) $date2 = "&nbsp;".$date;
   else $date2 = $date;
   if($date == '1') {
    $offset = date('w', mktime(0, 0, 0, $month, $date, $year));  // 0: sunday, 1: monday, ..., 6: saturday
    SkipOffset($offset,mktime(0, 0, 0, $month, $date, $year));
   }
   if($offset == 0) $style ="holy";
   else $style = "num";
   
   for($i=0;$i<count($HOLIDAY);$i++){	   
       if($HOLIDAY[$i][0] =="$month-$date") {
		   $style="holy"; 
		   $date2 = "<font title='{$month}월 {$date}일은 ".$HOLIDAY[$i][1]." 입니다' class='$style' style=cursor:hand>$date2</font>";    
		   break;
       }	   
   }

   $java_vars = $year.'-'.sprintf('%02d',$month).'-'.sprintf('%02d',$date);


   if ( $date == $today  &&  $year == $thisyear &&  $month == $thismonth) echo "<TD align=center valign=middle><TABLE cellpadding=0 cellspacing=0 border=0 width=20 height=20><TR><TD background='$c_path/img/date_bg.gif' align=center><a href=\"javascript:chk_day('$java_vars');\"><font class=num>$date2</font></a></TD></TR></TABLE></TD> \n";
   else echo "  <TD align=center><a href=\"javascript:chk_day('$java_vars');\"><font class=$style>$date2</font></a></TD> \n";
  
  $date++;
  $offset++;

  if ($offset == 7) {
    echo "<TD></TD></TR> \n";
    if ($date <= $maxdate) {
      echo "<TR height=$cellh><TD></TD>\n";
	  $ck_row++;
    }
    $offset = 0;
  }

} // end of while

if ($offset != 0) {
  SkipOffset((7-$offset),'','1');
  echo "<TD></TD></TR> \n";
}
echo("
<!-- 날짜 테이블 끝 -->
        </TD>
     </TR>
	 </TABLE>
<TR><TD height=3></TD></TR>
</TABLE>
</DIV>
")

?>