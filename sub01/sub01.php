<?
	include "../header.php";
	$topTxt01='회사소개';
?>

<!-------------------로케이션 바--------------------->
<?
	include 'location.php';
?>

<!----------------중간영역--------------------------->

<div class="sub_cont01">
	<div class="sub_center">
		<div class="cont_tit">
			<div class="tit_line02"><!--line--></div>
			<h3>ABOUT US</h3>
		</div>
		<div class="aboutUs_wrap">
			<div class="about_img"><!--이미지들어감--></div>
			<div class="about_txt">
				<h4>주식회사 피데스에셋은</h4>
				<p class="firstP">부동산 개발, 컨설팅 및 자산관리 서비스를<br>
				제공하고 있는 전문 기업으로 고객의 성공을<br>
				위해 늘 함께하는 따뜻한 동반자입니다. 
				</p>
				<p>
				고객이 최고로 감탄하는 부동산 디벨로퍼로서<br>
				부동산 자산가치를 극대화 할 수 있도록 도와드리겠습니다.
				</p>
			</div>
		</div>
	</div>
</div>

<style>
	.cont_tit .tit_line02 {	
		width: 200px;
		position: absolute;
		left: 50%;
		transform: translateX(-50%);
		bottom: 8px;
		height: 14px;
		background-color: #FBD17F;
		opacity: 0.5;
		}
	@media (max-width: 1086px){
		.cont_tit .tit_line02 {
			width: 170px;
			bottom: 10px;
		}
</style>

<?
	include "../footer.php";
?>