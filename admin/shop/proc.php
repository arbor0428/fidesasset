<?
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";
include '../../module/class/class.Util.php';
include "../../module/class/class.FileUpload.php";
include "../../module/class/class.gd.php";

$tot_num = '4';	//첨부파일 최대갯수

$UPLOAD_DIR = "../../upfile/shop";



$reg_date = mktime();


switch($type){
	case 'write' :
	case 'edit' :

		if($cade01 == '남성한복')	$inven = 9999;


		//파일관련처리

		for($i=1; $i<=$tot_num; $i++){
			$file_num = sprintf("%02d",$i);
			$doc_name	= 'upfile'.$file_num;
			$db_set_file = ${'dbfile'.$file_num};


			if($_FILES[$doc_name][name]){
				//이미지의 경우 자동번호 부여
				$ext = FileUpload::getFileExtension($_FILES[$doc_name][name]);
				if(in_array($ext, array('jpg','jpeg','gif','bmp')))
					$fileUpload = new FileUpload($UPLOAD_DIR,$_FILES[$doc_name],'P');
				else 
					$fileUpload = new FileUpload($UPLOAD_DIR,$_FILES[$doc_name]);

				if($db_set_file){
					unlink($UPLOAD_DIR."/".$db_set_file);
					if(is_file($UPLOAD_DIR."/thumb_".$db_set_file))	 unlink($UPLOAD_DIR."/thumb_".$db_set_file);
				}

				if($fileUpload->uploadFile()){
					$arr_new_file[$i] = $fileUpload->fileInfo[rename];
				}else{
					Msg::backMsg("파일을 다시 선택해 주십시오");
					exit();
				}

				##### 썸네일 생성관련 #####
				if(in_array($ext, array('jpg','jpeg','gif','bmp'))){
					if($i == 1)	$Thumb_size = $size01;
					else			$Thumb_size = 1150;

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


			}else{
				if($_POST["del_".$doc_name]=='Y'){
					unlink($UPLOAD_DIR."/".$db_set_file);
					if(is_file($UPLOAD_DIR."/thumb_".$db_set_file))	 unlink($UPLOAD_DIR."/thumb_".$db_set_file);
					$arr_new_file[$i] = '';

				}else{
					$arr_new_file[$i] = $db_set_file;
				}
			}
		}



		if($title){
			$title = eregi_replace("\|", "&#124;", $title);
			$title = eregi_replace("<", "&lt;", $title);
			$title = eregi_replace(">", "&gt;", $title);
			$title = eregi_replace("\"", "&quot;", $title);
		}

		//비고
		if($data04)	$data04 = Util::textareaEncodeing($data04);
		if($data05)	$data05 = Util::textareaEncodeing($data05);
		if($data06)	$data06 = Util::textareaEncodeing($data06);
		if($data07)	$data07 = Util::textareaEncodeing($data07);
		if($data08)	$data08 = Util::textareaEncodeing($data08);

		//선택한 아이콘설정
		$icon = '';
		for($i=0; $i<count($ico); $i++){
			if($icon)	 $icon .= ',';
			$icon .= $ico[$i];
		}
	

		if($type=='write'){
			$sql = "select max(msort) from ks_product where cade01='$cade01'";
			$result = mysql_query($sql);
			$max = mysql_result($result,0,0);
			$msort = $max + 1;

			$sql = "insert into ks_product  (cade01,cade02,msort,userid,esort01,esort02,esort03,esort04,title,icon,oprice,price,fix_price,baeja,slide,main,enable,upfile01,upfile02,upfile03,upfile04,ment,reg_date,etc_opt01,etc_opt02,etc_opt03,etc_opt04,inven,inven_44,inven_55,inven_66,inven_77,inven_88,inven_b1,inven_b2,inven_a1,acclist,manlist,vestlist,data04,data05,data06,data07,data08,data09) values ";
			$sql .= "('$cade01','$cade02','$msort','$userid','$esort01','$esort02','$esort03','$esort04','$title','$icon','$oprice','$price','$fix_price','$baeja','$slide','$main','$enable','$arr_new_file[1]','$arr_new_file[2]','$arr_new_file[3]','$arr_new_file[4]','$ment','$reg_date','$etc_opt01','$etc_opt02','$etc_opt03','$etc_opt04','$inven','$inven_44','$inven_55','$inven_66','$inven_77','$inven_88','$inven_b1','$inven_b2','$inven_a1','$acclist','$manlist','$vestlist','$data04','$data05','$data06','$data07','$data08','$data09')";
			$result = mysql_query($sql);
			$msg = '등록되었습니다';


		}else{
			

			$sql = "update ks_product set ";
			$sql .= "userid='$userid', ";
			$sql .= "cade02='$cade02', ";
			$sql .= "esort01='$esort01', ";
			$sql .= "esort02='$esort02', ";
			$sql .= "esort03='$esort03', ";
			$sql .= "esort04='$esort04', ";
			$sql .= "etc_opt01='$etc_opt01', ";
			$sql .= "etc_opt02='$etc_opt02', ";
			$sql .= "etc_opt03='$etc_opt03', ";
			$sql .= "etc_opt04='$etc_opt04', ";
			$sql .= "data04='$data04', ";
			$sql .= "data05='$data05', ";
			$sql .= "data06='$data06', ";
			$sql .= "data07='$data07', ";
			$sql .= "data08='$data08', ";
			$sql .= "data09='$data09', ";
			$sql .= "title='$title', ";
			$sql .= "icon='$icon', ";
			$sql .= "oprice='$oprice', ";
			$sql .= "price='$price', ";
			$sql .= "fix_price='$fix_price', ";			
			$sql .= "baeja='$baeja', ";
			$sql .= "slide='$slide', ";
			$sql .= "main='$main', ";
			$sql .= "enable='$enable', ";
			$sql .= "upfile01='$arr_new_file[1]', ";
			$sql .= "ment='$ment', ";
			$sql .= "inven='$inven', ";
			$sql .= "inven_44='$inven_44', ";
			$sql .= "inven_55='$inven_55', ";
			$sql .= "inven_66='$inven_66', ";
			$sql .= "inven_77='$inven_77', ";
			$sql .= "inven_88='$inven_88', ";
			$sql .= "inven_b1='$inven_b1', ";
			$sql .= "inven_b2='$inven_b2', ";
			$sql .= "inven_a1='$inven_a1', ";			
			$sql .= "acclist='$acclist', ";
			$sql .= "manlist='$manlist', ";
			$sql .= "vestlist='$vestlist' ";

			$sql .= " where uid=$uid";
			$result = mysql_query($sql);

			$msg = '수정되었습니다';


			//카테고리별 상세페이지 공통이미지 일괄적용
			$sql = "update ks_product set upfile02='$arr_new_file[2]',upfile03='$arr_new_file[3]',upfile04='$arr_new_file[4]' where cade01='$cade01'";
			$result = mysql_query($sql);
			
		}


		break;




	case 'del' :

		$sql = "select * from ks_product where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$del_file01 = $row['upfile01'];

		if($del_file01){
			unlink($UPLOAD_DIR."/".$del_file01);
			if(is_file($UPLOAD_DIR."/thumb_".$del_file01))	unlink($UPLOAD_DIR."/thumb_".$del_file01);
		}




		$sql = "delete from ks_product where uid=$uid";
		$result = mysql_query($sql);

		$msg = '삭제되었습니다';

		break;



	case 'all_del' :

		for($k=0; $k<count($chk); $k++){
			$sql = "select * from ks_product where uid='$chk[$k]'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);

			$del_file01 = $row['upfile01'];

			if($del_file01){	
				unlink($UPLOAD_DIR."/".$del_file01);
				if(is_file($UPLOAD_DIR."/thumb_".$del_file01))	unlink($UPLOAD_DIR."/thumb_".$del_file01);
			}

			$sql = "delete from ks_product where uid=$chk[$k]";
			$result = mysql_query($sql);


		}

		$msg = '삭제되었습니다';
		break;

}





//출력순서저장
if($cade01){
	$sql01 = "select * from ks_product where cade01='$cade01' order by msort desc, uid desc";
	$result01 = mysql_query($sql01);
	$num01 = mysql_num_rows($result01);

	for($i=0; $i<$num01; $i++){
		$no = $num01 - $i;
		$row01 = mysql_fetch_array($result01);
		$set_uid = $row01['uid'];

		$sql02 = "update ks_product set msort=$no where uid='$set_uid'";
		$result02 = mysql_query($sql02);
	}
}


unset($objProc);
unset($dbconn);


?>

<form name='frm' method='post' action='<?=$next_url?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='f_c02a' value='<?=$f_c02a?>'>
<input type='hidden' name='f_c02b' value='<?=$f_c02b?>'>
<input type='hidden' name='f_c02c' value='<?=$f_c02c?>'>
<input type='hidden' name='f_c02d' value='<?=$f_c02d?>'>
<input type='hidden' name='f_title' value='<?=$f_title?>'>
<input type='hidden' name='f_enable01' value='<?=$f_enable01?>'>
<input type='hidden' name='f_enable02' value='<?=$f_enable02?>'>
<input type='hidden' name='cade01' value='<?=$cade01?>'>
</form>

<script language='javascript'>
alert('<?=$msg?>');
document.frm.submit();
</script>