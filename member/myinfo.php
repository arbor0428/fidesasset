<?
	include'../header.php';

	$side_menu=1;

	if($GBL_USERID == ''){
		Msg::backMsg('접근오류');
		exit;

	}elseif($GBL_MTYPE != 'C'){
		Msg::backMsg('일반회원만 이용할 수 있습니다.');
		exit;
	}
?>

<div class="sub_visual sub_visual02 visual_wrap">
	<div class="text-box">정보수정</div>
</div>

<div class='content_box' style='width:1100px;'>
	<div class='box_R'>

		<div class='box_content'>
			<div class="ggform">
				<?
					$type='edit';

					//제이쿼리 달력
					$sRange = '90';
					$eRange = '0';
					include '../module/Calendar.php';

					include 'JoinStep3.php';
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