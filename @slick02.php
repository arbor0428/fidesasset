<ul class="slickslider clearfix">
	<li class="item">
		<div class="i-top"><img class="i-img" src="images/itempic01.jpg"></div>
		<div class="i-bot clearfix">
			<p>신제품</p>
			<a class="moreBtn" href="/sub02/sub01.php" title="more">
				<img src="images/rightarrow.png" alt="arrowbox">
			</a>
		</div>
	</li>
	<li class="item">
		<div class="i-top"><img class="i-img" src="images/itempic02.jpg"></div>
		<div class="i-bot clearfix">
			<p>전문의약품</p>
			<a class="moreBtn" href="/sub02/sub01.php" title="more">
				<img src="images/rightarrow.png" alt="arrowbox">
			</a>
		</div>
	</li>
	<li class="item">
		<div class="i-top"><img class="i-img" src="images/itempic03.jpg"></div>
		<div class="i-bot clearfix">
			<p>일반의약품</p>
			<a class="moreBtn" href="/sub02/sub01.php" title="more">
				<img src="images/rightarrow.png" alt="arrowbox">
			</a>
		</div>
	</li>
	<li class="item">
		<div class="i-top"><img class="i-img" src="images/itempic04.png"></div>
		<div class="i-bot clearfix">
			<p>건강기능식품</p>
			<a class="moreBtn" href="/sub02/sub01.php" title="more">
				<img src="images/rightarrow.png" alt="arrowbox">
			</a>
		</div>
	</li>
	<li class="item">
		<div class="i-top"><img class="i-img" src="images/itempic01.jpg"></div>
		<div class="i-bot clearfix">
			<p>신제품</p>
			<a class="moreBtn" href="/sub02/sub01.php" title="more">
				<img src="images/rightarrow.png" alt="arrowbox">
			</a>
		</div>
	</li>
	<li class="item">
		<div class="i-top"><img class="i-img" src="images/itempic02.jpg"></div>
		<div class="i-bot clearfix">
			<p>전문의약품</p>
			<a class="moreBtn" href="/sub02/sub01.php" title="more">
				<img src="images/rightarrow.png" alt="arrowbox">
			</a>
		</div>
	</li>
	<li  class="item">
		<div class="i-top"><img class="i-img" src="images/itempic03.jpg"></div>
		<div class="i-bot clearfix">
			<p>일반의약품</p>
			<a class="moreBtn" href="/sub02/sub01.php" title="more">
				<img src="images/rightarrow.png" alt="arrowbox">
			</a>
		</div>
	</li>
	<li class="item">
		<div class="i-top"><img class="i-img" src="images/itempic04.png"></div>
		<div class="i-bot clearfix">
			<p>건강기능식품</p>
			<a class="moreBtn" href="/sub02/sub01.php" title="more">
				<img src="images/rightarrow.png" alt="arrowbox">
			</a>
		</div>
	</li>
</ul>

<script>
	$('.slickslider').slick({ 
			slidesToShow: 4, 
			slidesToScroll: 1, 
			autoplay : true,			// 자동 스크롤 사용 여부
			autoplaySpeed :2000, 	
			responsive: [ 
				{ breakpoint: 1120, // 화면의 넓이가 1024px 이상일 때 
					settings: { 
					slidesToShow: 3, 
					slidesToScroll: 1
				}}, 
				{ breakpoint: 800, // 화면의 넓이가 768px 이상일 때 
					settings: { 
					slidesToShow: 2, 
					slidesToScroll: 1
				}}, 
				{ breakpoint: 600, // 화면의 넓이가 380px 이상일 때 
					settings: { 
					slidesToShow: 1, 
					slidesToScroll: 1 
				} 
				} 
			] 
		});
</script>