<?
//글읽기 권한설정

if(!$read_chk)	$read_chk = '전체';



if($GBL_MTYPE == 'A' || $read_chk == '전체'){	 //관리자 또는 읽기권한이 전체인 경우라면 무조건...
	$chk_type = 'ok';

}else{


	if($read_chk == '관리자' || $GBL_MTYPE == ''){		//글읽기 권한이 전체가 아니면 비회원은 글읽기 권한이 없다.

		$chk_type = 'no';


	}else{
		if($GBL_MTYPE <= $read_chk){	 //로그인한 회원그룹레벨이 글쓰기 권한보다 작거나 같은 경우
			if($pwd_chk){	//비밀글일 경우
				if($GBL_USERID == $userid)	$chk_type = 'ok';
				else	$chk_type = 'no';

			}else{
				$chk_type = 'ok';

			}

		}else{
			$chk_type = 'no';

		}


	}



}



?>