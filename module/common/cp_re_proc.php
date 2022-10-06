<?
include $DOCUMENT_ROOT."module/class/class.DbCon.php";

$db = new DbCon();
$dbconn = $db->getConnection();

$sql = "select pwd from tb_qna_re where idx=$idx";
$result = mysql_query($sql);
$db_pwd = mysql_result($result,0,0);


if($db_pwd==$pwd){

	#### 댓글 삭제 ####
	$sql = "delete from tb_qna_re where idx=$idx";
	$result = mysql_query($sql);

	$str = $next_url.'?type=view&idx='.$up_idx.'&record_start='.$record_start.'&field='.$field.'&word='.$word;

	echo ("<script language='javascript'>
				parent.opener.location.href = '$str';
				parent.window.close();
			   </script>");

}else{
	echo ("<script language='javascript'>
				alert('비밀번호가 틀립니다');
			   </script>");
	exit;
}

unset($dbconn);
mysql_close();
?>