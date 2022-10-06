<!-- <?
	if($_SERVER['REMOTE_ADDR'] == '106.246.92.237' && $table_id){
		echo $list_file.'<br>';
		echo $view_file.'<br>';
		echo $write_file.'<br>';
	}
?> -->



<div class="T2_Abanner_wrap">
	<div class="T2_Abanner"> 
		<!-- 배너 -->
		<div class="bnZone" id="mbanner">
			<div class="inner">
				<h2>배너존</h2>		
				<div class="control">
					<a class="prev" href="#mbanner" title="이전배너보기">이전배너보기</a>
					<a class="stop" href="#mbanner" title="정지">정지</a>
					<a class="play" href="#mbanner" title="재생" style="display: none;">재생</a>
					<a class="next" href="#mbanner" title="다음배너보기">다음배너보기</a>
				</div>
				
				<ul class="obj" style="left: 0px;">	
					<li>
						<a href="https://www.austin.go.kr/www/index.do" target="_blank" title="포천시">
							<img src="/images/pt01.png" alt="포천시">
						</a>
					</li>
					<li>
						<a href="http://pc-scholarship.or.kr/main" target="_blank" title="포천시교육재단">
							<img src="/images/pt02.png" alt="포천시교육재단">
						</a>
					</li>
					<li>
						<a href="https://www.gg.go.kr/" target="_blank" title="경긱도청">
							<img src="/images/pt03.png" alt="경기도청">
						</a>
					</li>
					<li>
						<a href="https://www.mcst.go.kr/kor/main.jsp" target="_blank" title="문화체육관광부">
							<img src="/images/pt04.png" alt="문화체육관광부">
						</a>
					</li>
					<li>
						<a href="https://www.arte.or.kr/index.do" target="_blank" title="한국문화예술교육진흥원">
							<img src="/images/pt05.png" alt="한국문화예술교육진흥원">
						</a>
					</li>
					<li>
						<a href="https://www.nts.go.kr/" target="_blank" title="국세청">
							<img src="/images/pt06.png" alt="국세청">
						</a>
					</li>
					<li>
						<a href="https://www.kocaca.or.kr/" target="_blank" title="한국문화예술회관연합회">
							<img src="/images/pt07.png" alt="한국문화예술회관연합회">
						</a>
					</li>
					<li>
						<a href="https://www.gokams.or.kr/main/main.aspx" target="_blank" title="예술경영지원센터">
							<img src="/images/pt08.png" alt="예술경영지원센터">
						</a>
					</li>
					<li>
						<a href="http://www.iesc.co.kr/board/bbs/main.php" target="_blank" title="국제교류지원센터">
							<img src="/images/pt09.png" alt="국제교류지원센터">
						</a>
					</li>
				</ul>
			</div>
		</div>
		<!-- //배너 -->  
	</div>
</div>

<footer class="T2_Afooter">
	<div class="area_footer">
		<div class="box_footer"> 
			<div class="footer_link">
				<ul class="clearfix">
					<li><a href="/member/privacy.php" style="color:#fff;">개인정보처리방침</a></li>
					<li><a href="/member/privacy02.php">이용약관</a></li>
					<li><a href="/sub01/sub01.php">재단소개</a></li>
					<li><a href="/sub01/sub09.php">찾아오시는 길</a></li>
				</ul>
			</div>
			
			<div class="box_info clearfix">
				<p class="ft_logo"><img src="/images/ft_logo.png" alt="footer 로고" style="width:100%;"></p>
				<p style="margin-bottom:5px;">(재)포천문화재단</p>
				<p>주소 : [11151] 경기도 포천시 군내면 청성로 111 포천반월아트홀</p>
				<p>TEL : <a href="tel:0315353600">031-535-3600</a></p>
				
				<span class="copyright">
					Copyright&copy; 포천문화재단. All Rights Reserved. &nbsp; &nbsp; 
					<a href="https://i-web.kr" target="_blank" title="새창열기" style="color:#999;">홈페이지A/S 아이웹</a>
				</span>
			</div>
			
			<div class="btn_top">
				<a href="#none" class="top">
					<img src="/images/bg_topmove.jpg" style="width:100%;" alt="상단이동">
				</a>
			</div>
		</div>
	</div>
</footer>




<script>
	//배너존
	$(document).ready(function(){		
		var param = "#mbanner";
		var obj = ".obj>li";
		var btn = param+" .control";
		var interval = 5000; 
		var speed = 0;
		var viewSize = 1;
		var moreSize = 0;
		var dir = "x";
		var data = 0;
		var auto = true;
		var hover = false;
		var method = "easeInOutCubic";
		var op1 = false;		 
		stateScrollObj(param,obj,btn,interval,speed,viewSize,moreSize,dir,data,auto,hover,method,op1);
	});
	function stateScrollObj(param,obj,btn,interval,speed,viewSize,moreSize,dir,data,auto,hover,method,op1){
		var param = $(param);
		var btn = $(btn);
		var obj = param.find(obj);

		var elem = 0;
		var objYScale = obj.eq(elem).outerHeight(true)+moreSize;
		var objXScale = obj.eq(elem).outerWidth(true)+moreSize;
		var str;
		var returnNodes;

		var playdir = data;
		var data = data; // 0:default, 1:prev

		var play = btn.find("a.play");
		var stop = btn.find("a.stop");

		if(auto == true) play.hide(); else stop.hide(); 
		if(op1 == true) obj.not(elem).css({opacity:0}).eq(elem).css({opacity:1});

		function movement(){
			if(obj.parent().find(":animated").size()) return false;
			switch(data){
				case 0:
				if(dir == "x"){
					obj.parent().stop(true,true).animate({left:-objXScale},{duration:speed,easing:method,complete:
						function(){
							obj.parent().css("left",0);
							str = obj.eq(elem).detach();
							obj.parent().append(str);
							if(elem == obj.size()-1){
								elem = 0;
							}else{
								elem++;
							}
							objXScale = obj.eq(elem).outerWidth(true)+moreSize;
						}
					});
				}else{ 
					obj.parent().stop(true,true).animate({top:-objYScale},{duration:speed,easing:method,complete:
						function(){
							obj.parent().css("top",0);
							str = obj.eq(elem).detach();
							obj.parent().append(str);
							if(elem == obj.size()-1){
								elem = 0;
							}else{
								elem++;
							}
							objYScale = obj.eq(elem).outerHeight(true)+moreSize;
						}
					});
				}

				if(op1 == true){
					obj.eq(elem).stop(true,true).animate({opacity:0},{duration:speed,easing:method});
					obj.eq(elem).next().stop(true,true).animate({opacity:1},{duration:speed,easing:method});
					//obj.eq(elem).stop(true,true).fadeOut(speed);
					//obj.eq(elem).next().stop(true,true).fadeIn(speed);
					//obj.eq(elem).css({"z-index":"0"});
					//obj.eq(elem).next().css({"z-index":"1"});
				}
				break;

				case 1:
				if(dir == "x"){
					if(elem == 0){
						elem = obj.size()-1;
					}else{
						elem--;
					}
					objXScale = obj.eq(elem).outerWidth(true)+moreSize;
					obj.parent().css("left",-objXScale);
					str = obj.eq(elem).detach();
					obj.parent().prepend(str);
					obj.parent().stop(true,false).animate({left:0},{duration:speed,easing:method});
				}else{
					if(elem == 0){
						elem = obj.size()-1;
					}else{
						elem--;
					}
					objYScale = obj.eq(elem).outerHeight(true)+moreSize;
					obj.parent().css("top",-objYScale);
					str = obj.eq(elem).detach();
					obj.parent().prepend(str);
					obj.parent().stop(true,false).animate({top:0},{duration:speed,easing:method});
				}

				if(op1 == true){
					obj.eq(elem).stop(true,false).animate({opacity:1},{duration:speed,easing:method});
					obj.eq(elem).next().stop(true,false).animate({opacity:0},{duration:speed,easing:method});
					//obj.eq(elem).stop(true,false).fadeIn(speed);
					//obj.eq(elem).next().stop(true,false).fadeOut(speed);
					//obj.eq(elem).css({"z-index":"1"});
					//obj.eq(elem).next().css({"z-index":"0"});
				}
				break;

				default: alert("warning, 0:default, 1:prev, data:"+data);
			}
		}

		function rotate(){
			clearInterval(returnNodes);
			returnNodes = setInterval(function(){
				movement();
				$(".pop_co").text($(".pop>li:eq(0)").attr("id"));
			},interval);
		}

		if(obj.size() <= viewSize) return false;

		obj.find("a").bind("focusin",function(){
			clearInterval(returnNodes);
		});

		btn.find("a.play").bind("click",function(event){
			data = playdir;
			play.hide();
			stop.show();
			rotate();
			return false;
		});

		btn.find("a.stop").bind("click",function(event){
			clearInterval(returnNodes);
			param.find(":animated").stop();
			stop.hide();
			play.show();
			$(".pop_co").text($(".pop>li:eq(0)").attr("id"));
			return false;
		});

		btn.find("a.prev").bind("click",function(event){
			clearInterval(returnNodes);
			data = 1;
			movement();
						// add
						stop.hide();
						play.show();
						$(".pop_co").text($(".pop>li:eq(0)").attr("id"));
						return false;
					});

		btn.find("a.next").bind("click",function(event){
			clearInterval(returnNodes);
			data = 0;
			movement();
						// add
						stop.hide();
						play.show();
						$(".pop_co").text($(".pop>li:eq(0)").attr("id"));
						return false;
					});

		if(hover == true){
			obj.hover(function(){
				clearInterval(returnNodes);
			},function(){
				rotate();
			});
		}

		if(auto == true) rotate();
	}
</script>



<?
	include 'quick.php';
?>


<script>
	$(function () {
	// 맨위로 가기	
	$(window).resize(function(){
		win_w = $(window).width();
	}).resize();
	
	$('.top').click(function(){
		$('html, body').animate({scrollTop:0}, 400);
		return false;
	});	
});


//서식파일 다운로드
function formDown(p){
	document.ifra_gbl.location.href = '/module/formDown.php?p='+p;
}
</script>

<!-- 알림 메세지 -->
<a id="GblNotice_open" class="GblNotice_open"></a>

<div id="GblNotice" class="popup_background" style="min-width:250px;display:none;">
	<div class="cls_buttonali" id="alertCloseBtn"><button class="GblNotice_close close_button_pop"></button></div>
	<div class="popup_notice">
		<div class="clearfix"><div class="img_clear"><img src="/module/popupoverlay/ico_notice.gif" alt="notice"></div><div class="pop_ttl0">알림</div></div>
		<div class="pop_div_dotted"></div>
		<div class="write_it"><span id="alertTxt" class="txt_bold" style='line-height:20px;'></span></div>
		<div class="btn_ali_pop2" id="alertBtn"><input type="button" class="btn_notice_reg GblNotice_close" value="확인" /></div>
	</div>
</div>

<!-- confirm창 -->
<a id="conFirm_open" class="conFirm_open"></a>
<div id="conFirm" class="popup_background" style="min-width:250px;display:none;">
	<div class="cls_buttonali" id="conFirmCloseBtn"><button class="conFirm_close close_button_pop"></button></div>
	<div class="popup_notice">
		<div class="clearfix"><div class="img_clear"><img src="/module/popupoverlay/ico_notice.gif" alt="notice"></div><div class="pop_ttl0">확인</div></div>
		<div class="pop_div_dotted"></div>
		<div class="write_it"><span id="confirmTxt" class="txt_bold"></span></div>
		<a class="conFirm_close" href="javascript://">
			<div class="btn2_wrap">
				<div class="btn_ali_pop3" id="confirmCancelBtn"><input type="button" class="btn_notice_reg_cancel" value="취소" /></div>
				<div class="btn_ali_pop3" id="confirmBtn"><input type="button" class="btn_notice_reg_add" value="확인"></div>
			</div>
		</a>
	</div>
</div>

<!-- 멀티팝업 -->
<a id="multiBox_open" class="multiBox_open"></a>
<div id="multiBox" class="popup_background" style="min-width:250px;display:none;">
	<div class="cls_buttonali"><button class="multiBox_close close_button_pop"></button></div>
	<div class="popup_notice">
		<div class="write_it">
			<div id='multiFrame' style="margin:10px 0 0 0;background:#fff;overflow:hidden;position:relative;"></div>
		</div>
	</div>
</div>



<!-- 팝업 스크립트 -->
<script>
$(document).ready(function () {
	$('#GblNotice,#conFirm,#multiBox').popup({
		transition: 'all 0.3s',
		blur: false,
		escape:false,
		scrolllock: false
	});

});

</script>

<!-- 팝업 스크립트 -->
<!--<div class="top_btn"><i class="fa fa-chevron-up"></i></div>-->

<iframe name='ifra_gbl' src='about:blank' width='0' height='0' frameborder='0' scrolling='no' style='display:none;' title='아이프레임'></iframe>


</body>
</html>