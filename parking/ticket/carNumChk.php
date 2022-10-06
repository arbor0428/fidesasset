<?
	include '../../module/class/class.DbCon.php';

	$carNum = iconv("utf-8","euc-kr",$carNum);

	if($carNum){
		if($type == 'write'){
			$sTime = mktime(0,0,0,date('m'),date('d'),date('Y'));
			$eTime = mktime(23,59,59,date('m'),date('d'),date('Y'));

			//금일 동일한 차량이 등록되었는지 확인한다.
			$sql = "select * from ks_ticket where carNum='$carNum' and rTime>=$sTime and rTime<=$eTime";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);

			if($num)		echo "overlap1";
			else			echo "ok";

		}elseif($type == 'edit'){
			//등록된 면제권 정보
			$sql = "select * from ks_ticket where uid=$uid";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$rTime = $row['rTime'];

			$sTime = mktime(0,0,0,date('m',$rTime),date('d',$rTime),date('Y',$rTime));
			$eTime = mktime(23,59,59,date('m',$rTime),date('d',$rTime),date('Y',$rTime));

			//등록일에 동일한 차량이 등록되었는지 확인한다.
			$sql = "select * from ks_ticket where carNum='$carNum' and rTime>=$sTime and rTime<=$eTime and uid!=$uid";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);

			if($num)		echo "overlap2";
			else			echo "ok";
		}
	}
?>