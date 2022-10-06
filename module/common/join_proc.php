<?
	include '../login/head.php';
	include '../class/class.DbCon.php';
	include '../class/class.Msg.php';
	include "../class/class.FileUpload.php";
	include "../class/class.Util.php";
	include "../class/class.gd.php";


$UPLOAD_DIR = '../../upfile/';

$rDate = date('Y-m-d H:i:s');
$rTime = mktime();


$tot_num = '1';	//첨부파일 최대갯수

if($type == 'write' || $type == 'edit'){


	include "../file_filtering.php";

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
			
			$fileUpload = new FileUpload($UPLOAD_DIR,$_FILES[$doc_name],'P');

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
}



	if($type == 'write'){	

		//가입된 아이디 중복확인 및 관리자 아이디와 중복확인
		$sql = "select * from tb_member where userid='$userid'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		if($num){
			$msg = "사용할 수 없는 아이디입니다.";
			Msg::GblMsgBoxParent($msg);
			exit;
		}

		$mtype = 'M';
		$userip = $_SERVER[REMOTE_ADDR];
		$rDate = date('Y-m-d H:i:s');
		$rTime = mktime();

		$sql = "insert into tb_member (mtype, userid, pwd, name, email01, email02, emailChk,userip, rDate, rTime) values ";
		$sql .= "('$mtype','$userid','$pwd','$name','$email01','$email02','$emailChk','$userip','$rDate','$rTime')";
		$result = mysql_query($sql);

		Msg::goParent('/join_ok.php');
		exit;





	}elseif($type == 'edit'){
		$sql = "select * from tb_member where userid='$userid'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		if($num == 0){


		}else{
			$sql = "update tb_member set ";			

			$sql .= "upfile01='$arr_new_file[1]', ";
			$sql .= "realfile01='$real_name[1]', ";
			$sql .= "nickname='$nickname', ";
			$sql .= "name='$name', ";
			$sql .= "year='$year', ";
			$sql .= "sex='$sex', ";
			$sql .= "mobile='$mobile', ";
			$sql .= "zip='$zip', ";
			$sql .= "address01='$address01', ";
			$sql .= "address02='$address02', ";
			$sql .= "email01='$email01', ";
			$sql .= "email02='$email02', ";
			$sql .= "emailChk='$emailChk'";

			$sql .= "where userid='$userid'";
			$result = mysql_query($sql);
			$msg = '수정되었습니다';
			$next_url = '/';

			Msg::GblMsgBoxParent("수정되었습니다.","");

			if($Device == 'mobile'){
				Msg::goParent('/mobile');
			}else{
//				Msg::goParent('/');
			}
			exit;

		}

	}elseif($type == 'blog'){

		if(strpos($blog,"http://") === false && strpos($blog,"https://") === false  ){
			Msg::GblMsgBoxParentParent('정상적인 주소가 아닙니다.',"");
			exit;

		}elseif($blog=='http://blog.naver.com' && $blog=='http://blog.daum.net' && $blog=='http://www.tistory.com'){
			Msg::GblMsgBoxParentParent('해당 블로그를 찾을 수 없습니다.',"");
			exit;
			
		}elseif(strpos($blog,"blog") === false && strpos($blog,"tistory") === false && strpos($blog,"egloos") === false){
			Msg::GblMsgBoxParentParent('해당 블로그를 찾을 수 없습니다.',"");
			exit;
			
		}else{
			include_once('../../simple_html_dom.php');

			$html = @file_get_html($blog);

			if(!$html){
				Msg::GblMsgBoxParentParent('해당 블로그를 찾을 수 없습니다.',"");
				exit;
			}
		}


		$sql = "select * from tb_member where blog='$blog'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		if($num){
			Msg::GblMsgBoxParentParent('이미 사용중인 블로그입니다.',"");
			exit;
		}

		$sql = "select * from tb_member where userid='$userid'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		if($num == 0){


		}else{
			$sql = "update tb_member set ";			

			$sql .= "blog='$blog'";

			$sql .= "where userid='$userid'";
			$result = mysql_query($sql);
			$msg = '블로그가 등록되었습니다';
			$next_url = '/';

			Msg::GblMsgBoxParentParent("블로그가 등록되었습니다.","");
			 echo "<script language=\"javascript\">";
			 echo "	parent.location.reload();";
			 echo "</script>";

			if($Device == 'mobile'){
				Msg::goParent('/mobile');
			}else{
//				Msg::goParent('/');
			}
			exit;

		}

	}elseif($type == 'del'){


		$sql = "select * from tb_member where userid='$userid'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		if($num == 0){


		}else{
			$sql = "update tb_member set ";			

			$sql .= "blog=''";

			$sql .= "where userid='$userid'";
			$result = mysql_query($sql);
			$msg = '블로그가 삭제되었습니다';
			$next_url = '/';

			Msg::GblMsgBoxParentParent("블로그가 삭제되었습니다.","");


			 echo "<script language=\"javascript\">";
			 echo "	parent.location.reload();";
			 echo "</script>";

			if($Device == 'mobile'){
				Msg::goParent('/mobile');
			}else{
//				Msg::goParent('/');
			}
			exit;

		}

	}elseif($type == 'pwd'){

		if($new_pwd !== $new_pwd_re){
			Msg::GblMsgBoxParent("새 비밀번호를 확인해주세요.","location.href='/mypage/modify.php'");
			exit;
		}

		$sql = "select * from tb_member where userid='$userid' and pwd='$pwd'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		if($num == 0){
			Msg::GblMsgBoxParent("비밀번호가 틀립니다.","");
			exit;
		}else{


			$sql = "update tb_member set ";			

			$sql .= "pwd='$new_pwd'";

			$sql .= "where userid='$userid'";
			$result = mysql_query($sql);
			$msg = '비밀번호가 수정되었습니다';
			$next_url = '/';

			Msg::GblMsgBoxParent("비밀번호가 수정되었습니다.","location.href='/mypage/modify.php'");

			if($Device == 'mobile'){
				Msg::goParent('/mobile');
			}else{
//				Msg::goParent('/');
			}
			exit;

		}

	}
?>
<script language='javascript'>
	if('<?=$msg?>'){
		alert('<?=$msg?>');
	}

	document.frm.submit();
</script>
