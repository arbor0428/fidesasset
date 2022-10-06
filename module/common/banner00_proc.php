<?
include "../class/class.DbCon.php";
include "../class/class.Msg.php";
include "../class/class.Util.php";
include "../class/class.FileUpload.php";
include "../class/class.gd.php";

$tot_num = '1';	//첨부파일 최대갯수
$UPLOAD_DIR = '../../upfile/';

$rDate = date('Y-m-d H:i:s');
$rTime = mktime();


if($type == 'write' || $type == 'edit'){


	include "../../module/file_filtering.php";

	$etxt = 'jpg, jpeg, gif, png 파일만 등록이 가능합니다.';
	$filelist = 'jpg|jpeg|gif|png';


	for($i=1; $i<=$tot_num; $i++){
		$file_num = sprintf("%02d",$i);
		$doc_name	= 'upfile'.$file_num;

		if($_FILES[$doc_name][name]){
			$temp_doc = $_FILES[$doc_name][name];
			file_strip_cut($temp_doc,$etxt,$filelist);

			//용량제한
			if($_FILES[$doc_name][size] > 5242880){
				Msg::backMsg("5MB이상의 파일은 등록할 수 없습니다");
				exit();
			}
		}
	}



	//파일관련처리
	for($i=1; $i<=$tot_num; $i++){
		$file_num = sprintf("%02d",$i);
		$doc_name	= 'upfile'.$file_num;
		$db_set_file = ${'dbfile'.$file_num};
		$db_real_file = ${'realfile'.$file_num};


		if($_FILES[$doc_name][name]){
			$temp_doc = $_FILES[$doc_name][name];

			//이미지의 경우 자동번호 부여
			$ext = FileUpload::getFileExtension($_FILES[$doc_name][name]);
			
			$fileUpload = new FileUpload($UPLOAD_DIR,$_FILES[$doc_name],"Ban");

			if($fileUpload->uploadFile()){
				$arr_new_file[$i] = $fileUpload->fileInfo[rename];
			}else{
				Msg::backMsg("파일을 다시 선택해 주십시오");
				exit();
			}

			if($db_set_file){
				unlink($UPLOAD_DIR."/".$db_set_file);
				if(is_file($UPLOAD_DIR."/thumb_".$db_set_file))	unlink($UPLOAD_DIR."/thumb_".$db_set_file);
			}


			##### 썸네일 생성관련 #####
			if(in_array($ext, array('jpg','jpeg','gif','png'))){
				$Thumb_size = $size01;

				$fsize = getimagesize($UPLOAD_DIR."/".$arr_new_file[$i]);
				if($fsize[0] > $Thumb_size){
					$file_path = $UPLOAD_DIR.'/';
					$Thumb_name = 'thumb_'.$arr_new_file[$i];
					$copy_file = copy($file_path.$arr_new_file[$i], $file_path.$Thumb_name);

					if(!$copy_file){
						echo ("file copy error");
					}else{
						//작은이미지
						$file = $file_path.$arr_new_file[$i];
						$saveDir = $file_path; // 저장할 경로
						$saveName = $Thumb_name; // 이미지명
						$sFactor = $Thumb_size; // 허용이미지 사이즈
						$s_img = imgThumbo($file, $saveName, $sFactor, $saveDir);

					}
				}
			}
			##########################

			$real_name[$i] = $temp_doc;


		}else{
			if($_POST["del_".$doc_name]=='Y'){
				unlink($UPLOAD_DIR."/".$db_set_file);
				if(is_file($UPLOAD_DIR."/thumb_".$db_set_file))	unlink($UPLOAD_DIR."/thumb_".$db_set_file);
				$arr_new_file[$i] = '';
				$real_name[$i] = '';

			}else{
				$arr_new_file[$i] = $db_set_file;
				$real_name[$i] = $db_real_file;
			}
		}
	}


	if($linkTxt)		$linkTxt = eregi_replace("http://", "", $linkTxt);

	if($type == 'write'){
		$sql = "insert into ks_banner (bno,upfile01,realfile01,linkTxt) values ";
		$sql .= "('$bno','$arr_new_file[1]','$real_name[1]','$linkTxt')";
		$result = mysql_query($sql);

		$msg = '등록되었습니다';
		$type = 'list';




	}elseif($type == 'edit'){
		$sql = "update ks_banner set ";			
		$sql .= "linkTxt='$linkTxt', ";
		$sql .= "upfile01='$arr_new_file[1]', ";
		$sql .= "realfile01='$real_name[1]' ";
		$sql .= "where bno=$bno";
		$result = mysql_query($sql);

		$msg = '수정되었습니다';
		$type = 'list';
		$uid = '';

	}





}elseif($type == 'del'){

		$sql = "select * from ks_product where uid=$uid";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$upfile01 = $row['upfile01'];
		$upfile02 = $row['upfile02'];
		$upfile03 = $row['upfile03'];
		$upfile04 = $row['upfile04'];
		$upfile05 = $row['upfile05'];
		$upfile06 = $row['upfile06'];
		$upfile07 = $row['upfile07'];

		for($i=1; $i<=$tot_num; $i++){
			$no = sprintf('%02',$i);

			$upfile = ${'upfile'.$no};
			if($upfile){
				unlink($UPLOAD_DIR."/".$upfile);
				if(is_file($UPLOAD_DIR."/thumb_".$upfile))	unlink($UPLOAD_DIR."/thumb_".$upfile);
			}
		}

		//상품삭제
		$sql = "delete from ks_product where uid='$uid'";
		$result = mysql_query($sql);

		$msg = '삭제되었습니다';

		$type = 'list';
		$uid = '';

}


Msg::goParent('/');
exit;

?>