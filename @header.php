<?
	include "/home/fidesasset/www/module/login/head.php";
	include "/home/fidesasset/www/module/class/class.DbCon.php";
	include "/home/fidesasset/www/module/class/class.Util.php";
	include "/home/fidesasset/www/module/class/class.Msg.php";

	include '/home/fidesasset/www/module/Mobile-Detect-master/Mobile_Detect.php';

	$aosFadeUp='data-aos="fade-up" data-aos-duration="1000" data-aos-anchor-placement="top-bottom"';
	$aosFadeUp2='data-aos="fade-up" data-aos-duration="2000" data-aos-anchor-placement="top-bottom"';
	$aosFadeUp3='data-aos="fade-up" data-aos-duration="3000" data-aos-anchor-placement="top-bottom"';
	$aosFadeUp4='data-aos="fade-up" data-aos-duration="4000" data-aos-anchor-placement="top-bottom"';
	$aosFadeUp5='data-aos="fade-up" data-aos-duration="5000" data-aos-anchor-placement="top-bottom"';
	$aosFadeLeft='data-aos="fade-left" data-aos-duration="1000" data-aos-anchor-placement="top-bottom"';
	$aosFadeLeft2='data-aos="fade-left" data-aos-duration="2000" data-aos-anchor-placement="top-bottom"';
	$aosFadeLeft3='data-aos="fade-left" data-aos-duration="3000" data-aos-anchor-placement="top-bottom"';
	$aosFadeLeft4='data-aos="fade-left" data-aos-duration="4000" data-aos-anchor-placement="top-bottom"';
	$aosFadeLeft5='data-aos="fade-left" data-aos-duration="5000" data-aos-anchor-placement="top-bottom"';
	$aosFadeRight='data-aos="fade-right" data-aos-duration="1000" data-aos-anchor-placement="top-bottom"';
	$aosFadeRight2='data-aos="fade-right" data-aos-duration="2000" data-aos-anchor-placement="top-bottom"';
	$aosFadeRight3='data-aos="fade-right" data-aos-duration="3000" data-aos-anchor-placement="top-bottom"';
	$aosFadeRight4='data-aos="fade-right" data-aos-duration="4000" data-aos-anchor-placement="top-bottom"';
	$aosFadeRight5='data-aos="fade-right" data-aos-duration="5000" data-aos-anchor-placement="top-bottom"';
?>

<header class="header">
	<div class="h-center">
		<h1 class="logo"><a href="/"><img src="/images/logo.png" alt="logo"></a></h1>
		
		<button type="button" id="btnFullMenu" class="gnbbtn">
			메인메뉴 열기
			<span class="bar_top"></span>
			<span class="bar_mid"></span>
			<span class="bar_bot"></span>
		</button>

		<!--모바일메뉴버튼-->
		<button type="button" id="btnFullMenu" class="m-btn">
			메인메뉴 열기
			<span class="bar_top"></span>
			<span class="bar_mid"></span>
			<span class="bar_bot"></span>
		</button>
		
		<div class="gnb_wrap">
			<div id="gnb" class="gnb">
				<ul class="dep1">
					<li class="dep1_li">
						<a href="/sub01/sub01.php" class="dep1_link">회사소개</a>
						<ul class="dep2">
							<li class="dep2_li">
								<a href="/sub01/sub01.php" class="dep2_link">CEO 인사말</a>
							</li>
							<li class="dep2_li">
								<a href="/sub01/sub02.php" class="dep2_link">회사개요</a>
							</li>
							<li class="dep2_li">
								<a href="/sub01/sub03.php" class="dep2_link">회사연혁</a>
							</li>
							<li class="dep2_li">
								<a href="/sub01/sub04.php" class="dep2_link">찾아오시는 길</a>
							</li>
						</ul>
					</li>
					<li class="dep1_li">
						<a href="/sub02/sub01.php" class="dep1_link">제품정보</a>
						<ul class="dep2">
							<li class="dep2_li">
								<a href="/sub02/sub01.php?f_cade01=일반의약품" class="dep2_link">일반의약품</a>
							</li>
							<li class="dep2_li">
								<a href="/sub02/sub01.php?f_cade01=전문의약품" class="dep2_link">전문의약품</a>
							</li>
							<li class="dep2_li">
								<a href="/sub02/sub01.php?f_cade01=건강기능식품" class="dep2_link">건강기능식품</a>
							</li>
							<li class="dep2_li">
								<a href="/sub02/sub01.php?f_cade01=기타" class="dep2_link">기타</a>
							</li>
						</ul>
					</li>
					<li class="dep1_li">
						<a href="/sub03/sub01.php" class="dep1_link">홍보센터</a>
						<ul class="dep2">
							<li class="dep2_li">
								<a href="/sub03/sub01.php" class="dep2_link">제품소식</a>
							</li>
							<li class="dep2_li">
								<a href="/sub03/sub02.php" class="dep2_link">보도자료</a>
							</li>
							<li class="dep2_li">
								<a href="/sub03/sub03.php" class="dep2_link">공지사항</a>
							</li>
						</ul>
					</li>
					<li class="dep1_li">
						<a href="/sub04/sub01.php" class="dep1_link">채용</a>
						<ul class="dep2">
							<li class="dep2_li">
								<a href="/sub04/sub01.php" class="dep2_link">채용공고</a>
							</li>
						</ul>
					</li>
					<li class="dep1_li">
						<a href="/sub05/sub01.php" class="dep1_link">고객지원</a>
						<ul class="dep2">
							<li class="dep2_li">
								<a href="/sub05/sub01.php" class="dep2_link">고객상담안내</a>
							</li>
							<li class="dep2_li">
								<a href="/sub05/sub02.php" class="dep2_link">고객FAQ</a>
							</li>
						</ul>
					</li>
					<li class="dep1_li">
						<a href="/sub06/sub01.php" class="dep1_link">쇼핑몰</a>
						<ul class="dep2">
							<li class="dep2_li">
								<a href="/sub06/sub01.php" class="dep2_link">일반인</a>
							</li>
							<li class="dep2_li">
								<a href="/sub06/sub02.php" class="dep2_link">약사님</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		
		<div class="loginbox loginbox2" style='width:205px;position:absolute;top:0;left:50%;margin-left:420px;;'>
			<?
				if($GBL_MTYPE){
			?>
			<a href="/member/myinfo.php" class="link"><span class="lnr lnr-cog"></span> 정보수정</a>
			<a href="/module/login/logout_proc.php" class="link"><span class="lnr lnr-exit"></span> 로그아웃</a>

			<?
				}else{
			?>
			<a href="/member/login.php" class="link"><span class="lnr lnr-lock"></span> 로그인</a>
			<a href="/member/join.php" class="link"><span class="lnr lnr-user"></span> 회원가입</a>
			<?
				}
			?>
		</div>
	</div>

	<!--모바일메뉴-->
	<div class="m-navWrap">
		<div class="bBg"><!--뒷배경--></div>
		<div class="m-navbox">	
			<div class="mn-top">
				<div class="closeBtn">
					<a href="#" title="close">
						<span class="lnr lnr-cross"></span>
					</a>
				</div>
			</div>
			<ul class="m-nav">
				<li>
					<a href="/sub01/sub01.php" title="회사소개">회사소개</a>
					<span class="lnr lnr-chevron-down"></span>
					<span class="lnr lnr-chevron-up"></span>
					<ul class="m-depth2">
						<li class="dep2_li">
							<a href="/sub01/sub01.php" class="dep2_link">CEO 인사말</a>
						</li>
						<li class="dep2_li">
							<a href="/sub01/sub02.php" class="dep2_link">회사개요</a>
						</li>
						<li class="dep2_li">
							<a href="/sub01/sub03.php" class="dep2_link">회사연혁</a>
						</li>
						<li class="dep2_li">
							<a href="/sub01/sub04.php" class="dep2_link">찾아오시는 길</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="/sub02/sub01.php" title="제품정보">제품정보</a>
					<span class="lnr lnr-chevron-down"></span>
					<span class="lnr lnr-chevron-up"></span>
					<ul class="m-depth2">
						<li class="dep2_li">
							<a href="/sub02/sub01.php?f_cade01=일반의약품" class="dep2_link">일반의약품</a>
						</li>
						<li class="dep2_li">
							<a href="/sub02/sub01.php?f_cade01=전문의약품" class="dep2_link">전문의약품</a>
						</li>
						<li class="dep2_li">
							<a href="/sub02/sub01.php?f_cade01=건강기능식품" class="dep2_link">건강기능식품</a>
						</li>
						<li class="dep2_li">
							<a href="/sub02/sub01.php?f_cade01=기타" class="dep2_link">기타</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="/sub03/sub01.php" title="홍보센터">홍보센터</a>
					<span class="lnr lnr-chevron-down"></span>
					<span class="lnr lnr-chevron-up"></span>
					<ul class="m-depth2">
						<li class="dep2_li">
							<a href="/sub03/sub01.php" class="dep2_link">제품소식</a>
						</li>
						<li class="dep2_li">
							<a href="/sub03/sub02.php" class="dep2_link">보도자료</a>
						</li>
						<li class="dep2_li">
							<a href="/sub03/sub03.php" class="dep2_link">공지사항</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="/sub04/sub01.php" title="채용">채용</a>
					<span class="lnr lnr-chevron-down"></span>
					<span class="lnr lnr-chevron-up"></span>
					<ul class="m-depth2">
						<li class="dep2_li">
							<a href="/sub04/sub01.php" class="dep2_link">채용공고</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="/sub05/sub01.php" title="고객지원">고객지원</a>
					<span class="lnr lnr-chevron-down"></span>
					<span class="lnr lnr-chevron-up"></span>
					<ul class="m-depth2">
						<li class="dep2_li">
							<a href="/sub05/sub01.php" class="dep2_link">고객상담안내</a>
						</li>
						<li class="dep2_li">
							<a href="/sub05/sub02.php" class="dep2_link">고객FAQ</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="/sub06/sub01.php" title="쇼핑몰">쇼핑몰</a>
					<span class="lnr lnr-chevron-down"></span>
					<span class="lnr lnr-chevron-up"></span>
					<ul class="m-depth2">
						<li class="dep2_li">
							<a href="/sub06/sub01.php" class="dep2_link">일반인</a>
						</li>
						<li class="dep2_li">
							<a href="/sub06/sub02.php" class="dep2_link">약사님</a>
						</li>
					</ul>
				</li>
			</ul>
			<div class="loginbox">
				<?
					if($GBL_MTYPE){
				?>
				<a href="/orderlist/sub01.php" class="link">구매내역</a>
				<a href="/order/up_index.php" class="link">장바구니</a>
				<a href="/member/myinfo.php" class="link">정보수정</a>
				<a href="/module/login/logout_proc.php" class="link">로그아웃</a>
				<?
					}else{
				?>
				<a href="/member/login.php" class="link">로그인</a>
				<a href="/member/join.php" class="link">회원가입</a>
				<?
					}
				?>

			</div>
		</div>	
	</div>
</header>
<style>
.loginbox{margin:30px auto;}
.loginbox a{padding:2% 7%; border:1px solid #999; box-sizing:border-box; border-radius:20px;}
.loginbox2 a{ box-sizing:border-box;font-size:14px;}
.loginbox2 a:hover{background:#999999;color:#ffffff}
</style>
<script>
		$(document).ready(function(){
			//pc gnb depth2
			$(".gnb_wrap").on("mouseenter",function(event){

				event.preventDefault();

				$(".header").addClass("openFull");
			});

			$(".gnb_wrap").on("mouseleave",function(event){

				event.preventDefault();

				$(".header").removeClass("openFull");
			});

			var flag = true;
			$(".gnbbtn").click(function(event){

				event.preventDefault();
				if(flag){
					$(".header").addClass("openFull");

					flag= false;
				} else {
					$(".header").removeClass("openFull");

					flag= true;
				}
			});

		 //모바일 gnb depth2

			$(".m-btn").click(function(event){

				event.preventDefault();

				$(".m-navWrap").css({"width":"100%"});
				$(".bBg").stop().fadeIn();
				$(".m-navbox").stop().addClass("on");
			});

			$(".closeBtn").click(function(event){

				event.preventDefault();

				$(".bBg").stop().fadeOut();
				$(".m-navWrap").css({"width":"0"});
				$(".m-navbox").stop().removeClass("on");
				$(".m-depth2").stop().slideUp();
				$(".m-nav > li").removeClass("on");
			});

			$(".m-nav > li > a").on("click",function(event){

				event.preventDefault();
				
				$(this).parent().siblings().children(".m-depth2").stop().slideUp();

				$(this).siblings(".m-depth2").stop().slideToggle();

				$(this).parent().siblings().removeClass("on");
				$(this).parent().toggleClass("on");

			});
		});
</script>