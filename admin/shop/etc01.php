<?
	include "../header.php";


	$cade02 = '촬영한복';

	if(!$type)	$type = 'list';

	$path = '../../upfile/';

	//이미지크기
	$size01 = 356;
	$size02 = 500;

?>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td style='padding:10px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='1150'>
				<tr>
					<td>


			<?

				switch($type){
									case 'write' :
									case 'edit' :
														include 'write.php';
														break;
														
									case 'list' :
														include 'etc_list.php';
														break;
				}

			?>



					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>