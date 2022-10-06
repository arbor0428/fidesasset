<?
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";

if($type == 'write'){
	$sTime = mktime(0,0,0,date('m'),date('d'),date('Y'));
	$eTime = mktime(23,59,59,date('m'),date('d'),date('Y'));

	//금일 발행된 일련번호
	$sql = "select max(cnt) from ks_ticket where rTime>=$sTime and rTime<=$eTime";
	$result = mysql_query($sql);
	$cnt = mysql_result($result,0,0) + 1;
	$code = date('Ymd').'-'.sprintf('%03d',$cnt);

	$userip = $_SERVER['REMOTE_ADDR'];
	$rDate = date('Y-m-d H:i:s');
	$rTime = mktime();

	$sql = "insert into ks_ticket (userid,name,guest,carNum,ment,code,cnt,userip,rDate,rTime) values ('$userid','$name','$guest','$carNum','$ment','$code','$cnt','$userip','$rDate','$rTime')";
	$result = mysql_query($sql);

	$msg = '등록되었습니다.';



}elseif($type == 'edit'){	
	$sql = "update ks_ticket set ";
	$sql .= "name='$name',";
	$sql .= "guest='$guest',";
	$sql .= "carNum='$carNum',";
	$sql .= "ment='$ment'";
	$sql .= " where uid='$uid'";
	$result = mysql_query($sql);

	$msg = '수정되었습니다.';




}elseif($type == 'del'){

	$sql = "delete from ks_ticket where uid='$uid'";
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
