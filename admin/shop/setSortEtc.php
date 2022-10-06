<?
	include "../../module/class/class.DbCon.php";

	if($uid){
		$sql = "select * from ks_product where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		if($cade02 == '촬영한복'){
			$fname = 'esort01';
			$esort = $row['esort01'];

		}elseif($cade02 == '혼주한복'){
			$fname = 'esort02';
			$esort = $row['esort02'];

		}elseif($cade02 == '친인척한복'){
			$fname = 'esort03';
			$esort = $row['esort03'];

		}elseif($cade02 == '잔치한복'){
			$fname = 'esort04';
			$esort = $row['esort04'];
		}

		$cade01 = $row['cade01'];

		if($type == 'up')				$set_sort = $esort + 1;
		elseif($type == 'down')		$set_sort = $esort - 1;

		$sql01 = "update ks_product set $fname='$esort' where cade01='$cade01' and $fname='$set_sort'";
		$result01 = mysql_query($sql01);

		$sql02 = "update ks_product set $fname='$set_sort' where uid='$uid'";
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