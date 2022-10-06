<?
	switch($mod){
		case '1' :	$url = './cp_proc.php';
						break;
		case '2' :	$url = './cp_re_proc.php';
						break;
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>비밀번호 확인</title>
<style type="text/css">
body{margin:0px;}
</style>
<script language='javascript'>
function is_Enter(){
	if(event.keyCode==13){
	  frm_check();
	  event.returnValue=false;
	}
}

function frm_check(){
	form = document.FRM;
	if(form.pwd.value == ''){
		alert('비밀번호를 입력해 주십시오');
		form.pwd.focus();
		return;
	}
	form.target = 'ifra';
	form.submit();
}

</script>
</head>
<body onload='document.FRM.pwd.focus();'>
<form name='FRM' method='post' action='<?=$url?>'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='idx' value='<?=$idx?>'>
<input type='hidden' name='up_idx' value='<?=$up_idx?>'>
<input type='hidden' name='next_url' value='<?=$next_url?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='word' value='<?=$word?>'>
<table width="268" height="152" border="0" cellpadding="0" cellspacing="0">
 <tr>
  <td width="268" height="152" align="center" valign="middle" background="./images/bg.jpg">
   <table width="80%" height="23" border="0" cellpadding="0" cellspacing="0">
    <tr>
	 <td width="72%"><input name="pwd" type="password" size="20" maxlength="10" onkeypress='is_Enter();'></td>
	 <td width="3%"></td>
	 <td width="25%"><a href="javascript:frm_check();"><img src="./images/ok_btn.jpg" border=0></a></td>
	</tr>
   </table>
  </td>
 </tr>
</table>
</form>
<iframe src='about:blank' name='ifra' frameborder=0 width=1 height=1></iframe>
</body>
</html>
