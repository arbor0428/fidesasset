<style>
#mainPop{
	width:100%;
	height:100%;
	background:#ffffff;
	border:1px solid #ddd;
	padding:30px;
	color:#333;
	box-sizing:border-box;
	position:relative;	
	font-size:18px;
	font-weight:600;
	text-align:left;
}
.p_bxslider{width:100%;height:340px; margin-top:15px;position:relative;}
.p_bxslider .bx-controls-direction{
	position:absolute;
	right:50px;
	top:-23px;
	z-index:10;
}
.p_bxslider .bx-prev {
	width:25px !important;
	height:26px !important;
	left:0;
	top:0;
	background: url(/js/prev.jpg);
}

.p_bxslider .bx-next {
	width:26px !important;
	height:26px !important;
	left:25px;
	top:0;
	background: url(/js/next.jpg);
}

.p_bxslider .bx-next:hover,.p_bxslider .bx-prev:hover {
	background-position: 0px 0;
}
.p_bxslider .bx-wrapper .bx-controls-direction a.disabled {
	display: block;
}

.bxslider2 li{width:100%; height:100%;}
</style>

<div id='mainPop'>
	팝업존
	<div class='p_bxslider'>
		<ul class="bxslider2">
			<li><img src="/images/popup-curt2.png" alt="" style="width:100%;"></li>
			<li><img src="/images/popup-curt.png" alt="" style="width:100%;"></li>
		</ul>
	</div>
</div>

<script>
$('.bxslider2').bxSlider({
	mode:'horizontal',	
	slideWidth: 408,
	slideHeight: 350,
	auto: true,
	pager:false,
	touchEnabled : (navigator.maxTouchPoints > 0),
	controls:true
});
</script>