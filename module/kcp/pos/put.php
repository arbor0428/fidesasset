<?
	include '../../class/class.DbCon.php';

	$success = "false";




	//듭濡洹멸린濡
	$logFile = './log/'.date('Ymd').'.txt';

	$fp01 = fopen($logFile, "a");

	$data = file_get_contents('php://input');

	$json = json_decode($data,true);

	foreach($json as $k => $v){
		${$k} = iconv('utf-8','euc-kr',$v);
		$str .= $k.' : '.$v.chr(13);
	}

	$str = chr(13).'['.date('Ymd H:i:s').']'.chr(13).$str;
	fwrite($fp01, $str);


	//뱀몄쇱 媛
	$yy = substr($authdate,0,4);
	$mm = substr($authdate,4,2);
	$dd = substr($authdate,6,2);
	$hh = substr($authtime,0,2);
	$ii = substr($authtime,2,2);
	$ss = substr($authtime,4,2);
	$payTime = mktime($hh,$ii,$ss,$mm,$dd,$yy);


	//嫄곕뱀
	if($authflag == 'A'){
		$rDate = date('Y-m-d H:i:s');
		$rTime = mktime();

		$sql = "insert into kcp_pos (noticode,proccode,amt1,amt2,amt3,amt4,amt5,tsddate,tsdtime,posentry,cdno,mtrsno,termid,bid,taxno,istmmon,authno,authflag,authdate,authtime,hid,acqhid,cardflag,acctype,orgauthdate,orgauthno,termname,payTime,rDate,rTime,service) values ";
		$sql .= "('$noticode','$proccode','$amt1','$amt2','$amt3','$amt4','$amt5','$tsddate','$tsdtime','$posentry','$cdno','$mtrsno','$termid','$bid','$taxno','$istmmon','$authno','$authflag','$authdate','$authtime','$hid','$acqhid','$cardflag','$acctype','$orgauthdate','$orgauthno','$termname','$payTime','$rDate','$rTime','')";
		$result = mysql_query($sql);

		$success = "true";



	//嫄곕痍⑥ or 留痍⑥
	}elseif($authflag == 'C' || $authflag == 'N'){
		$sql = "select * from kcp_pos where mtrsno='$mtrsno'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		if($num){
			$row = mysql_fetch_array($result);
			$uid = $row['uid'];
			$cDate = date('Y-m-d H:i:s');
			$cTime = mktime();

			$sql = "update kcp_pos set ";
			$sql .= "cancel_noticode='$noticode', ";
			$sql .= "cancel_proccode='$proccode', ";
			$sql .= "cancel_amt1='$amt1', ";
			$sql .= "cancel_amt2='$amt2', ";
			$sql .= "cancel_amt3='$amt3', ";
			$sql .= "cancel_amt4='$amt4', ";
			$sql .= "cancel_amt5='$amt5', ";
			$sql .= "cancel_tsddate='$tsddate', ";
			$sql .= "cancel_tsdtime='$tsdtime', ";
			$sql .= "cancel_posentry='$posentry', ";
			$sql .= "cancel_cdno='$cdno', ";
			$sql .= "cancel_mtrsno='$mtrsno', ";
			$sql .= "cancel_termid='$termid', ";
			$sql .= "cancel_bid='$bid', ";
			$sql .= "cancel_taxno='$taxno', ";
			$sql .= "cancel_istmmon='$istmmon', ";
			$sql .= "cancel_authno='$authno', ";
			$sql .= "cancel_authflag='$authflag', ";
			$sql .= "cancel_authdate='$authdate', ";
			$sql .= "cancel_authtime='$authtime', ";
			$sql .= "cancel_hid='$hid', ";
			$sql .= "cancel_acqhid='$acqhid', ";
			$sql .= "cancel_cardflag='$cardflag', ";
			$sql .= "cancel_acctype='$acctype', ";
			$sql .= "cancel_orgauthdate='$orgauthdate', ";
			$sql .= "cancel_orgauthno='$orgauthno', ";
			$sql .= "cancel_termname='$termname', ";
			$sql .= "cDate='$cDate', ";
			$sql .= "cTime='$cTime', ";
			$sql .= "reTime='$payTime' ";
			$sql .= " where uid=$uid";
			$result = mysql_query($sql);

			$success = "true";


		//嫄곕 蹂닿  寃쎌.
		}else{
			$rDate = date('Y-m-d H:i:s');
			$rTime = mktime();

			$sql = "insert into kcp_pos_tmp (noticode,proccode,amt1,amt2,amt3,amt4,amt5,tsddate,tsdtime,posentry,cdno,mtrsno,termid,bid,taxno,istmmon,authno,authflag,authdate,authtime,hid,acqhid,cardflag,acctype,orgauthdate,orgauthno,termname,payTime,rDate,rTime,service) values ";
			$sql .= "('$noticode','$proccode','$amt1','$amt2','$amt3','$amt4','$amt5','$tsddate','$tsdtime','$posentry','$cdno','$mtrsno','$termid','$bid','$taxno','$istmmon','$authno','$authflag','$authdate','$authtime','$hid','$acqhid','$cardflag','$acctype','$orgauthdate','$orgauthno','$termname','$payTime','$rDate','$rTime','')";
			$result = mysql_query($sql);

			$success = "true";
		}
	}


	echo $success;
?>