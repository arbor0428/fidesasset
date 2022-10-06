<?
	include '../login/head.php';
	include '../class/class.DbCon.php';
	include '../class/class.Util.php';
	include '../class/class.Msg.php';

	$emailTxt = explode('@',$f_email);

	$sql = "select * from tb_member where name='$f_name' and email01='$emailTxt[0]' and email02='$emailTxt[1]'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num == 0){
		//부모창 레이어닫기
		Msg::GblMsgBoxCloseParent('findidpw_close');
		$msg = "일치하는 회원정보가 없습니다.";
		Msg::GblMsgBoxParent($msg);
		exit;


	//사용자 메일발송
	}else{
		$row = mysql_fetch_array($result);

		$userid = $row['userid'];
		$name = $row['name'];

		//비밀번호 초기화
		$pwd = Util::MakeRandomNumber();

		$sql = "update tb_member set pwd='$pwd' where userid='$userid'";
		$result = mysql_query($sql);





		//실제전송파일
		$file_name = 'idpwd_mail.html';

		if($buffer = file_exists($file_name)){

			$sMessage = '';

			$fp = fopen($file_name, "r");

			if ($fp != NULL) {
				while(!feof($fp)){
					$sMessage .=  fread($fp,100);
				}
			}

			//발신자
			$from_email = 'iwebzone@naver.com';
			$from_name = '블로블로';

			//수신자
			$to_email = $f_email;
			$to_name = $name;

			//메일제목
			$subject = "고객님의 아이디/비밀번호입니다.";
			

			$sMessage = str_replace("#userid", $userid, $sMessage);
			$sMessage = str_replace("#name", $name, $sMessage);
			$sMessage = str_replace("#pwd", $pwd, $sMessage);


			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=utf-8\r\n";
		//	$headers .= "To: ".$to_name." <".$to_email.">\r\n";
			$headers .= "From: ".$from_name." <".$from_email.">\r\n";

			mail($to_email, $subject, $sMessage, $headers);
		}

		//부모창 레이어닫기
		Msg::GblMsgBoxCloseParent('findidpw_close');
		$msg = "고객님의 메일로 로그인 정보를 보내드렸습니다.";
		Msg::GblMsgBoxParent($msg);
		exit;





	}
?>
