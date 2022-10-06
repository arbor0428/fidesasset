<style>
.main2_wrap .bx-wrapper {overflow:hidden;}
.main2_wrap .bx-wrapper .bx-prev {left:60px;}
.main2_wrap .bx-wrapper .bx-next {right:60px;}
.main2_wrap .bx-wrapper .bx-pager {left:0; top:450px; bottom:30px;}
</style>


<div class="main2_wrap" style="margin-bottom:30px;visibility:hidden;opacity:0;">	
	<div id="main2">
<?
	$sql = "select * from ks_mainimg";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$link01 = $row['link01'];
	$target01 = $row['target01'];
	$sTime01 = $row['sTime01'];
	$eTime01 = $row['eTime01'];
	$upfile01 = $row['upfile01'];
	$upfile02 = $row['upfile02'];

	$link02 = $row['link02'];
	$target02 = $row['target02'];
	$sTime02 = $row['sTime02'];
	$eTime02 = $row['eTime02'];
	$upfile03 = $row['upfile03'];
	$upfile04 = $row['upfile04'];

	$link03 = $row['link03'];
	$target03 = $row['target03'];
	$sTime03 = $row['sTime03'];
	$eTime03 = $row['eTime03'];
	$upfile05 = $row['upfile05'];
	$upfile06 = $row['upfile06'];

	$link04 = $row['link04'];
	$target04 = $row['target04'];
	$sTime04 = $row['sTime04'];
	$eTime04 = $row['eTime04'];
	$upfile07 = $row['upfile07'];
	$upfile08 = $row['upfile08'];

	$link05 = $row['link05'];
	$target05 = $row['target05'];
	$sTime05 = $row['sTime05'];
	$eTime05 = $row['eTime05'];
	$upfile09 = $row['upfile09'];
	$upfile10 = $row['upfile10'];

	$link06 = $row['link06'];
	$target06 = $row['target06'];
	$sTime06 = $row['sTime06'];
	$eTime06 = $row['eTime06'];
	$upfile11 = $row['upfile11'];
	$realfile11 = $row['realfile11'];
	$upfile12 = $row['upfile12'];
	$realfile12 = $row['realfile12'];

	$link07 = $row['link07'];
	$target07 = $row['target07'];
	$sTime07 = $row['sTime07'];
	$eTime07 = $row['eTime07'];
	$upfile13 = $row['upfile13'];
	$realfile13 = $row['realfile13'];
	$upfile14 = $row['upfile14'];
	$realfile14 = $row['realfile14'];

	$link08 = $row['link08'];
	$target08 = $row['target08'];
	$sTime08 = $row['sTime08'];
	$eTime08 = $row['eTime08'];
	$upfile15 = $row['upfile15'];
	$realfile15 = $row['realfile15'];
	$upfile16 = $row['upfile16'];
	$realfile16 = $row['realfile16'];

	$link09 = $row['link09'];
	$target09 = $row['target09'];
	$sTime09 = $row['sTime09'];
	$eTime09 = $row['eTime09'];
	$upfile17 = $row['upfile17'];
	$realfile17 = $row['realfile17'];
	$upfile18 = $row['upfile18'];
	$realfile18 = $row['realfile18'];

	$link10 = $row['link10'];
	$target10 = $row['target10'];
	$sTime10 = $row['sTime10'];
	$eTime10 = $row['eTime10'];
	$upfile19 = $row['upfile19'];
	$realfile19 = $row['realfile19'];
	$upfile20 = $row['upfile20'];
	$realfile20 = $row['realfile20'];

	$linkArr = Array($link01,$link02,$link03,$link04,$link05,$link06,$link07,$link08,$link09,$link10);
	$targetArr = Array($target01,$target02,$target03,$target04,$target05,$target06,$target07,$target08,$target09,$target10);
	$pcArr = Array($upfile01,$upfile03,$upfile05,$upfile07,$upfile09,$upfile11,$upfile13,$upfile15,$upfile17,$upfile19);
	$mobileArr = Array($upfile02,$upfile04,$upfile06,$upfile08,$upfile10,$upfile12,$upfile14,$upfile16,$upfile18,$upfile20);
	$sTimeArr = Array($sTime01,$sTime02,$sTime03,$sTime04,$sTime05,$sTime06,$sTime07,$sTime08,$sTime09,$sTime10);
	$eTimeArr = Array($eTime01,$eTime02,$eTime03,$eTime04,$eTime05,$eTime06,$eTime07,$eTime08,$eTime09,$eTime10);

	$nTime = mktime();

	$mCnt = 0;

	for($i=0; $i<count($pcArr); $i++){
		$link = $linkArr[$i];
		$target = $targetArr[$i];
		$pimg = $pcArr[$i];

		$sTime = $sTimeArr[$i];
		$eTime = $eTimeArr[$i];

		//노출여부
		$sTimeChk = false;
		$eTimeChk = false;

		if($sTime == 0 || $sTime <= $nTime)	$sTimeChk = true;
		if($eTime == 0 || $eTime >= $nTime)	$eTimeChk = true;



		if($pimg && $sTimeChk && $eTimeChk){
?>
		<?if($link){?>
		<div><a href="<?=$link?>" target="<?=$target?>"><img src="./upfile/main/<?=$pimg?>" alt="메인이미지<?=$mCnt?>"></a></div>
		<?}else{?>
		<div><img src="./upfile/main/<?=$pimg?>" alt="메인이미지<?=$mCnt?>"></div>
		<?}?>
<?
			$mCnt++;
		}
	}
?>
	</div>
</div>
<script>
$(function(){
	 $('#main2').bxSlider({
		mode:'fade',
		controls:true,
		auto: true,
		pager:true,
		speed :1500,
		touchEnabled : (navigator.maxTouchPoints > 0),
		onSliderLoad: function(){
			$(".main2_wrap").css("visibility", "visible").animate({opacity:1});
		}
	});
});
</script>
