<?
	include '../header.php';
?>



	<tr>
		<td width='200' valign='top'>
		<?
			if(!$type)	$type = 'list';

			if($type == 'write'){
				$sNum01 = '1';
				$sNum02 = '1';
			}else{
				$sNum01 = '1';
				$sNum02 = '2';
			}

			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
			<table cellpadding='0' cellspacing='0' border='0' width='1000'>
				<tr>
					<td>
					<?
						if($type == 'list')			include 'list.php';
						elseif($type == 'view')	include 'view.php';
						elseif($type == 'edit')	include 'write.php';
						elseif($type == 'write')	include 'write.php';
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