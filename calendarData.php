<?
	include './module/class/class.DbCon.php';

	$cYear = $_POST['cYear'];
	$cMonth = sprintf('%02d',$_POST['cMonth']);

	//공연전시 > 월간일정 데이터를 가져온다.
	$sql = "select distinct(data03) from tb_board_list where table_id='table_1512604967' and data01='$cYear' and data02='$cMonth' order by data03";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	//리턴값
	$Data = '';

	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$data03 = $row['data03'];

		if($Data)		$Data .= '/';

		$Data .= $cYear.'-'.$cMonth.'-'.sprintf('%02d',$data03);
	}

	echo $Data;
?>