<?
	if($_SERVER['SERVER_PORT'] == '443'){
		$siteLogo = "https://".$_SERVER['HTTP_HOST']."/images/sns.png";
		$siteShortcut = "https://".$_SERVER['HTTP_HOST']."/images/shortcut.png";
	}else{
		$siteLogo = "http://".$_SERVER['HTTP_HOST']."/images/sns.png";
		$siteShortcut = "http://".$_SERVER['HTTP_HOST']."/images/shortcut.png";
	}
?>

<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- 뷰포트 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="/favi.ico"> <!-- 파비콘 -->


<meta name="Keywords" content="포천시,포천문화재단,문화재단">
<meta name="description" content="문화와 예술이 숨쉬는곳, 포천문화재단">
<meta property="og:description" content="문화와 예술이 숨쉬는곳, 포천문화재단">
<meta name="naver-site-verification" content="8cb485bc46febee6b3803000b77b1357fd113bcb" />
<meta name="google-site-verification" content="uXqioppgv0FAEnQ0yRvE6IEa8mh_CNc7ETnSNuma_0Y" />
<meta property="og:title" content="포천문화재단">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">

<link rel="image_src" href="/images/sns.png" />
<meta property="og:url" content="http://pcfac.or.kr/">
<meta property="og:image" content="/images/sns.png">
<meta name="robots" content="index,follow">
<meta name="robots" content="index">

<meta property="og:image" content="<?=$siteLogo?>">


<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="포천문화재단">
<link rel="apple-touch-icon-precomposed" href="<?=$siteShortcut?>">

<meta name="format-detection" content="telephone=no" /> <!-- 사파리전화번호링크해제 -->