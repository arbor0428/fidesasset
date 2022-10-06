<?
	session_cache_limiter('');
	session_start();
	Header("p3p: CP=\"CAO DSP AND SO ON\" policyref=\"/w3c/p3p.xml\"");

	//글로벌 변수 설정
	$GBL_USERID	= strtolower($_SESSION['ses_member_id']);
	$GBL_NAME	= strtolower($_SESSION['ses_member_name']);
	$GBL_MTYPE = $_SESSION['ses_member_type'];


	if($GBL_MTYPE){
		include 'main.php';
	}else{
		include 'login.php';
	}
?>