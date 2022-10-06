<?
include '../../module/login/head.php';
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Util.php';
include '../../module/class/class.Msg.php';
include '../../module/class/class.FileUpload.php';
include '../../module/file_filtering.php';

if($type == 'edit'){
	//파일업로드
	include 'fileChk2.php';

	$sql = "update ks_brochure set ";
	
	$sql .= "upfile01='$arr_new_file[1]',";
	$sql .= "realfile01='$real_name[1]',";
	$sql .= "upfile02='$arr_new_file[2]',";
	$sql .= "realfile02='$real_name[2]' ";

	$sql .= " where uid=$uid";

	$result = mysql_query($sql);

	Msg::GblMsgBoxParent("수정되었습니다.","location.href='$next_url';");
	exit;

}
?>