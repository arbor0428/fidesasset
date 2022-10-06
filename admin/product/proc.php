<?
include '../../module/login/head.php';
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Util.php';
include '../../module/class/class.Msg.php';
include '../../module/class/class.FileUpload.php';
include '../../module/file_filtering.php';







if($type == 'write' || $type == 'edit'){
	

	//파일업로드
	include 'fileChk.php';


	//비고
	if($data04)	$data04 = Util::textareaEncodeing($data04);
	if($data05)	$data05 = Util::textareaEncodeing($data05);
	if($data06)	$data06 = Util::textareaEncodeing($data06);
	if($data07)	$data07 = Util::textareaEncodeing($data07);
	if($data08)	$data08 = Util::textareaEncodeing($data08);



	if($type == 'write'){

		$sql = "insert into ks_medicine (title,memo,cade01,cade02,data01,data02,data03,data04,data05,data06,data07,data08,upfile01,realfile01,upfile02,realfile02) values ";
		$sql .= "('$title','$memo','$cade01','$cade02','$data01','$data02','$data03','$data04','$data05','$data06','$data07','$data08','$arr_new_file[1]','$real_name[1]','$arr_new_file[2]','$real_name[2]')";
		$result = mysql_query($sql);

		Msg::GblMsgBoxParent("등록되었습니다.","location.href='up_index.php';");
		exit;



	}elseif($type == 'edit'){
		$editDate = date('Y-m-d H:i:s');
		$editTime = mktime();

		$sql = "update ks_medicine set ";
		$sql .= "title='$title', ";
		$sql .= "memo='$memo', ";
		$sql .= "cade01='$cade01', ";
		$sql .= "cade02='$cade02', ";
		$sql .= "data01='$data01', ";
		$sql .= "data02='$data02', ";
		$sql .= "data03='$data03', ";
		$sql .= "data04='$data04', ";
		$sql .= "data05='$data05', ";
		$sql .= "data06='$data06', ";
		$sql .= "data07='$data07', ";
		$sql .= "data07='$data07', ";
		$sql .= "data09='$data09' ";

		if($arr_new_file[1] || $del_upfile01=='Y'){
			$sql .= ", upfile01='$arr_new_file[1]' ";
			$sql .= ", realfile01='$real_name[1]' ";
		}
		if($arr_new_file[2] || $del_upfile01=='Y'){
			$sql .= ", upfile02='$arr_new_file[2]' ";
			$sql .= ", realfile02='$real_name[2]' ";
		}
		$sql .= " where uid=$uid";
		$result = mysql_query($sql);

		Msg::GblMsgBoxParent("수정되었습니다.","javascript:parent.reg_list();");
		exit;
	}



}elseif($type == 'del'){

	$sql = "delete from ks_medicine where uid='$uid'";
	$result = mysql_query($sql);

	Msg::goKorea('up_index.php');
	exit;

}
?>