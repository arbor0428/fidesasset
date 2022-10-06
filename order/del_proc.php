<?
include "../module/class/class.DbCon.php";
include "../module/class/class.Msg.php";

if($type == 'del'){
	$sql = "delete from ks_cart where uid=$uid";
	$result = mysql_query($sql);
	
	Msg::goParent('/order/up_index.php');
}


unset($dbconn);
?>
