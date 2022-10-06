<?
	include "../../module/class/class.DbCon.php";

	if($uid){
		$sql = "select * from ks_product where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$msort = $row['msort'];
		$cade01 = $row['cade01'];

		if($type == 'up')				$set_sort = $msort + 1;
		elseif($type == 'down')		$set_sort = $msort - 1;

		$sql01 = "update ks_product set msort='$msort' where cade01='$cade01' and msort='$set_sort'";
		$result01 = mysql_query($sql01);

		$sql02 = "update ks_product set msort='$set_sort' where uid='$uid'";
		$result02 = mysql_query($sql02);
	}
?>

<form name='frm' method='post' action='<?=$next_url?>' target='_parent'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='cade01' value='<?=$cade01?>'>
</form>

<script language='javascript'>
document.frm.submit();
</script>