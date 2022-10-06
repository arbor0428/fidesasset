<?
	include '../header.php';

	if(!$type)	$type = 'list';
	

	$path = '../../upfile/shop/';

	//이미지크기
	$size01 = 400;
	$size02 = 500;
?>

	<tr>
		<td width='200' valign='top' class='mCon'>
		<?
			$sNum01 = '4';
			$sNum02 = '3';

			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
			<table cellpadding='0' cellspacing='0' border='0' width='1200'>
				<tr>
					<td>
					<?

						if($type == 'list')			include 'list.php';
						elseif($type == 'write')	include 'write.php';
						elseif($type == 'edit')	include 'write.php';
					?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>


<?
	include '../footer.php';
?>