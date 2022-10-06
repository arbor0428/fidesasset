<?
	include '../class/class.DbCon.php';

	$cade01 = iconv("utf-8","euc-kr",$cade01);

	$sql02 = "select * from ks_user_cade02 where cade01='$cade01' order by sort";
	$result02 = mysql_query($sql02);
	$num02 = mysql_num_rows($result02);

	$mCade02List = '';

	for($s=0; $s<$num02; $s++){
		$row02 = mysql_fetch_array($result02);
		$cade02 = $row02['cade02'];
//		$cade02 = iconv("euc-kr","utf-8",$cade02);

		if($mCade02List)	$mCade02List .= '|+|';

		$mCade02List .= $cade02;
	}

	echo $mCade02List;
?>