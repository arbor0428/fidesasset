<?
	include './class/class.DbCon.php';
	include './class/class.Util.php';

	$f_userid = $_POST['f_userid'];
	$f_name = iconv('utf-8','euc-kr',$_POST['f_name']);
	$f_email = iconv('utf-8','euc-kr',$_POST['f_email']);
	$emailArr = explode('@',$f_email);
	$f_email01 = $emailArr[0];
	$f_email02 = $emailArr[1];

	$sql = "select * from ks_userlist where userid='$f_userid' and email01='$f_email01' and email02='$f_email02'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num){
		$row = mysql_fetch_array($result);
		$apwd = $row['pwd'];

		//비밀번호 초기화
		$pwd = Util::rePassWord();
		$sql = "update ks_userlist set pwd='$pwd' where userid='$f_userid'";
		$result = mysql_query($sql);

		//비밀번호 변경로그
		$userip = $_SERVER[REMOTE_ADDR];
		$rDate = date('Y-m-d H:i:s');
		$rTime = mktime();
		$sql = "insert into ks_pass_log (userid,apwd,pwd,email,userip,rDate,rTime) values ('$f_userid','$apwd','$pwd','$f_email','$userip','$rDate','$rTime')";
		$result = mysql_query($sql);

		//메일발송
		include 'passEmail.php';

		echo 'ok';

	}else{
		echo '';
	}
?>