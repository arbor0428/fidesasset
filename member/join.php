<?
	include'../header.php';

	$side_menu=1;
?>

<div class="sub_visual sub_visual02 visual_wrap">
	<div class="text-box">회원가입</div>
</div>

<div class='content_box' style='width:1100px;'>
	<div class='box_R'>

		<div class='box_content'>
			<div class="ggform">
				<?
					if(!$step)	$step = '1';

					//제이쿼리 달력
					$sRange = '90';
					$eRange = '0';
					include '../module/Calendar.php';

					if($step == '1')		include 'JoinStep1.php';
					elseif($step == '2')	include 'JoinStep2.php';
					elseif($step == '3')	include 'JoinStep3.php';
				?>
			</div>
		</div>
	</div>
</div>

<?include'../footer.php';?>


<style>
.policytitle {font-size:20px;color:#444444;margin-top:20px;font-weight:500;}
.policycontent {font-size:17px;color:#444444;line-height:1.8;margin-top:20px;}
.title_inner{font-size:14px;font-weight:normal;letter-spacing:1.5;margin-left:10px;color:#fa86bd;}
</style>