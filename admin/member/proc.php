<?
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";
include "../../module/class/class.Util.php";

if($type == 'write'){

	//아이디 중복체크
	$sql = "select * from tb_member where userid='$userid'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num){
		echo ("<script language='javascript'>");
		echo ("parent.GblMsgBox('사용할 수 없는 아이디입니다.','');");
		echo ("</script>");
		exit;

	}else{
		$mtype = $mChk01.$mChk02.$mChk03.$mChk04.$mChk05;
		$userip = $_SERVER[REMOTE_ADDR];
		$reg_date = mktime();

		$sql = "insert into tb_member (mtype,userid,pwd,name,userip,reg_date) values ('$mtype','$userid','$pwd','$name','$userip','$reg_date')";
		$result = mysql_query($sql);

		$msg = '등록되었습니다.';
	}



}elseif($type == 'edit'){
	$mtype = $mChk01.$mChk02.$mChk03.$mChk04.$mChk05;
	
	$sql = "update tb_member set ";
	$sql .= "mtype='$mtype',";
	$sql .= "name='$name',";
	$sql .= "pwd='$pwd'";
	$sql .= " where uid='$uid'";
	$result = mysql_query($sql);

	$msg = '수정되었습니다.';




}elseif($type == 'del'){

	$sql = "delete from tb_member where uid='$uid'";
	$result = mysql_query($sql);

	$msg = '삭제되었습니다.';
}
?>

<?
	if($msg){
?>

<script language='javascript'>
function OrderSave(){
	parent.GblMsgBox("<?=$msg?>","reg_list();");
}

OrderSave();
</script>

<?
	}
?>
