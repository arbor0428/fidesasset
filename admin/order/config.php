<?
	include "../../module/class/class.DbCon.php";

	$sql = "select * from ks_sms_config order by uid desc limit 1";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$uid = $row['uid'];
	$nlist = $row['nlist'];
?>

<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<script language='javascript' src='/module/js/common.js'></script>
<link type='text/css' rel='stylesheet' href='/css/style.css'>
<style type='text/css'>
body{margin:5px;}
</style>

<script language='javascript'>
function check_form(){
	form = document.frm01;

	if(isFrmEmpty(form.nlist,"수신번호를 입력해 주십시오"))	return;

	form.action = 'config_proc.php';
	form.submit();
}
</script>


<form name='frm01' action="config_proc.php" method='post'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>

<br><br><br>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td>* 주문접수시 알림문자를 수신받을 번호를 입력해 주세요</td>
	</tr>
</table>
<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;border-top:0px;" bordercolor="cccccc" frame="hsides" class='s'>
	<tr> 
		<td bgcolor="cccccc"  style='padding:1px 0px 0px 0px;' colspan="2"></td>
	</tr>
	<tr height='30'> 
		<td width="17%" class='tab_tit'>수신번호</td>
		<td width="83%" class='tab'><input type='text' name='nlist' style='width:98%;' class='bill03' value='<?=$nlist?>'><br>콤마로 구분하여 입력해 주십시오 (예 : 01012345678,01098765432)</td>
	</tr>
</table>

<table cellpadding='0' cellspacing='0' border='0' width='100%' style='margin-top:15px;'>
	<tr>
		<td align='right'><a href="javascript:check_form();"><img src='/images/common/register.gif'></a></td>
	</tr>
</table>

</form>


<?
	mysql_close($dbconn);
	unset($dbconn);
?>