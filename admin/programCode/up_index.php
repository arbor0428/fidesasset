<?
	include '../header.php';

	$month = date('n');

	if(!$season){
		if($month == 3 || $month == 4 || $month == 5)				$season = '봄';
		elseif($month == 6 || $month == 7 || $month == 8)		$season = '여름';
		elseif($month == 9 || $month == 10 || $month == 11)	$season = '가을';
		elseif($month == 12 || $month == 1 || $month == 2)		$season = '겨울';
	}

?>


	<tr>
		<td width='200' valign='top'>
		<?
			$sNum01 = '3';
			$sNum02 = '1';
			
			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
			<form name='frm01' action="<?=$PHP_SELF?>" method='post'>
			<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
			<input type='hidden' name='type' value=''>

			<table cellpadding='0' cellspacing='0' border='0' width='1000'>
				<tr>
					<td>
					<?
						include 'write.php';
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