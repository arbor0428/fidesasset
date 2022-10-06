<?
	include "../header.php";
	$topTxt01='프로젝트';
?>

<!-------------------로케이션 바--------------------->
<?
	include 'location.php';
?>

<!----------------중간영역--------------------------->

<div class="sub_cont03">
	<div class="sub_center">
		<h4 class="sub03_tit">피데스에셋과 함께한 프로젝트들을 살펴보세요.</h4>
		<ul class="sub03_tabBtn">
			<li class="on">
				<a href="">
					<div class="ico_box">
						<img src="/images/building_ico01.png">
					</div>
					<div class="ico_tit">
						<div class="tit_line"></div>
						<p>OVERVIEW</p>
					</div>
				</a>
			</li>
			<li>
				<a href="">
					<div class="ico_box">
						<img src="/images/building_ico02.png">
					</div>
					<div class="ico_tit">
						<div class="tit_line"></div>
						<p>부동산 개발</p>
					</div>
				</a>
			</li>
			<li>
				<a href="">
					<div class="ico_box">
						<img src="/images/building_ico03.png">
					</div>
					<div class="ico_tit">
						<div class="tit_line"></div>
						<p>부동산 컨설팅</p>
					</div>
				</a>
			</li>
		</ul>
	</div>
	<div class="sub03_tabCont">
		<div class="tabCont_box">
			<?
				include "tabCont01.php";
			?>
		</div>
		<div class="tabCont_box">
			<?
				include "tabCont02.php";
			?>
		</div>
		<div class="tabCont_box">
			<?
				include "tabCont03.php";
			?>		
		</div>
	</div>
</div>

<script>
	$(".sub03_tabBtn > li").on("click",function(event){

		event.preventDefault();

		let tabNumber = $(this).index();

		$(".sub03_tabBtn > li").removeClass("on");
		$(this).addClass("on");

		$(".sub03_tabCont .tabCont_box").hide();;
		$(".sub03_tabCont .tabCont_box").eq(tabNumber).show();

	});
</script>

<?
	include "../footer.php";
?>