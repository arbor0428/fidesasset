<?
	include "../header.php";

	$table_id = 'table_1641523301';

	if(!$type)	$type = 'list';

	//�Խ��� ȯ�漳��
	include $boardRoot."config.php";

?>
<div class="sub_visual sub_visual03 visual_wrap">
	<div class="text-box">��FAQ</div>
</div>
<div class='content_box'>
<?
	switch($type){
		case 'write' :
		case 'edit' :
							include $boardRoot.$write_file;
							break;

		case 'list' :
							include $boardRoot.'query.php';	//�Խ��� ���� ����
							include $boardRoot.$list_file;	//�Խ��� ����Ʈ
							include $boardRoot.'pageNum.php';	//�Խ��� ����Ʈ
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