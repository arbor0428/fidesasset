<?
	include '../header.php';

	if(!$type)	$type = 'list';

	$ico01 = "<span class='eq'></span>";

	//감면구분
	$reductionArr = Array('국가유공자','장애인할인');

	//가입경로
	$joinTypeArr = Array('인터넷검색','지인추천');
?>



	<tr>
		<td width='200' valign='top'>
		<?
			$sNum01 = '3';
			$sNum02 = '2';

			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon' style=''>
		<div style='width:1200px;'>
		<?
			//제이쿼리 달력
			$sRange = '90';
			$eRange = '0';
			include '../../module/Calendar.php';
			
			include 'write2.php';
		?>
		</div>
		</td>
	</tr>
</table>


<?
	include '../footer.php';
?>