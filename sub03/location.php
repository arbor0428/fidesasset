<div id="location">
	<div class="all-wrap">
		<div class="loca-area">
			<a class="homeBtn" href="/index.php" title="홈"><img src="../images/menu_home.png"></a>
			<ul>
				<li>
					<button type="button"><span>주요실적</span><img class="arrow" src="../images/menu_right_arrow.svg"></button>
				</li>
			</ul>
			<ul>
				<li class="submenu-list">
					<button type="button"><span style="color: #000; font-weight: 700;"><?=$topTxt01?></span><img class="arrow" src="../images/menu_down_arrow.svg"></button>
					<div class="next-depth">
						<ul>
							<li><a href="/sub03/sub01.php">프로젝트</a></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>

<script>
		var flag = true;
		$(".submenu-list").on("click",function(){

				if(flag){
					$(".next-depth").stop().hide();
					$(this).children(".next-depth").stop().show();

					flag= false;
				} else {

					$(this).children(".next-depth").stop().hide();

					flag= true;
				}

		});

</script>
