<?
if($gubun != ""){
	include $DOCUMENT_ROOT.'/module/class/class.DbCon.php';

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
					<?
						break;
					case 2:?>
						opener.MEM.haddr.value=imsi_useraddr;
						opener.MEM.hzip1.value=imsi_userpost1;
						opener.MEM.hzip2.value=imsi_userpost2;
					<?
						break;
					case 3:?>
						opener.MEM.oaddr.value=imsi_useraddr;
						opener.MEM.ozip1.value=imsi_userpost1;
						opener.MEM.ozip2.value=imsi_userpost2;
					<?
						break;
					case 4:?>
						opener.MEM.bo_haddr.value=imsi_useraddr;
						opener.MEM.bo_hzip1.value=imsi_userpost1;
						opener.MEM.bo_hzip2.value=imsi_userpost2;
					<?
						break;
					case 5:?>
						opener.MEM.bo_oaddr.value=imsi_useraddr;
						opener.MEM.bo_ozip1.value=imsi_userpost1;
						opener.MEM.bo_ozip2.value=imsi_userpost2;
				<?}?>
						parent.window.close();
			</script>
<?
			break;
	}
	unset($dbconn);
}
?>

<html>
<head>
<title>::: 우편번호 찾기 :::</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head>
<LINK href="/css/new.css" type=text/css rel=stylesheet>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table width="320" height="100%" border=0 cellpadding="0" cellspacing="0">

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

<form action="<?=$PHP_SELF?>" method=post name=form1>
<input type=hidden name=gubun value="1">
<input type=hidden name=key value="<?=$key?>">

	<tr> 
		<td height="50" valign="top"><img src="/member/img/member_14.gif" width="320" height="50"></td>
	</tr>
	<tr> 
		<td valign="top" align="center" height=1>

		<br>
		찾고자하시는 지역의 동이나 읍/면의 이름을 공백없이
		<br>
        	입력하신 후, 검색버튼을 클릭하십시오.<BR>&nbsp;

		<table width="320" height="21" border="0" cellpadding="0" cellspacing="0">
			<tr> 
            			<td width="125" align="center">
					<img src="/member/img/icon_2.gif"> 읍/면/동의 이름</td>
				<td width="135">
					<input name="imsi_userjuso" type="text" size="10" maxlength="16" style="background-color:#ffffff;border:1 solid #999999; width:130px"> 
				</td>
				<td width="60"><input type=image src="/member/img/member_05.gif" width="46" height="21" border=0 onclick="javascript:return checkValue()"></td>
			</tr>
		</table>

	<?if($gubun == "" ){?>
		&nbsp;<br>
		ex) 주소가 '서울시특별시 강남구 역삼동..' 인경우 
		<br>
		역삼동 만 입력하시면 됩니다.
	<?}?>

		</td>
	</tr>

</form>


<?if($gubun == 1){?>

	<tr> 
		<td valign="top">

		<table width="320" border="0" cellpadding="1" cellspacing="1" valign="top">
			<tr bgcolor=#E1E4F0 height=23 align=center>
				<td width=17%>우편번호</td>
				<td width=83%>주 &nbsp;&nbsp;&nbsp; 소</td>
			</tr>

<?
if(!mysql_num_rows($result)){
?>

			<tr height=19 valign=top>
				<td colspan=2 align=center><B>찾으시는 주소가 없습니다. 다시검색해 주십시요.</td>
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

			<tr bgcolor=#F8F9FC height=19 valign=top>
				<td align=center><?=substr($row->ZIPCODE,0,3)?>-<?=substr($row->ZIPCODE,-3)?></td>
				<td> &nbsp; <a href="<?=$PHP_SELF?>?gubun=2&imsi_useraddr=<?=$imsi_useraddr2?>&imsi_userpost1=<?=substr($row->ZIPCODE,0,3)?>&imsi_userpost2=<?=substr($row->ZIPCODE,-3)?>&key=<?=$key?>"><?=$imsi_useraddr?></a></td>
			</tr>

<?
	}
}
?>

			<tr>
				<td></td>
			</tr>
		</table>

		</td>
	</tr>

<?}?>


	<tr> 
		<td bgcolor="#DEDEDE" align="center" height=1> 

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr> 
				<td align="center">
					<a href="javascript:window.close();"><img src="/member/img/member_06.gif" width="57" height="24" border="0"></a>
				</td>
			</tr>
		</table>

		</td>
	</tr>
</table>

</body>
</html>
