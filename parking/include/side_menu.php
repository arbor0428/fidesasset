<?
	$sNum01 = '#s'.$sNum01;
?>


<div class="sm_menu_list" style='padding:15px 0 30px 0;'>
	<p class="sm_ttl">주차관리</p>
	<ul id='s1'>
		<li><span class="disc"></span><a href='/parking/ticket/up_index.php?type=write'>면제권 등록</a></li>
		<li><span class="disc"></span><a href='/parking/ticket/up_index.php'>면제권 발행내역</a></li>
	</ul>
</div>

<script language='javascript'>
$('.sm_menu_list <?=$sNum01?> li:nth-child(<?=$sNum02?>)').addClass('msel')
</script>






<script language='javascript'>

//양도,양수 리스트용 상단에 붙는 네비게이션  (리스트의 경우 1100 / 등록페이지 및 기타페이지의 경우 1320 )




function sidemenu(){
	st = $(window).scrollTop();	//현재스크롤양
	winW=$(window).width();//윈도우 가로길이

	if(st >= 100 && winW<=1320){
		$(".aCon").css({"padding-left":"220px"})
		$(".sm_menu_list").css({"position":"fixed","top":"0","-webkit-transform":"translateZ(0)","height":"100%","border-right":"1px solid #d2d2d2"})
		
	}else if(st >= 100 && winW>=1320){
		$(".sm_menu_list").css({"position":"fixed","top":"0","-webkit-transform":"translateZ(0)"})
		$(".aCon").css({"padding-left":"20px"})

	}else if(winW>=1320){
		$(".aCon").css({"padding-left":"20px"})
		$(".sm_menu_list").css({"position":"relative","height":"auto","border-right":"none"})
	}
	
	else{
		$(".sm_menu_list").css({"position":"relative","height":"auto","border-right":"none"})
		$(".aCon").css({"padding-left":"20px"})
	}
}
</script>