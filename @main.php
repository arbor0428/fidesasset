<?
	include './header.php';
	include './visit.php';

	include './ks_popset.php';
?>


<div class="visual clearfix">
	<div class="slider01">
	<div class="sec-tit">
		<h4>공연 · 전시</h4>
		<!-- <h5>문화와 예술을 사랑하는 포천문화재단</h5> -->
	</div>
		 <?
			//공연 및 프로그램 	
			include 'bxslider02.php';
		?>
	</div>
</div>

<div class="section section1">
	<div class="sec-tit">
		<h4>문화관광사업</h4>
		<!-- <h5>문화와 예술을 사랑하는 포천문화재단</h5> -->
	</div>

	<div class="culturebox clearfix">
		<div class="culbox"><a href="/sub03/sub01-3.php">
			<img src="/images/culture1.png" alt="문화정책사업" class="pc">
			<img src="/images/sec1-1m.png" alt="" class="m">
			<div class="menu-txt">
				<img src="/images/cul-i1.png" alt="">
				<p>축 제</p>
			</div></a>
		</div>

		<div class="culbox"><a href="/sub03/sub02-1.php">
			<img src="/images/culture2.png" alt="문화정책사업" class="pc">
			<img src="/images/sec1-1m.png" alt="" class="m">
			<div class="menu-txt">
				<img src="/images/cul-i2.png" alt="">
				<p>문화예술지원사업</p>
			</div></a>
		</div>

		<div class="culbox"><a href="/sub03/sub03.php">
			<img src="/images/culture3.png" alt="문화정책사업" class="pc">
			<img src="/images/sec1-1m.png" alt="" class="m">
			<div class="menu-txt">
				<img src="/images/cul-i3.png" alt="">
				<p>꿈의 오케스트라 운영</p>
			</div></a>
		</div>

		<div class="culbox"><a href="/sub03/sub04.php">
			<img src="/images/culture4.png" alt="문화정책사업" class="pc">
			<img src="/images/sec1-1m.png" alt="" class="m">
			<div class="menu-txt">
				<img src="/images/cul-i4.png" alt="">
				<p>시민예술교육</p>
			</div></a>
		</div>

		<div class="culbox"><a href="/sub03/sub05-1.php">
			<img src="/images/culture5.png" alt="문화정책사업" class="pc">
			<img src="/images/sec1-1m.png" alt="" class="m">
			<div class="menu-txt">
				<img src="/images/cul-i5.png" alt="">
				<p>문화예술 커뮤니티</p>
			</div></a>
		</div>
	</div>
	<div class="section-bg"></div>
</div>

<div class="section section2 clearfix">
	<div class="sec2con1">
		<div class="noticebox">
			<?
				include 'notice.php'
			?>
		</div>
		<div class="iconbox clearfix">
			<div class="board-icon"><a href="/sub04/sub01-1.php">
				<img src="/images/bor-i1.png" alt="">
				<p>시립민속예술단</p></a>
			</div>
			
			<div class="board-icon"><a href="/sub05/sub01-1.php">
				<img src="/images/bor-i2.png" alt="">
				<p>문화공간</p></a>
			</div>

			<div class="board-icon"><a href="/sub06/sub01.php">
				<img src="/images/bor-i3.png" alt="">
				<p>대관안내</p></a>
			</div>

			<div class="board-icon"><a href="/sub01/sub06.php">
				<img src="/images/bor-i4.png" alt="">
				<p>후원회</p></a>
			</div>
		</div>
	</div>

	<div class="sec2con2">
		<?
			include'mainPop.php';
		?>
	</div>
</div>

<?
	include'footer.php';
?>