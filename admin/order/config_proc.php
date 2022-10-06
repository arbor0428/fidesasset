<?
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Msg.php";

	$sql = "update ks_sms_config set ";
	$sql .= "nlist='$nlist' ";
	$sql .= " where uid=$uid";
	$result = mysql_query($sql);


	Msg::goMsg('등록되었습니다',$next_url);
?>