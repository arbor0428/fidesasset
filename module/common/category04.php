<?
	include '../class/class.DbCon.php';

	$cade03 = iconv("utf-8","euc-kr",$cade03);

	$sql04 = "select * from ks_user_cade04 where cade03='$cade03' order by sort";
	$result04 = mysql_query($sql04);
	$num04 = mysql_num_rows($result04);

	$mCade04List = '';

	for($s=0; $s<$num04; $s++){
		$row04 = mysql_fetch_array($result04);
		$cade04 = $row04['cade04'];
//		$cade04 = iconv("euc-kr","utf-8",$cade04);

		if($mCade04List)	$mCade04List .= '|+|';

		$mCade04List .= $cade04;
	}

	echo $mCade04List;
?>