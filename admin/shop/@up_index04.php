<?
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";
	include "../../module/class/class.Msg.php";


	$cade01 = '혼주한복';

	if(!$type)	$type = 'list';

	$path = '../../upfile/';

	//이미지크기
	$size01 = 400;
	$size02 = 500;

?>

<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<script language='javascript' src='/module/js/common.js'></script>
<link type='text/css' rel='stylesheet' href='/css/style.css'>

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
														include 'list.php';
														break;
				}

			?>



					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>