<?
	include'../header.php';

	$side_menu=1;
	$side_menu2=1;

	$table_id = 'table_1512604386';

	if(!$type)	$type = 'list';

	//게시판 환경설정
	include $boardRoot."config.php";

?>

<div class='subimg subimg5'>
대관안내
</div>

<div class='topBox'>
	<div style="float:left;padding:0 20px;font-size:15px;">홈</div>
	<div style="border-left:1px solid #e4e4e4;float:left;padding:0 20px;font-size:15px;">대관안내</div>
	<div class="topTitle">
		공간안내
		<div style="font-size:12px;color:#8a8a8a;float:right;">▼</div>
	</div>
</div>


<div style='width:1100px;margin:0 auto;'>
	<div style='width:190px;float:left;padding-top:50px;box-sizing:border-box;;'>
		<div style='font-size:28px;margin-bottom:15px;'>
			대관안내
		</div>
		<?
			include'./sidemenu.php';
		?>
	</div>
	<div class='box_R'>
		<div class='titlebox2'>
			<p class='subtitle2'>공연장</p>
			<img src='/images/sub/sub_cloud.png'>
		</div>
		<div class='box_content'>
			<?
			//리스트 페이지에서만 설명문구 표시
			if($type == 'list'){
				include './notice01.php';
			}

			switch($type){
				case 'write' :
				case 'edit' :
									include $boardRoot.$write_file;
									break;

				case 'list' :
									include $boardRoot.'query.php';	//게시판 내용 쿼리
									include $boardRoot.$list_file;	//게시판 리스트
									include $boardRoot.'pageNum.php';	//게시판 페이지번호
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
</div>
<?include'../footer.php';?>



