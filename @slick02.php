<ul class="slickslider clearfix">
	<li class="item">
		<div class="i-top"><img class="i-img" src="images/itempic01.jpg"></div>
		<div class="i-bot clearfix">
			<p>����ǰ</p>
			<a class="moreBtn" href="/sub02/sub01.php" title="more">
				<img src="images/rightarrow.png" alt="arrowbox">
			</a>
		</div>
	</li>
	<li class="item">
		<div class="i-top"><img class="i-img" src="images/itempic02.jpg"></div>
		<div class="i-bot clearfix">
			<p>�����Ǿ�ǰ</p>
			<a class="moreBtn" href="/sub02/sub01.php" title="more">
				<img src="images/rightarrow.png" alt="arrowbox">
			</a>
		</div>
	</li>
	<li class="item">
		<div class="i-top"><img class="i-img" src="images/itempic03.jpg"></div>
		<div class="i-bot clearfix">
			<p>�Ϲ��Ǿ�ǰ</p>
			<a class="moreBtn" href="/sub02/sub01.php" title="more">
				<img src="images/rightarrow.png" alt="arrowbox">
			</a>
		</div>
	</li>
	<li class="item">
		<div class="i-top"><img class="i-img" src="images/itempic04.png"></div>
		<div class="i-bot clearfix">
			<p>�ǰ���ɽ�ǰ</p>
			<a class="moreBtn" href="/sub02/sub01.php" title="more">
				<img src="images/rightarrow.png" alt="arrowbox">
			</a>
		</div>
	</li>
	<li class="item">
		<div class="i-top"><img class="i-img" src="images/itempic01.jpg"></div>
		<div class="i-bot clearfix">
			<p>����ǰ</p>
			<a class="moreBtn" href="/sub02/sub01.php" title="more">
				<img src="images/rightarrow.png" alt="arrowbox">
			</a>
		</div>
	</li>
	<li class="item">
		<div class="i-top"><img class="i-img" src="images/itempic02.jpg"></div>
		<div class="i-bot clearfix">
			<p>�����Ǿ�ǰ</p>
			<a class="moreBtn" href="/sub02/sub01.php" title="more">
				<img src="images/rightarrow.png" alt="arrowbox">
			</a>
		</div>
	</li>
	<li  class="item">
		<div class="i-top"><img class="i-img" src="images/itempic03.jpg"></div>
		<div class="i-bot clearfix">
			<p>�Ϲ��Ǿ�ǰ</p>
			<a class="moreBtn" href="/sub02/sub01.php" title="more">
				<img src="images/rightarrow.png" alt="arrowbox">
			</a>
		</div>
	</li>
	<li class="item">
		<div class="i-top"><img class="i-img" src="images/itempic04.png"></div>
		<div class="i-bot clearfix">
			<p>�ǰ���ɽ�ǰ</p>
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
			autoplay : true,			// �ڵ� ��ũ�� ��� ����
			autoplaySpeed :2000, 	
			responsive: [ 
				{ breakpoint: 1120, // ȭ���� ���̰� 1024px �̻��� �� 
					settings: { 
					slidesToShow: 3, 
					slidesToScroll: 1
				}}, 
				{ breakpoint: 800, // ȭ���� ���̰� 768px �̻��� �� 
					settings: { 
					slidesToShow: 2, 
					slidesToScroll: 1
				}}, 
				{ breakpoint: 600, // ȭ���� ���̰� 380px �̻��� �� 
					settings: { 
					slidesToShow: 1, 
					slidesToScroll: 1 
				} 
				} 
			] 
		});
</script>