<?
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Msg.php';

if($type == 'sort' && $cade01){
	//총갯수
	if($cade01 == '촬영한복' || $cade01 == '혼주한복' || $cade01 == '친인척한복' || $cade01 == '잔치한복'){
		$query_ment = "where cade02 like '%$cade01%'";
	}else{
		$query_ment = "where cade01='$cade01'";
	}

	$sql = "select count(*) from ks_product $query_ment";
	$result = mysql_query($sql);
	$total = mysql_result($result,0,0);

	$plist = explode("|+|",$pro_list);
	$num = count($plist)-1;

	if($cade01 == '촬영한복')			$fname = "esort01";
	elseif($cade01 == '혼주한복')	$fname = "esort02";
	elseif($cade01 == '친인척한복')	$fname = "esort03";
	elseif($cade01 == '잔치한복')	$fname = "esort04";
	else										$fname = "msort";

	for($i=0; $i<$num; $i++){
		$msort = $total - $i;
		$uid = $plist[$i];

		$sql = "update ks_product set $fname=$msort where uid='$uid'";
		$result = mysql_query($sql);
	}

	if($cade01 == '여성한복')					$url = 'up_index01.php';
	elseif($cade01 == '남성한복')			$url = 'up_index02.php';
	elseif($cade01 == '커플한복')			$url = 'up_index03.php';
	elseif($cade01 == '촬영한복')			$url = 'etc01.php';
	elseif($cade01 == '혼주한복')			$url = 'etc02.php';
	elseif($cade01 == '여아한복')			$url = 'up_index01_1.php';
	elseif($cade01 == '남아한복')			$url = 'up_index02_1.php';
	elseif($cade01 == '친인척한복')			$url = 'etc03.php';
	elseif($cade01 == '잔치한복')			$url = 'etc04.php';
	elseif($cade01 == '털배자(조끼)')		$url = 'up_index04.php';
	elseif($cade01 == '장신구')				$url = 'up_index05.php';
	elseif($cade01 == '여아한복(판매)')	$url = 'up_index01_2.php';
	elseif($cade01 == '남아한복(판매)')	$url = 'up_index02_2.php';
	elseif($cade01 == '장신구(판매)')		$url = 'up_index05_2.php';

	if($url){
		Msg::goWinCloseNext($url);
	}
}
?>