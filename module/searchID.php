<?
	include './class/class.DbCon.php';
	include './class/class.Util.php';

	$f_name = iconv('utf-8','euc-kr',$_POST['f_name']);
	$f_email = iconv('utf-8','euc-kr',$_POST['f_email']);
	$emailArr = explode('@',$f_email);
	$f_email01 = $emailArr[0];
	$f_email02 = $emailArr[1];

	$sql = "select * from ks_userlist where name='$f_name' and email01='$f_email01' and email02='$f_email02'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num){
		$row = mysql_fetch_array($result);
		$userid = Util::NameCutStr($row['userid'],2,'*');

		echo $userid;

	}else{
		echo '';
	}
?>