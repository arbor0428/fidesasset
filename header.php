<?
	include "/home/fidesasset/www/module/login/head.php";
	include "/home/fidesasset/www/module/class/class.DbCon.php";
	include "/home/fidesasset/www/module/class/class.Util.php";
	include "/home/fidesasset/www/module/class/class.Msg.php";

	include '/home/fidesasset/www/module/Mobile-Detect-master/Mobile_Detect.php';

?>

<header class="header">
	<div class="h_center">
		<h1 class="logo"><a href="/" title="logo"><img src="/images/logo.png" alt="logo"></a></h1>
		<nav class="gnb">
			<ul class="dep1">
				<li>
					<div class="li_hover"></div>
					<a href="/sub01/sub01.php">회사소개</a>
					<ul class="dep2">
						<li><a href="/sub01/sub01.php" title="회사소개">회사소개</a></li>
						<li><a href="/sub01/sub02.php" title="오시는길">오시는길</a></li>
					</ul>
				</li>
				<li>
					<div class="li_hover"></div>
					<a href="/sub02/sub01.php">사업영역</a>
					<ul class="dep2">
						<li><a href="/sub02/sub01.php" title="부동산 개발">부동산 개발</a></li>
						<li><a href="/sub02/sub02.php" title="부동산 컨설팅">부동산 컨설팅</a></li>
						<li><a href="/sub02/sub03.php" title="자산관리(PM)">자산관리(PM)</a></li>
					</ul>
				</li>
				<li>
					<div class="li_hover"></div>
					<a href="/sub03/sub01.php">주요실적</a>
					<ul class="dep2">
						<li><a href="/sub03/sub01.php" title="프로젝트">프로젝트</a></li>
					</ul>
				</li>
				<li>
					<div class="li_hover"></div>
					<a href="/sub04/sub01.php">고객센터</a>
					<ul class="dep2">
						<li><a href="/sub04/sub01.php" title="공지사항">공지사항</a></li>
					</ul>
				</li>
			</ul>
		</nav>

		<!--모바일메뉴-->
		<div class="m-navWrap">
			<div class="bBg"><!--뒷배경--></div>
			<div class="m-navbox">	
				<ul class="m-nav">
					<li>
						<a href='javascript:void(0);'>회사소개</a>
						<span class="lnr lnr-chevron-down"></span>
						<span class="lnr lnr-chevron-up"></span>
						<ul class="m-depth2">
							<li class="dep2_li">
								<a href="/sub01/sub01.php" title="회사소개">회사소개</a>
							</li>
							<li class="dep2_li">
								<a href="/sub01/sub02.php" title="오시는길">오시는길</a>
							</li>
						</ul>
					</li>
					<li>
						<a href='javascript:void(0);'>사업영역</a>
						<span class="lnr lnr-chevron-down"></span>
						<span class="lnr lnr-chevron-up"></span>
						<ul class="m-depth2">
							<li class="dep2_li">
								<a href="/sub02/sub01.php" title="부동산 개발">부동산 개발</a>
							</li>
							<li class="dep2_li">
								<a href="/sub02/sub02.php" title="부동산 컨설팅">부동산 컨설팅</a>
							</li>
							<li class="dep2_li">
								<a href="/sub02/sub03.php" title="자산관리(PM)">자산관리(PM)</a>
							</li>
						</ul>
					</li>
					<li>
						<a href='javascript:void(0);'>주요실적</a>
						<span class="lnr lnr-chevron-down"></span>
						<span class="lnr lnr-chevron-up"></span>
						<ul class="m-depth2">
							<li class="dep2_li">
								<a href="/sub03/sub01.php" title="프로젝트">프로젝트</a>
							</li>
						</ul>
					</li>
					<li>
						<a href='javascript:void(0);'>고객센터</a>
						<span class="lnr lnr-chevron-down"></span>
						<span class="lnr lnr-chevron-up"></span>
						<ul class="m-depth2">
							<li class="dep2_li">
								<a href="/sub04/sub01.php" title="공지사항">공지사항</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>

		<!--모바일메뉴버튼-->
		<button type="button" id="btnFullMenu" class="m-btn">
			메인메뉴 열기
			<span class="bar_top"></span>
			<span class="bar_mid"></span>
			<span class="bar_bot"></span>
		</button>
	</div>
</header>

<script>
	//모바일
	var flag = true;
	$(".m-btn").click(function(event){

		event.preventDefault();
		if(flag){
			$("header").addClass("openFull");
			$(".m-navWrap").css({"width":"100%"});
			$(".bBg").stop().fadeIn();
			$(".m-navbox").stop().addClass("on");

			flag= false;
		} else {
			$("header").removeClass("openFull");
			$(".bBg").stop().fadeOut();
			$(".m-navWrap").css({"width":"0"});
			$(".m-navbox").stop().removeClass("on");
			$(".m-depth2").stop().slideUp();
			$(".m-nav > li").removeClass("on");

			flag= true;
		}
	});



	$(".m-nav > li > a").on("click",function(event){

		event.preventDefault();
		
		$(this).parent().siblings().children(".m-depth2").stop().slideUp();

		$(this).siblings(".m-depth2").stop().slideToggle();

		$(this).parent().siblings().removeClass("on");
		$(this).parent().toggleClass("on");

	});
</script>

