<?
	include './module/class/class.DbCon.php';

$sql = "select * from tb_popup where uid='$uid'";
$result = mysql_query($sql);
$info = mysql_fetch_array($result);
$D_date = $info[pop_day];

if(!$D_date)	$D_date = '1';

$ment = $info[ment];
$ment = str_replace('autostart="true"', 'autostart=false', $ment);
?>

<title><?=$info[title]?></title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<link href='/templet/css/style3.css' rel='stylesheet' type='text/css'>
<link type='text/css' rel='stylesheet' href='/css/style.css'>
<style type='text/css'>
body{
	margin:0px;
	SCROLLBAR-FACE-COLOR: #EFEFEF;
	SCROLLBAR-SHADOW-COLOR: #CCCCCC;
	SCROLLBAR-3DLIGHT-COLOR: #B4B4B4;
	SCROLLBAR-ARROW-COLOR: #ffffff;
	SCROLLBAR-DARKSHADOW-COLOR: #ffffff; 
	SCROLLBAR-BASE-COLOR: #EFEFEF; 
}
</style>

<script language="javascript" src="/css/dsmna.js" type="text/JavaScript"></script>

<SCRIPT language="JavaScript"> 
// 쿠키를 만듭니다. 아래 closeWin() 함수에서 호출됩니다

function setCookie( name, value, expiredays ){ 
	var todayDate = new Date(); 
	todayDate.setDate( todayDate.getDate() + expiredays ); 
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";" 
} 

// 체크후 닫기버튼을 눌렀을때 쿠키를 만들고 창을 닫습니다

function closeWin(day){
	form = document.pop;

	id = '<?=$info[reg_date]?>';

	if(form.event1.checked){
		setCookie( "Coo"+id, "done" , day); // 오른쪽 숫자는 쿠키를 유지할 기간을 설정합니다		
	}

	self.close();
}
</SCRIPT>



<table cellpadding=0 cellspacing=0 border=0 width='<?=$info[pop_width]?>' height='<?=$info[pop_height]?>' style="TABLE-LAYOUT: fixed" valign='top'>
<form name=pop>
	<tr>
		<td align=center background="/templet/images/line.jpg" style="word-break:break-all;"><?=$ment?></td>
	</tr>
</table>


<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor='#161817' height=20>
	<tr>
		<td width=10><label for='event1'><input type='checkbox' name='event1' id='event1' value='' onclick='closeWin(<?=$D_date?>);' style='border:0px;'></label></td>
		<td style='padding-top:3px;'><span style="color:'#FFFFFF';"><?=$D_date?>일 동안 열지않기</span></td>
		<td width=45 style='padding-top:3px;'><a href="javascript:closeWin()"><font color='#ffffff'>[닫기]</font></td>
	</tr>
</form>
</table>


