<?
if($gubun != ""){
	include '../class/class.DbCon.php';

	$db = new DbCon();
	$dbconn = $db->getConnection();

	switch($gubun){
		case 1:
			$sql= "select * from zipcode where DONG like '".$imsi_userjuso."%' order by DONG,BUNJI asc";
			$result = mysql_query($sql);
			break;

		case 2:
?>
			<script language="javascript">
				var imsi_useraddr = "<?=$imsi_useraddr?>";
				var imsi_userpost1 = "<?=$imsi_userpost1?>";
				var imsi_userpost2 = "<?=$imsi_userpost2?>";

<?
					switch($key){
						case 1:
?>
						opener.MEM.addr1.value=imsi_useraddr;
						opener.MEM.zip1.value=imsi_userpost1;
						opener.MEM.zip2.value=imsi_userpost2;
						opener.MEM.addr2.focus();
						opener.MEM.addr2.focus();
						
					<?
						break;
					case 2:?>
						opener.MEM.p_addr1.value=imsi_useraddr;
						opener.MEM.p_zip1.value=imsi_userpost1;
						opener.MEM.p_zip2.value=imsi_userpost2;
						opener.MEM.p_addr2.focus();
						opener.MEM.p_addr2.focus();
					<?
						break;
					case 3:?>
						opener.frm_order.b_addr1.value=imsi_useraddr;
						opener.frm_order.b_zip1.value=imsi_userpost1;
						opener.frm_order.b_zip2.value=imsi_userpost2;
						opener.frm_order.b_addr2.focus();
						opener.frm_order.b_addr2.focus();
					<?
						break;
					case 4:?>
						opener.frm01.p_addr1.value=imsi_useraddr;
						opener.frm01.p_zip1.value=imsi_userpost1;
						opener.frm01.p_zip2.value=imsi_userpost2;
						opener.frm01.p_addr2.focus();
						opener.frm01.p_addr2.focus();
					<?
						break;
					case 5:?>
						opener.frm01.addr1.value=imsi_useraddr;
						opener.frm01.zip1.value=imsi_userpost1;
						opener.frm01.zip2.value=imsi_userpost2;
						opener.frm01.addr2.focus();
						opener.frm01.addr2.focus();
				<?}?>
						parent.window.close();						
			</script>
<?
			break;
	}
}
?>

<html>
<head>
<title>::: 우편번호 찾기 :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="/css/style.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload='document.form1.imsi_userjuso.focus();'>

<table width="320" height="100%" border=0 cellpadding="0" cellspacing="0" background='/images/member/client/add_bg.gif'>

<script language="JavaScript">
<!--
function checkValue() {
	if (form1.imsi_userjuso.value=="") {
		alert("현재 거주하고 계시는 읍/면/동 명을 입력하세요.") ;
		form1.imsi_userjuso.focus() ;
		return false ;
	}
	form1.submit() ;
	return false ;
}
//-->
</script>

	<tr valign='top'>
		<td><img src='/images/member/client/add_top.gif' border='0' /></td>
	</tr>
	<tr valign='top'>
		<td style='padding:7 0 0 49'>
			
			<form action="<?=$PHP_SELF?>" method=post name=form1>
			<input type=hidden name=gubun value="1">
			<input type=hidden name=key value="<?=$key?>">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr height='23'>
					<td><img src='/images/member/client/add_tt.gif' border='0' /></td>
					<td><input name="imsi_userjuso" type="text" size="10" maxlength="16" style="background-color:#ffffff;border:1 solid #999999; width:119; height=18;ime-mode:active;"></td>
					<td style='padding:0 53 0 8'><input type=image src="/images/member/client/add_search.gif" width="47" height="23" border=0 onclick="javascript:return checkValue()"></td>
				</tr>
			</table>
			</form>

		</td>
	</tr>
	<tr valign='top'>
		<td style='padding:26 20 0 20'>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0" background='/images/member/client/add_line_bg.gif' style="background-repeat : repeat-x;">
				<tr align='center' height='34'>
					<td width='30%'><img src='/images/member/client/add_tt_01.gif' border='0' /></td>
					<td width='3'><img src='/images/member/client/add_line.gif' border='0' /></td>
					<td width='70%'><img src='/images/member/client/add_tt_02.gif' border='0' /></td>
				</tr>
<?
if($gubun == 1){
	if(!mysql_num_rows($result)){
?>
				<tr height='100'>
					<td colspan='3' align='center'><img src='/images/member/client/add_txt.gif' border='0' /></td>
				</tr>
<?
	}else{
		while($row = mysql_fetch_object($result)){
			if($row->BUNJI!=""){
				$imsi_s4 = $row->BUNJI;
			}else{
				$imsi_s4 = $row->BUNJI;
				$imsi_s4 = str_replace($imsi_s4,"(","");
				$imsi_s4 = str_replace($imsi_s4,")","");
			}

			$imsi_useraddr = $row->SIDO." ".$row->GUGUN." ".$row->DONG." ".$imsi_s4." ";
			$imsi_useraddr2 = $row->SIDO." ".$row->GUGUN." ".$row->DONG
?>
				<tr height='26' align='center'>
					<td><?=substr($row->ZIPCODE,0,3)?>-<?=substr($row->ZIPCODE,-3)?></td>
					<td></td>
					<td><a href="<?=$PHP_SELF?>?gubun=2&imsi_useraddr=<?=$imsi_useraddr2?>&imsi_userpost1=<?=substr($row->ZIPCODE,0,3)?>&imsi_userpost2=<?=substr($row->ZIPCODE,-3)?>&key=<?=$key?>"><?=$imsi_useraddr?></a></td>
				</tr>
				<tr>
					<td colspan='3' height='1' bgcolor='e9e9e9'></td>
				</tr>
<?
		}
	}
}else{
?>
				<tr height='100'>
					<td colspan='3' align='center'><img src='/images/member/client/add_txt.gif' border='0' /></td>
				</tr>
<?
}
?>
				<tr>
					<td height='2' bgcolor='d2d2d2' colspan='3'></td>
				</tr>
				<tr>
					<td height='10'></td>
				</tr>
			</table>

		</td>
	</tr>
	<tr valign='bottom'>
		<td height='41' background='/images/member/client/add_bottom.gif'>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align='center' style='padding-bottom:4px'><a href="javascript:window.close();"><img src="/images/member/client/btn_add_ok.gif" width="81" height="24" border="0"></a></td>
				</tr>
			</table>

		</td>
	</tr>
</table>
</body>
</html>
