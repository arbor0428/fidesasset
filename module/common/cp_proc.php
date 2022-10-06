<?
include $DOCUMENT_ROOT."module/class/class.DbCon.php";

$db = new DbCon();
$dbconn = $db->getConnection();

$sql = "select pwd,file_rename from tb_qna where idx=$idx";
$result = mysql_query($sql);
$db_pwd = mysql_result($result,0,0);
$db_file = mysql_result($result,0,1);

if($db_pwd==$pwd){
	switch($type){
		case 'edit' :
			$str = $next_url.'?type='.$type.'&idx='.$idx.'&record_start='.$record_start.'&field='.$field.'&word='.$word;
			echo ("<script language='javascript'>
						parent.opener.location.href = '$str';
						parent.window.close();
					   </script>");
			break;
		case 'del' :
			$UPLOAD_DIR = $DOCUMENT_ROOT.'upfile/board';
			if($db_file)	unlink($UPLOAD_DIR."/".$db_file);

			#### 댓글 삭제 ####
			$sql = "delete from tb_qna_re where up_idx=$idx";
			$result = mysql_query($sql);

			$sql = "delete from tb_qna where idx=$idx";
			$result = mysql_query($sql);
			$str = $next_url.'?type=list&record_start='.$record_start.'&field='.$field.'&word='.$word;

			echo ("<script language='javascript'>
						parent.opener.location.href = '$str';
						parent.window.close();
					   </script>");
			break;

	}
}else{
	echo ("<script language='javascript'>
				alert('비밀번호가 틀립니다');
			   </script>");
	exit;
}

unset($dbconn);
mysql_close();
?>