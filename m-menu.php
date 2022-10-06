
<style>
.menuwrap-top {width:100%; height:60px; background:#454848;}

.btn-close-mo {
	display:none;
	position: absolute;
	top: 3%;
	right: 7%;
	z-index: 9999;
	width: 20px;
	height: 20px;
	color:#fff;
	border: 0;
	background:url("/images/closeBtn.png")no-repeat; 
	background-size:cover;
}

.menuwrap {
	position: fixed;
	top: 0;
	right: -220px; /* 너비 300px 인 사이드바를 왼쪽으로 300px 이동시켜 화면에 보이지 않게 함 */
	z-index: 9998;
	overflow: auto;
	width: 220px; /* 너비 */
	height: 100%;
	box-sizing: border-box;
	transition: right .3s ease-in-out; /* 0.3초 동안 이동 애니메이션 */
	background-color: #fff;
}
.menuwrap.on {right: 0;}

#dimmed {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: rgba(0,0,0,0.5);
	z-index:9997;
	overflow-y:hidden;
}

.category_list {padding-left:0;}
.category_list > li {padding:0 20px; text-align: left; font-size:14px;}
.category_list li a {display:inline-block; width:100%;}

.link_sub_item {
	color:#333;
	display:inline-block; 
	width:100%;
	padding:15px 0;
	border-bottom:1px dotted #d7d7d7;'
}

.sub_category {display:none; padding-left:0; background:#f1f1f1 !important;}
.sub_category li {color:#333;}

.sub_category li a {display:inline-block; width:100%; padding:7px; font-size:13px; letter-spacing:-0.5px;}
.menu-arr {float:right; margin-right:8px;}

/*스크롤방지 css*/
.not_scroll {overflow-y:hidden;}

/* 로그인회원가입 */
.loginbox{margin:30px auto;}
.loginbox a{padding:2% 6%; border:1px solid #999; box-sizing:border-box; border-radius:20px;}
</style>


<!--메뉴버튼-->

<div class="menuwrap">
	<div class="menuwrap-top">
		<button type="button" class="btn-close-mo"></button>
	</div>

	<nav id="menu">
		<!-- "메뉴목록 표시" -->
		<ul class="category_list">
			<li>
				<a class="link_sub_item">재단소개<span class="menu-arr">＋</span></a>
				<ul class="sub_category">
					<li><a href="/sub01/sub01.php">&middot; 이사장 인사말</a></li>
					<li><a href="/sub01/sub02.php">&middot; 비전·미션</a></li>
					<li><a href="/sub01/sub03.php">&middot; CI소개</a></li>
					<li><a href="/sub01/sub04.php">&middot; 연혁</a></li>
					<li><a href="/sub01/sub05.php">&middot; 이사회</a></li>
					<li><a href="/sub01/sub06.php">&middot; 후원회</a></li>
					<li><a href="/sub01/sub07.php">&middot; 조직 및 직원안내</a></li>
					<li><a class="head" href="/sub01/sub08-1.php">&middot; 경영고시</a></li>
					<li><a class="head" href="/sub01/sub08-2.php">&middot; 수의계약</a></li>
					<li><a class="head" href="/sub01/sub08-3.php">&middot; 업무추진비</a></li>
					<li><a class="head" href="/sub01/sub08-4.php">&middot; 포천문화재단 윤리헌장</a></li>
					<li><a href="/sub01/sub09.php">&middot; 오시는길</a></li>
				</ul>
			</li>

			<li>
				<a class="link_sub_item">공연·전시<span class="menu-arr">＋</span></a>
				<ul class="sub_category">
					<li><a class="head" href="/sub02/sub01-1.php">&middot; 공연·전시 일정</a></li>
					<li><a class="head" href="/sub02/sub01-2.php">&middot; 공연·전시 캘린더</a></li>
					<li><a class="head" href="/sub02/sub02-1.php">&middot; 온라인 예매 방법</a></li>
					<li><a class="head" href="/sub02/sub01-1.php">&middot; 스마트폰 예매 방법</a></li>
					<li><a href="/sub02/sub03.php">&middot; 예매 확인/취소</a></li>
					<li><a href="/sub02/sub04.php">&middot; 회원제 안내</a></li>
					<li><a href="/sub02/sub05.php">&middot; 좌석배치도</a></li>
					<li><a href="/sub02/sub06.php">&middot; 관람예절</a></li>
				</ul>
			</li>

			<li>
				<a class="link_sub_item">문화관광사업 <span class="menu-arr">＋</span></a>
				<ul class="sub_category">
					<!-- <li><a class="head" href="/sub03/sub01-1.php">&middot; 한탄강 유채꽃 축제</a></li>
					<li><a class="head" href="/sub03/sub01-2.php">&middot; 평화그린 페스티벌</a></li> -->
					<li><a class="head" href="/sub03/sub01-3.php">&middot; 억새꽃 축제</a></li>
					<li><a class="head" href="/sub03/sub02-1.php">&middot; 전문예술인 지원사업</a></li>
					<li><a class="head" href="/sub03/sub02-2.php">&middot; 청년예술인 지원사업</a></li>
					<li><a class="head" href="/sub03/sub02-3.php">&middot; 생활예술 지원사업</a></li>
					<li><a class="head" href="/sub03/sub02-4.php">&middot; 거점공간 프로그램 지원사업</a></li>
					<li><a href="/sub03/sub03.php">&middot; 꿈의 오케스트라 운영</a></li>
					<li><a href="/sub03/sub04.php">&middot; 시민예술교육</a></li>
					<li><a class="head" href="/sub03/sub05-1.php">&middot; 문화예술단체</a></li>
					<li><a class="head" href="/sub03/sub05-2.php">&middot; 문화예술 거점공간</a></li>
					<li><a class="head" href="/sub03/sub05-3.php">&middot; DB 수정요청</a></li>
				</ul>
			</li>

			<li>
				<a class="link_sub_item">시립예술단 <span class="menu-arr">＋</span></a>
				<ul class="sub_category">
					<li><a href="/sub04/sub01-1.php">&middot; 시립민속예술단</a></li>
					<li><a href="/sub04/sub02-1.php">&middot; 시립극단</a></li>
					<li><a href="/sub04/sub03-1.php">&middot; 시립소년소녀합창단</a></li>
				</ul>
			</li>
			

			<li>
				<a class="link_sub_item">문화공간 <span class="menu-arr">＋</span></a>
				<ul class="sub_category">
					<li><a class="head" href="/sub05/sub01-1.php">&middot; 반월아트홀 면적·시설 안내</a></li>
					<li><a class="head" href="/sub05/sub01-2.php">&middot; 반월아트홀 무대기술자료</a></li>
					<li><a class="head" href="/sub05/sub01-3.php">&middot; 반월아트홀 좌석배치도 등</a></li>
					<li><a class="head" href="/sub05/sub01-4.php">&middot; 반월아트홀 위치도</a></li>
					<li><a class="head" href="/sub05/sub02-1.php">&middot; 무형문화 전수관<br> 면적·시설 안내</a></li>
					<li><a class="head" href="/sub05/sub02-2.php">&middot; 무형문화 전수관 위치도</a></li>
					<li><a class="head" href="/sub05/sub03-1.php">&middot; 광암이벽 유적지<br> 면적·시설 안내</a></li>
					<li><a class="head" href="/sub05/sub03-2.php">&middot; 광암이벽 유적지 위치도</a></li>
					<li><a class="head" href="/sub05/sub04-1.php">&middot; 백사 이항복 유적지 <br>면적·시설 안내</a></li>
					<li><a class="head" href="/sub05/sub04-2.php">&middot; 백사 이항복 유적지 위치도</a></li>
				</ul>
			</li>
			

			<li>
				<a class="link_sub_item">대관안내<span class="menu-arr">＋</span></a>
				<ul class="sub_category">
					<li><a href="/sub06/sub01.php">&middot; 대관규정</a></li>
					<li><a href="/sub06/sub02.php">&middot; 대관절차</a></li>
					<li><a href="/sub06/sub03.php">&middot; 대관료</a></li>
					<li><a href="/sub06/sub04-1.php">&middot; 대관신청</a></li>
					<!-- <li><a href="/sub06/sub05.php">&middot; 좌석배치도</a></li> -->
				</ul>
			</li>

			<li>
				<a class="link_sub_item">열린광장<span class="menu-arr">＋</span></a>
				<ul class="sub_category">
					<li><a href="/sub07/sub01.php">&middot; 공지사항</a></li>
					<li><a href="/sub07/sub02.php">&middot; 입찰·계약안내</a></li>
					<li><a href="/sub07/sub03.php">&middot; 채용안내</a></li>
					<li><a href="/sub07/sub04.php">&middot; 사업공모</a></li>
					<li><a href="/sub07/sub05.php">&middot; 참여마당</a></li>
					<li><a href="/sub07/sub06.php">&middot; 관람후기</a></li>
					<li><a href="#">&middot; 웹진</a></li>
				</ul>
			</li>
		</ul> 
	</nav>
	
	<div class="loginbox">
		<a href='/member/login.php'>로그인</a>
		<a href='/member/join.php'>회원가입</a>
	</div>
</div>


<script>
	document.addEventListener('DOMContentLoaded', function(){
		document.querySelector(".all-menu-mo").addEventListener("click", function(e){
			if ( document.querySelector('.menuwrap').classList.contains('on') ){
            //메뉴닫힘
            document.querySelector('.menuwrap').classList.remove('on');



            //페이지 스크롤 락 해제
            document.querySelector('#dimmed').remove();


			//페이지 스크롤 락 해제-밍디
			$('html, body').css({'overflow': 'auto'}); //scroll hidden 해제
			$('#element').off('scroll touchmove mousewheel'); // 터치무브 및 마우스휠 스크롤 가능
			//페이지 스크롤 락 해제-밍디end


		} else {
            //메뉴펼침
            document.querySelector('.menuwrap').classList.add('on');
            $(".btn-close-mo").css("display","block");

            //페이지 스크롤 락 레이어 추가
            let div = document.createElement('div');
            div.id = 'dimmed';
            document.body.append(div);

            

			//페이지 스크롤 락  모바일 이벤트 차단-밍디
			$('html, body').css({'overflow': 'hidden'}); // 모달팝업 중 html,body의 scroll을 hidden시킴 
			$('#element').on('scroll touchmove mousewheel', function(event) { // 터치무브와 마우스휠 스크롤 방지     
				event.preventDefault();     
				event.stopPropagation();     
				return false; 
			});
			//페이지 스크롤 락  모바일 이벤트 차단-밍디end


			//페이지 스크롤 락  모바일 이벤트 차단
			document.querySelector('#dimmed').addEventListener('scroll touchmove mousewheel', function(e){
				e.preventDefault();
				e.stopPropagation();
				return false;
			});             


			document.querySelector('#dimmed').addEventListener("click", function(){
                //메뉴닫힘
                document.querySelector('.menuwrap').classList.remove('on');
                $(".btn-close-mo").css("display","none");

                //페이지 스크롤 락 해제
                document.querySelector('#dimmed').remove();
				//페이지 스크롤 락 해제-밍디
				$('html, body').css({'overflow': 'auto'}); //scroll hidden 해제
				$('#element').off('scroll touchmove mousewheel'); // 터치무브 및 마우스휠 스크롤 가능
				//페이지 스크롤 락 해제-밍디end
			});


			document.querySelector('.btn-close-mo').addEventListener("click", function(){
                //메뉴닫힘
                document.querySelector('.menuwrap').classList.remove('on');
                $(".btn-close-mo").css("display","none");

                //페이지 스크롤 락 해제
                document.querySelector('#dimmed').remove();
				//페이지 스크롤 락 해제-밍디
				$('html, body').css({'overflow': 'auto'}); //scroll hidden 해제
				$('#element').off('scroll touchmove mousewheel'); // 터치무브 및 마우스휠 스크롤 가능
				//페이지 스크롤 락 해제-밍디end
			});
		}

	});
	});

	$(".category_list li a").click(function(){
		item = $(this).children(".menu-arr");
		$(".menu-arr").html("＋").css("color","#222");

		$('.sub_category').stop().slideUp();
		$(this).next('.sub_category').stop().slideToggle(500, function(){
			if(!$(this).is(":hidden")){
				item.html("－").css("color","#222");
			}
		});
	});



</script>
