<?
	include '../class/class.DbCon.php';

	if($userid == 'admin'){
		$record_cnt = '100';

	}else{
		//내부직원 아이디정보
		$sql = "select count(*) from tb_member where userid='$userid'";
		$result = mysql_query($sql);
		$record_cnt = mysql_result($result,0,0);

		//이용자 아이디정보
		if($record_cnt == 0){
			$sql = "select count(*) from ks_userlist where userid='$userid'";
			$result = mysql_query($sql);
			$record_cnt = mysql_result($result,0,0);
		}
	}

	echo $record_cnt;
?>