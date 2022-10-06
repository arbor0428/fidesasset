<?


/*-
	if($_SERVER['REMOTE_ADDR'] != '106.246.92.237'){
		echo'준비중';
		exit;
	}
*/
	session_cache_limiter('');
	session_start();

	//글로벌 변수 설정
	$GBL_USERID	= $_SESSION['ses_member_id'];
	$GBL_NAME	= $_SESSION['ses_member_name'];
	$GBL_MTYPE = $_SESSION['ses_member_type'];
	$GBL_PASSWORD = $_SESSION['ses_member_pwd'];
	$GBL_USERTYPE = $_SESSION['ses_member_userType'];

	$SYSTEM_DATE = date('Y-m-d');

	$strRoot = '../';
	$boardRoot = '../board/';
	$path='';
	$ico01 = "<span class='eq'></span>";

?>
<!doctype html>
	<html lang="en">
	<head>

		<title>피데스에셋</title>

		<?
			include "/home/fidesasset/www/module/login/metaTag.php";
		?>
		<!-- css -->
		<link rel="stylesheet" href="/css/style.css?v=9">
		<link rel="stylesheet" href="/css/sub.css?v=9">
		<link rel="stylesheet" href="/css/common.css">
		<link rel="stylesheet" href="/css/button.css">
		<link rel="stylesheet" href="/css/member.css">

		<!-- 다음지도스크립트 -->
		<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://spi.maps.daum.net/imap/map_js_init/roughmapLoader.js"></script>

<!-- 		본고딕
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500;700&display=swap" rel="stylesheet"> -->

		<!--Playfair Display-->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
		
		<!-- aos animation -->
		<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
		<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


		<link type='text/css' rel='stylesheet' href='/module/popupoverlay/style.css'>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="/css/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="/css/rollingbanner.js"></script>

		<link rel="stylesheet" href="/css/jquery.bxslider.css">
		<script type="text/javascript" src="/js/jquery.bxslider.js"></script>

		<script language='javascript' src='/module/js/common.js'></script>
		<script type="text/javascript" src="/module/popupoverlay/jquery.popupoverlay.js"></script>
		<link type='text/css' rel='stylesheet' href='/module/js/placeholder.css'><!-- 웹킷브라우져용 -->
		<script src="/module/js/jquery.placeholder.js"></script><!-- placeholder 태그처리용 -->

		<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

		<!-- font awesome -->
		  <link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"
		  />

		<!-- slick 불러오기 -->
		<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
		<!--<script src="/js/slick.min.js"></script>-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

         <script src="/js/script.js"></script>

	</head>

	<body>