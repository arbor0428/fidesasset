<?
	include '../../module/class/class.DbCon.php';

	if(!$calendarFile)	$calendarFile = 'calendar01.php';
	if(!$cellh)	$cellh = '20';	// date cell height
	if(!$tablew)	$tablew = '235';	// table width
	if(!$c_path) $c_path=".";



	//해당 게시판의 읽기권한을 가져온다.
	$sql = "select * from ks_board_set where table_id='$table_id'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$cade01 = $row['cade01'];
	$cade02 = $row['cade02'];
	$read_chk = $row['read_chk'];

	//읽기권한설정
	include 'chk_view.php';

	if(!$chk_type)	$chk_type = 'ok';

?>
<!-- 
/******************************************************************
* =======================================================
* Calendar
*
* 제 작: gubok kim (email : previl@hanmail.net,  homepage : http://previl.net)
*
* 제작일: 2005.06.01 
*
* 기타 문의는 http://dev.previl.net 에 오셔서 하시기 바랍니다.
*
* 양음변환 부분은 공개자료(lun2sol.php)를 이용 했습니다.
* 달력을 홈페이지에 넣으실때는  <iframe>을 이용 하시기 바랍니다.
* <iframe border='0' frameborder='0' framespacing='0' marginheight='0' marginwidth='0'  scrolling='no' src='(경로/)calendar.php'  width='170' height='178' bgcolor=#ffffff></iframe>	
*
* =======================================================
******************************************************************/
-->
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>calendar</title>

<link href="/css/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="/module/js/common.js" type="text/JavaScript"></script>

<script language='javascript'>
function SetPageName(){
	form = document.frm_cal;
	skin_num = form.skin_num.value;
	form.target = '_parent';
	form.action = '/skins/'+skin_num+'/subpage/sub02.php';
	form.submit();
}


function setCalendar(y,m){
	form = document.frm_cal;
	form.year.value = y;
	form.month.value = m;
	form.day.value = '1';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}


<?
	if($chk_type == 'ok'){
		echo ("
			function setView(y,m,d){
				form = document.frm_cal;
				form.year.value = y;
				form.month.value = m;
				form.day.value = d;

				wschepop = window.open('about:blank', 'wschepop', 'scrollbars=yes,status=no,width=350,height=400,top=30,left=30');

				form.target = 'wschepop';
				form.action = 'view.php';
				form.submit();
			}");


	}else{
		echo ("
			function setView(y,m,d){
				alert('읽기 권한이 없습니다');
				return;
			}");
	}

?>
</script>
</head>

<form name='frm_cal' method='post' action='<?=$PHP_SELF?>'>
<input type='hidden' name='GBL_MTYPE' value='<?=$GBL_MTYPE?>'>
<input type='hidden' name='userid' value='<?=$userid?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='calendarFile' value='<?=$calendarFile?>'>
<input type='hidden' name='cellh' value='<?=$cellh?>'>
<input type='hidden' name='tablew' value='<?=$tablew?>'>

<!-- 상세보기 페이지로 이동시 필요한 변수 -->
<input type='hidden' name='SITE_ID' value='<?=$userid?>'>
<input type='hidden' name='skin_num' value='<?=$skin_num?>'>
<input type='hidden' name='mCade01' value='<?=$cade01?>'>
<input type='hidden' name='mCade02' value='<?=$cade02?>'>

<table cellpadding='0' cellspacing='0' border='0' width='100%' height='100%'>
	<tr>
		<td valign='top'>
		<?
			include $calendarFile;
		?>
		</td>
	</tr>
</table>

<input type='hidden' name='year' value='<?=$year?>'>
<input type='hidden' name='month' value='<?=$month?>'>
<input type='hidden' name='day' value=''>

</form>

<?
	//아이프레임 사이즈 조절
/*
	if($ck_row==4) $height=178;
	else $height=198;

	echo ("<script>resizeTo(235,$height)</script>");
*/
?>

</body>
</html>
