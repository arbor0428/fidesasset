<?
	include 'header.php';
	include './visit.php';

	include './ks_popset.php';
?>

	<div class="visual">
		<div class="slickslider">
			<div class="slickBox">
				<div class="slickImg"><!--이미지 배경--></div>
			</div>
			<div class="slickBox">
				<div class="slickImg"><!--이미지 배경--></div>
			</div>
		</div>
		<div class="visual_txt">
			<p>고객의 성공을 위해 늘 함께하는<br>
				따뜻한 동반자
			</p>
			<img src="/images/visual_txt.png" alt="">
		</div>
	</div>

	<script>
		$(document).ready(function(){

			AOS.init();

			//aos 반응형 효과 다르게 반영
			function AOS_MOBILE() {
			  if (matchMedia("screen and (max-width: 768px)").matches) {

				$('.about_btn').attr('data-aos', 'fade-up');
				$('.about_btn:nth-child(2)').attr('data-aos-delay','150');
				$('.about_btn:nth-child(3)').attr('data-aos-delay','200');
				$('.about_btn:nth-child(4)').attr('data-aos-delay','250');
			  }
			} // 768px 이하일 때 
			AOS_MOBILE();

			$('.slickslider').slick({ 
				infinite : true, 
				autoplay : true,			// 자동 스크롤 사용 여부
				autoplaySpeed : 3000, 		// 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
				arrows : false,
				dots:true,
				fade: true,
			});

		});
	</script>

	<section class="cont01">
		<div class="center">
			<p>주식회사 피데스에셋은 부동산 개발, 컨설팅 및 자산관리 서비스를 제공하고 있는<br>
			전문기업으로 고객만족을 최우선에 두고 최고의 서비스로 함께 하겠습니다.</p>
		</div>
	</section>

	<section class="cont02">
		<div class="center">
			<div class="cont_tit">
				<div class="tit_line"><!--line--></div>
				<h3>사업분야</h3>
			</div>
			<div class="threeBox_wrap" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="500">
				<div class="threeBox">
					<a href="/sub02/sub01.php">
						<div class="originBox">
							<div class="black_bg"><!--bg--></div>
							<p>부동산 개발</p>
						</div>
						<div class="hoverBox">
							<div class="hoverPlus"><span>+</span></div>
							<p>부동산 개발</p>
						</div>
					</a>
				</div>
				<div class="threeBox">
					<a href="/sub02/sub02.php">
						<div class="originBox">
							<div class="black_bg"><!--bg--></div>
							<p>부동산 컨설팅</p>
						</div>
						<div class="hoverBox">
							<div class="hoverPlus"><span>+</span></div>
							<p>부동산 컨설팅</p>
						</div>
					</a>
				</div>
				<div class="threeBox">
					<a href="/sub02/sub03.php">
						<div class="originBox">
							<div class="black_bg"><!--bg--></div>
							<p>자산관리(PM)</p>
						</div>
						<div class="hoverBox">
							<div class="hoverPlus"><span>+</span></div>
							<p>자산관리(PM)</p>
						</div>
					</a>
				</div>
			</div>
		</div>
		<p class="verticalBg">OUR BUSINESS</p>
	</section>

	<section class="cont03">
		<div class="center">
			<div class="cont_tit">
				<div class="tit_line"><!--line--></div>
				<h3>프로젝트</h3>
			</div>
			<div class="projectBox project01">
				<div class="wing"><img src="/images/wing01.png" alt=""></div>
				<div class="project_img project_img01"></div>
				<div class="project_txt">
					<div class="tit_top">스타벅스 경기광주송정DT</div>
					<div class="tit_bot">
						<p>2019년 1월 ~ 2021년 9월</p>
						<p>개발 및 운용</p>
					</div>
				</div>
			</div>
			<div class="projectBox project02">
				<div class="wing"><img src="/images/wing02.png" alt=""></div>
				<div class="project_img project_img02"></div>
				<div class="project_txt">
					<div class="tit_top">수유 오피스텔</div>
					<div class="tit_bot">
						<p>2021년 10월 ~ 현재(진행중)</p>
						<p>개발 및 PM</p>
					</div>
				</div>
			</div>
			<div class="m_projectBox" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="500">
				<div class="m_project">
					<div class="project_img project_img01"></div>
					<div class="project_txt">
						<div class="tit_top">스타벅스 경기광주송정DT</div>
						<div class="tit_bot">
							<p>2019년 1월 ~ 2021년 9월</p>
							<p>개발 및 운용</p>
						</div>
					</div>
				</div>
				<div class="m_project" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="500">
					<div class="project_img project_img02"></div>
					<div class="project_txt">
						<div class="tit_top">수유 오피스텔</div>
						<div class="tit_bot">
							<p>2021년 10월 ~ 현재(진행중)</p>
							<p>개발 및 PM</p>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix">
				<a class="viewmore" href="/sub03/sub01.php">viewmore</a>
			</div>
		</div>
		<p class="verticalBg">FIDES ASSET PROJECTS</p>
	</section>

	<script>
		   $(window).scroll(function(){
			let scrollTop = $(window).scrollTop();

			$(".cont02").each(function(index){
				let offset5 = (scrollTop - $(this).offset().top) * 0.3;

				$(this).find(".verticalBg").css({transform: "translateY("+ offset5 +"px) rotate(90deg)"});
			});

			$(".projectBox").each(function(index){
				let offset1 = (scrollTop - $(this).offset().top) * 0.08;
				let offset2 = (scrollTop - $(this).offset().top) * 0.05;
				let offset3 = (scrollTop - $(this).offset().top) * 0.01;

				$(this).find(".wing").css({transform: "translateY("+ offset1 +"px)"});
				$(this).find(".project_img01").css({transform: "translateX("+ offset2 +"px)"});
				$(this).find(".project_img02").css({transform: "translateX("+ -offset2 +"px)"});
				$(this).find(".project_txt").css({transform: "translateY("+ -offset3 +"px)"});
			});

			$(".cont03").each(function(index){
				let offset4 = (scrollTop - $(this).offset().top) * 0.5;

				$(this).find(".verticalBg").css({transform: "translateY("+ offset4 +"px) rotate(90deg)"});
			});

			if( scrollTop >= $(".cont02").offset().top - $(window).height()/2){
				$(".cont02 .tit_line").addClass("show");
			}; 
			if ( scrollTop >= $(".cont03").offset().top - $(window).height()/2){
				$(".cont03 .tit_line").addClass("show");
			};

		});

	</script>

<?
	include 'footer.php';
?>