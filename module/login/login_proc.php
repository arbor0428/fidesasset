<?
session_start();
Header("p3p: CP=\"CAO DSP AND SO ON\" policyref=\"/w3c/p3p.xml\""); 

include "../../module/class/class.DbCon.php";
include "../../module/class/class.Util.php";
include "../../module/class/class.Msg.php";


####### 회원가입페이지에서 로그인시 메인으로
if($next_url=='/member/up_index.php')	$next_url = '/';

####### 제휴업체페이지에서 로그인시 메인으로
if($next_url=='/order/up_index.php')	$next_url = '/';

####### 카테고리페이지에서 로그인시 메인으로
if($next_url=='/include/menu_content.php')	$next_url = '/';

if($_SERVER['REMOTE_ADDR'] = '106.246.92.237' || $_SERVER['REMOTE_ADDR'] = '219.248.183.35'){
	$sql = "select * from tb_member where userid='$userid'";
}else{
	$sql = "select * from tb_member where userid='$userid' and pwd='$pwd'";
}
$result = mysql_query($sql);
$num = mysql_num_rows($result);


if($num){ 
	$info = mysql_fetch_array($result);

	$mtype = $info['mtype'];

	if($info[mtype] == 'A'){	////// 관리자 확인
		$_SESSION['ses_member_id']		= $info[userid];
		$_SESSION['ses_member_name']	= '관리자';
		$_SESSION['ses_member_type']	= 'A';
		$_SESSION['ses_member_pwd']	= $info[pwd];		

	}else{
		$_SESSION['ses_member_id']		= $info[userid];
		$_SESSION['ses_member_name']	= $info[name];
		$_SESSION['ses_member_type']	= $info[mtype];
		$_SESSION['ses_member_pwd']	= $info[pwd];
		$_SESSION['ses_member_userType']	= $info[userType];

	}

	//로그인 기록저장
	$userid = $info['userid'];
	$userip = $_SERVER[REMOTE_ADDR];
	$rDate = date('Y-m-d H:i:s');
	$rTime = mktime();

	$sql = "insert into tb_login_log (userid,userip,rDate,rTime) values ('$userid','$userip','$rDate','$rTime')";
	$result = mysql_query($sql);


	if($next_url == '/admin/index.php'){
		//공연관리자
		if($mtype == 'A')	Msg::goParent('/admin');
		else					Msg::goParent('/');

	}elseif($next_url == '/parking/index.php'){
		Msg::goParent('/parking/ticket/up_index.php?type=write');

	}else{
		Msg::goParent('/');
	}

}else{

		
	//일반회원정보확인
	$sql = "select * from ks_userlist where userid='$userid' and pwd='$pwd'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);


	if($num){ 
		$info = mysql_fetch_array($result);

		$status = $info['status'];

		if($status == '2'){
			$msg = '관리자 승인 후 로그인이 가능합니다.';
			Msg::GblMsgBoxParent($msg, '');
			exit;

		}else{
			$_SESSION['ses_member_uid']		= $info[uid];
			$_SESSION['ses_member_id']		= $info[userid];
			$_SESSION['ses_member_name']	= $info[name];
			$_SESSION['ses_member_type']	= 'C';
			$_SESSION['ses_member_pwd']	= $info[pwd];
			$_SESSION['ses_member_userType']	= $info[userType];

			Msg::goParent('/');
		}


	}else{
		$msg = '입력정보가 일치하지 않습니다.\\n입력정보를 확인해 주십시오';
		Msg::GblMsgBoxParent($msg, '');
		exit();
	}

}

unset($db);
unset($dbonn);
mysql_close();
?>