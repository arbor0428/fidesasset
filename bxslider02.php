<style type='text/css'>

.showBox01{
	border:1px solid #ccc;
	border-radius:20px;
	height:410px;
}
.mainBx{position:relative; cursor:pointer;}

.mainBx:hover .mainBxMore{opacity:1 !important;}
.mainBxMore{ 
	opacity:0;
	transition:all 0.15s;
	width:100%;
	height:100%;
	border-radius:20px;
	background:rgba(0,0,0,0.8);
	position:absolute;
	top:0; left:0;
	box-sizing:border-box;
	padding:40px 30px;
}

.mainBxMore .performtit{
	display: -webkit-box;
	-webkit-line-clamp: 3; /* 3줄이상 ... 처리 */
	-webkit-box-orient: vertical; /* 세로로배열 */
	white-space: normal;
	text-align: center;
	color: #fff;
	font-size: 20px;
	margin: 20px auto;
	font-weight: 600;
	/* width: 100%; */
	height: 85px;
	text-overflow: ellipsis;
	overflow: hidden;
	word-break:keep-all;
}
.morebtn{
	position:absolute;
	top:50%; left:50%;
	transform:translate(-50%,-50%);
	width:70%;
	padding:5px;
	box-sizing:border-box;
	text-align:center;
	color:#fff;
	border:1px solid #ddd;
}
.mainBx2{
	position:absolute;
	top:245px;
	width:200px;
	word-break:break-all;
}
.mainBx2 td{
	font-size:12px;
	color:#ffffff;
	padding:3px 0;
	font-weight:300;
}


/* 버튼 */
.slider01 .bx-wrapper .bx-prev{width:50px; height:50px; border-radius:50%; box-shadow:0 0 10px #ccc; background:url(/images/arrow-left.png) no-repeat center center;}
.slider01 .bx-wrapper .bx-next{width:50px; height:50px; border-radius:50%; box-shadow:0 0 10px #ccc; background:url(/images/arrow-right.png) no-repeat center center;}


.bx-wrapper{margin:0 auto;}

@media screen and (max-width:768px) {
	.showBox01{height:390px;}

	/* 버튼 */
	.slider01 .bx-wrapper .bx-prev{width:30px; height:30px;}
	.slider01 .bx-wrapper .bx-next{width:30px; height:30px;}
}

</style>

<ul class='bxslider02 clearfix'>
	<?
		$file_path = './board/upfile/';
		
		$sql = "select * from tb_board_list where table_id='table_1631524937' order by uid desc limit 12";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		
		for($i=0; $i<$num; $i++){
			$row = mysql_fetch_array($result);
			$uid = $row['uid'];
			$userfile01 = $row["userfile01"];
			$title = $row['title'];
			$sData01 = $row["sData01"];
			$sData02 = $row["sData02"];
			$sData03 = $row["sData03"];
			$sData06 = $row["sData06"];
			$sDataTxt = $row["sDataTxt"];
			$startDate = $row["startDate"];
			$endDate = $row["endDate"];
			
			
			$startDate = eregi_replace("-", ".", $startDate);
			$endDate = eregi_replace("-", ".", $endDate);
			
			$sData03 = $startDate;
			if($endDate){
				$eDateTxt = substr($endDate,5,10);
				$sData03 .= '~'.$eDateTxt;
				if($startDate==$endDate) $sData03=$startDate;
			}
			
			$geturl = $file_path.$userfile01;
			
			//원본이미지 넓이
			$fw = Util::GetImgSize($file_path.$userfile01);
			
			//썸네일 넓이와 비교후 파일설정
			if($fw > $img_w){
				$geturl = $file_path.'s_'.$userfile01;
				
				if(!is_file($geturl))		$geturl = $file_path.$userfile01;
			}
		?>
		<li onclick="location.href='./sub02/sub01-1.php?type=view&uid=<?=$uid?>'"  class='mainBx'>

			<div style='' class='mainBxMore'>
				<div class="performtit">
					<?=$title?>
				</div>
				<div class="morebtn">자세히보기</div>
				<table cellpadding='0' cellspacing='0' border='0' class='mainBx2'>
					<tr>
						<td width='16%'>장르</td>
						<td width='84%'><?=$sData01?></td>
					</tr>
					<tr>
						<td>일자</td>
						<td><?=$sData03?></td>
					</tr>
					<tr>
						<td>장소</td>
						<td><?=$sData02?></td>
					</tr>
					<tr>
						<td>문의</td>
						<td><?=$sData06?></td>
					</tr>
				</table>
			</div>

			<div class='showBox01' style="background:url('<?=$geturl?>') no-repeat;background-size:cover;"></div>
		</li>
		<?
		}
	?>
</ul>

<!-- <script language="JavaScript">
	$(document).ready(function(){
		$('.bxslider02').bxSlider({
		minSlides:4,      // 최소 노출 개수
		maxSlides: 12,      // 최대 노출 개수
		slideWidth: 280,   // 슬라이드 너비
		slideMargin:30,
		moveSlides: 1,
		controls:true,
		auto: true,
		pager:false,
		speed :1500,
		nextText: 'Next',
		prevText: 'Prev',
		touchEnabled : (navigator.maxTouchPoints > 0)
	});
	});
</script> -->



<script>
	$(window).resize(function(){
		var width = $(window).width();

		if(width >= 1200){
			$('.bxslider02').bxSlider({
				minSlides:4,      // 최소 노출 개수
				maxSlides: 12,      // 최대 노출 개수
				slideWidth: 290,   // 슬라이드 너비
				slideMargin:20,
				moveSlides: 1,
				controls:true,
				auto: true,
				pager:false,
				speed :1500,
				nextText: 'Next',
				prevText: 'Prev',
				touchEnabled : (navigator.maxTouchPoints > 0)
			});
		} else if (width>=768 && width<1199) { // 다바이스 크기가769이상일때
			$('.bxslider02').bxSlider({
				minSlides:2,      // 최소 노출 개수
				maxSlides: 10,      // 최대 노출 개수
				slideWidth: 300,   // 슬라이드 너비
				slideMargin:40,
				moveSlides: 1,
				controls:true,
				auto: true,
				pager:false,
				speed :1500,
				nextText: 'Next',
				prevText: 'Prev',
				touchEnabled : (navigator.maxTouchPoints > 0)
			});
		} else if (width < 768){
			$('.bxslider02').bxSlider({
				minSlides:1,      // 최소 노출 개수
				maxSlides: 10,      // 최대 노출 개수
				slideWidth: 280,   // 슬라이드 너비
				slideMargin:0,
				moveSlides: 1,
				controls:true,
				auto: true,
				pager:false,
				speed :1500,
				nextText: 'Next',
				prevText: 'Prev',
				touchEnabled : (navigator.maxTouchPoints > 0)
			});
		}
	});
	$(window).resize();
</script>