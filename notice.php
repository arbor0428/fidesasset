

<?
	//재단공지, 언론보도, 경영공시, 서식자료실
	$tableID = Array('table_1631524825','table_1631524849','table_1631524872','table_1631524886');

	$pageName = Array('/sub07/sub01.php','/sub07/sub03.php','/sub07/sub05.php','/sub07/sub06.php');

	$boardArr = Array();
?>



<div id="csTab">
	<ul class="tabs">
		<li class="tab-active" rel="tab1">공지사항</li>
		<li rel="tab2">채용안내</li>
		<li rel="tab3">참여마당</li>
		<li rel="tab4">관람후기</li>
	</ul>

	<div class="more">
		<a href="<?=$pageName[0]?>" id="moreBtn">
			<img src="/images/more.png" style="max-width:100%;" alt="더보기"/>
		</a>
	</div>

	 <div class="tab-container">
		<div id="tab1" class="tab-content ">
		<?
				$sql = "select * from tb_board_list where table_id='$tableID[0]' order by uid desc limit 6";
				$result = mysql_query($sql);
				$num = mysql_num_rows($result);

				for($i=0; $i<$num; $i++){
					$row = mysql_fetch_array($result);
					$uid = $row['uid'];
					$title = $row['title'];
					$reg_date = date('Y-m-d',$row['reg_date']);

					$linkTxt = $pageName[0]."?type=view&uid=".$uid;

		?>
					<ul class="notice__list ">
						<li class="notice__list_tit"><a href="<?=$linkTxt?>"><?=$title?></a></li>
						<li class="notice__list_date"><?=$reg_date?></li>
					</ul>
		<?
				}
		?>
		</div>

<?
	for($t=0; $t<count($tableID); $t++){
		$table_id = $tableID[$t];

		if($y == 0)	$disp = "block";
		else			$disp = "none";
?>
		 <div id="tab<?=$t+1?>" class="tab-content " style="display:<?=$disp?>;">
<?
		$sql = "select * from tb_board_list where table_id='$table_id' order by uid desc limit 6";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		for($i=0; $i<$num; $i++){
			$row = mysql_fetch_array($result);
			$uid = $row['uid'];
			$title = $row['title'];
			$reg_date = date('Y-m-d',$row['reg_date']);

			$linkTxt = $pageName[$t]."?type=view&uid=".$uid;

?>
			<ul class="notice__list ">
				<li class="notice__list_tit"><a href="<?=$linkTxt?>"><?=$title?></a></li>
				<li class="notice__list_date"><?=$reg_date?></li>
			</ul>
<?
		}
?>
		</div>
<?
	}
?>
	 </div>
	 <!-- tab-container -->
</div>
<!-- cs-tab -->
		


<script>
$(function(){
	$(".tab-content").hide();
	$(".tab-content:first").show();

	$("ul.tabs li").click(function () {
		$("ul.tabs li").removeClass("tab-active").css("color","#666");

		$(this).addClass("tab-active").css({"color": "#294880"});

		$(".tab-content").hide();
		var activeTab = $(this).attr("rel");
		$("#" + activeTab).fadeIn();

		//더보기버튼 링크변경
		if(activeTab == 'tab1')			$('#moreBtn').attr('href', '<?=$pageName[0]?>');
		else if(activeTab == 'tab2')		$('#moreBtn').attr('href', '<?=$pageName[1]?>');
		else if(activeTab == 'tab3')		$('#moreBtn').attr('href', '<?=$pageName[2]?>');
		else if(activeTab == 'tab4')		$('#moreBtn').attr('href', '<?=$pageName[3]?>');
	});
});
</script>