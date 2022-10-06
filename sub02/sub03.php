<?
	include "../header.php";
	$topTxt01='자산관리(PM)';
?>

<!-------------------로케이션 바--------------------->
<?
	include 'location.php';
?>

<!----------------중간영역--------------------------->
<div class="sub_cont02">
	<div class="sub_center">
		<h4>자산관리(PM)</h4>
		<div class="detail_wrap">
			<div class="yellow_line"><!--노란선--></div>
			<p class="sub_tit_detail"><span>특별한 기술력과 노하우를 바탕으로</span></p>
			<p class="sub_tit_detail"><span>최고의 부동산 가치를 제공하기 위해 최적화된</span></p>
			<p class="sub_tit_detail"><span class="yellowline yellowthird"></span><span>부동산 자산관리 PM(Property Management)</span></p>
			<p class="sub_tit_detail"><span>서비스를 제공하고 있습니다.</span></p>
		</div>
	</div>
	<div class="pm_wrap">
		<div class="cont_tit">
			<div class="tit_line02"><!--line--></div>
			<h3>부동산 자산관리 PM</h3>
		</div>
		<p class="pm_detail">
		고객의 부동산에 대한 예산˙회계와 같은 운영 지원과 임대차 계약 관리 및 입주사 관리, <br>
		시설물 전반에 걸친 사후관리까지 <span class="yellow">고객만족</span>은 물론 고객의 <span class="yellow">자산 가치</span>를 높일 수 있는 경쟁력 향상을 위해 항상 앞장서고 있습니다.
		</p>
		<div class="pm_imgWrap">
			<img src="/images/pm_boxes.png">
		</div>
	</div>
</div>
<style>
	.cont_tit .tit_line02 {	
		width: 285px;
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
			width: 250px;
			bottom: 10px;
		}
</style>

<?
	include "../footer.php";
?>