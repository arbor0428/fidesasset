<?
	include "../header.php";

	$table_id = 'table_1641523301';

	if(!$type)	$type = 'list';

	//게시판 환경설정
	include $boardRoot."config.php";

?>
<div class="sub_visual sub_visual03 visual_wrap">
	<div class="text-box">고객FAQ</div>
</div>
<div class='content_box'>
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

<?
	include "../footer.php";
?>