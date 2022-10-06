<?
	include "../header.php";
	$topTxt01='공지사항';

	$table_id = 'table_1641523274';

	if(!$type)	$type = 'list';

	//게시판 환경설정
	include $boardRoot."config.php";
?>

<!-------------------로케이션 바--------------------->
<?
	include 'location.php';
?>

<!----------------중간영역--------------------------->



<div class="sub_cont04">
	<div class="sub_center">
		<div class="cont_tit">
			<div class="tit_line02"><!--line--></div>
			<h3>공지사항</h3>
		</div>
		<?
	switch($type){
		case 'write' :
		case 'edit' :
							include $boardRoot.$write_file;
							break;

		case 'list' :
							include $boardRoot.'query.php';	//게시판 내용 쿼리
							include $boardRoot.$list_file;	//게시판 리스트
							include $boardRoot.'pageNum.php';	//게시판 리스트
							break;

		case 'view' :
							include $boardRoot.$view_file;
							break;

		case 're_write' :
		case 're_edit' :
							include $boardRoot.'re_write.php';
							break;

		case 're_view' :
							include $boardRoot.'re_view.php';
							break;
	}
?>
	</div>
</div>

<style>
	.cont_tit .tit_line02 {	
		width: 190px;
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
			width: 140px;
			bottom: 10px;
		}
</style>

<?
	include "../footer.php";
?>