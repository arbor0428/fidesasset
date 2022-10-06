<ul class="slickslider clearfix" <?=$aosFadeUp?>>
<?

$query = "select * from ks_medicine order by uid desc limit 20";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$title = $row["title"];
		$memo = $row["memo"];
		$cade01 = $row["cade01"];
		$cade02 = $row["cade02"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$data04 = $row["data04"];
		$data05 = $row["data05"];
		$data06 = $row["data06"];
		$data07 = $row["data07"];
		$data08 = $row["data08"];
		$upfile01 = $row["upfile01"];
		$realfile01 = $row["realfile01"];
		$upfile02 = $row["upfile02"];
		$realfile02 = $row["realfile02"];
?>
	<li class="item" style='box-shadow:0px 19px 20px -8px rgb(0 0 0 / 40%);border:1px solid #dddddd;'>
		<a href="/sub02/sub01.php?type=view&uid=<?=$uid?>&f_cade01=<?=$cade01?>" title="more">
			<div class="i-top" style='background:url("/upfile/<?=$upfile01?>") center center no-repeat #ffffff;background-size:contain'></div>
			<div class="i-bot clearfix">
				<p class='drop'><?=$title?></p>
				<div class="moreBtn">
					<img src="images/rightarrow.png" alt="arrowbox">
				</div>
			</div>
		</a>
	</li>
<?
	}	
?>
</ul>

<script>
	$('.slickslider').slick({ 
		slidesToShow: 4, 
		slidesToScroll: 1, 
		autoplay : true,			// 자동 스크롤 사용 여부
		autoplaySpeed :2000000, 	
		responsive: [ 
			{ breakpoint: 1120, // 화면의 넓이가 1024px 이상일 때 
				settings: { 
				slidesToShow: 3, 
				slidesToScroll: 1
			}}, 
			{ breakpoint: 800, // 화면의 넓이가 768px 이상일 때 
				settings: { 
				slidesToShow: 2, 
				slidesToScroll: 1
			}}, 
			{ breakpoint: 600, // 화면의 넓이가 380px 이상일 때 
				settings: { 
				slidesToShow: 1, 
				slidesToScroll: 1 
			} 
			} 
		] 
	});
</script>
<style>
.sec01 .slickslider .item{transition:all 0.5s;}
.sec01 .slickslider .item:hover{margin-top:-30px;}
.slick-next, .slick-prev{z-index:1;margin-top:-30px;}
.slick-prev{left:-75px !important;}
.slick-list{overflow:initial}
.slick-next:before, .slick-prev:before{font-size:70px;color:#000}
</style>