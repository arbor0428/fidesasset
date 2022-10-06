<script language='javascript'>
function chk(){
	document.frm.submit();
}
</script>

<form name='frm' method='post' action='pos_test.php'>
	<input type='text' name='a' value='a'>
	<input type='text' name='b' value='b'>
	<input type='text' name='c' value='c'>
	<input type='button' value='전송' onclick='chk();'>
</form>