<?
	include "../header.php";
	$topTxt01='오시는길';
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
			<h3>CONTACT US</h3>
		</div>
		<div class="contactUs_wrap">
			<div class="contact_map">
				<div id="map"></div>
					<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=5419fb7047bf27aded53ebbbccf15379"></script>
					<script>
					var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
						mapOption = { 
							center: new kakao.maps.LatLng(37.49408, 127.01196), // 지도의 중심좌표
							level: 3 // 지도의 확대 레벨
						};

					var map = new kakao.maps.Map(mapContainer, mapOption);

					// 마커가 표시될 위치입니다 
					var markerPosition  = new kakao.maps.LatLng(37.49408, 127.01196); 

					// 마커를 생성합니다
					var marker = new kakao.maps.Marker({
						position: markerPosition
					});

					// 마커가 지도 위에 표시되도록 설정합니다
					marker.setMap(map);
						// 커스텀 오버레이에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
						var content = '<div class="customoverlay">' +
							'    <span class="title">피데스에셋</span>' +
							'</div>';

						// 커스텀 오버레이가 표시될 위치입니다 
						var position = new kakao.maps.LatLng(37.49408, 127.01196);  

						// 커스텀 오버레이를 생성합니다
						var customOverlay = new kakao.maps.CustomOverlay({
							map: map,
							position: position,
							content: content,
							yAnchor: 1 
						});
					</script>
					<style>
						.customoverlay {position: relative; left: 55px; top: -10px; width: 100px; height: 30px; border-radius: 40px; background-color:#1f74cd;}
						.customoverlay .title {display: block; line-height: 30px; text-align: center; font-size: 14px; font-weight: 500;  color: #fff;}
					</style>
			</div>
			<div class="contact_txt">
				<h4>피데스에셋</h4>
				<ul>
					<li>
						<span><img src="/images/location.png"></span>
						<span>서울특별시 서초구 서초대로49길 9, 401호(서초동, 서도빌딩)</span>
					</li>
					<li>
						<span><img src="/images/subway.png"></span>
						<span>지하철 2호선, 3호선 교대역 10번출구이용, 도보 3분</span>
					</li>
					<li>
						<span><img src="/images/phone.png"></span>
						<span>02-583-3220</span>
					</li>
					<li>
						<span><img src="/images/fax.png"></span>
						<span>02-749-9278</span>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<style>
	.cont_tit .tit_line02 {	
		width: 220px;
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
			width: 197px;
			bottom: 10px;
		}
</style>


<?
	include "../footer.php";
?>