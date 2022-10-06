<?
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";

if($type == 'all_del'){

	for($k=0; $k<count($chk); $k++){
		$sql01 = "select * from ks_point where uid=$chk[$k]";
		$result01 = mysql_query($sql01);
		$row01 = mysql_fetch_array($result01);

		$userid = $row01['userid'];
		$ptype = $row01['ptype'];
		$point = $row01['point'];

		//적립된 적립금을 차감한다
		if($ptype == 'O'){
			$sql02 = "update ks_userlist set point = point - $point where userid='$userid'";
			$result02 = mysql_query($sql02);

		//차감된 적립금을 적립한다
		}elseif($ptype == 'U'){
			$sql02 = "update ks_userlist set point = point + $point where userid='$userid'";
			$result02 = mysql_query($sql02);
		}


		$sql03 = "delete from ks_point where uid=$chk[$k]";
		$result03 = mysql_query($sql03);
	}

	$msg = '삭제되었습니다';

}


unset($dbconn);

Msg::goMsg($msg,'up_index.php?f_userid='.$f_userid.'&f_ptype='.$f_ptype.'&f_sy='.$f_sy.'&f_sm='.$f_sm.'&f_sd='.$f_sd.'&f_ey='.$f_ey.'&f_em='.$f_em.'&f_ed='.$f_ed);
?>
