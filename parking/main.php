<?
	if($GBL_MTYPE != 'A'){
		$gblArr = Util::ManagerType($GBL_MTYPE);

		$adminBlock = true;


		if(in_array('R',$gblArr)){
			$adminBlock = false;
		}

		if($adminBlock){
//			Msg::goMsg('접근오류','/');
//			exit;
		}
	}
?>
<link type='text/css' rel='stylesheet' href='/css/admin.css'>

<table cellpadding='0' cellspacing='0' border='0' width='100%' height='100%'>
	<tr>
		<td colspan='2' height='64' style="background:url('/admin/img/top_bg.gif') repeat-x;">
			<table cellpadding='0' cellspacing='0' border='0' width='100%' align='center'>
				<tr>
					<td width='200' align='center'><a href='/' onfocus='this.blur();' class="top_m" target='_top'>[홈페이지 바로가기]</a></td>
					<td align='right'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td align='center' style='padding:0 20 0 20;'><img src="./img/top_line.jpg" border="0"></td>
								<td><a href='/parking/' target='ifra' onfocus='this.blur();' class="top_m">비밀번호 변경</a></td>
								<td align='center' style='padding:0 20 0 20;'><img src="./img/top_line.jpg" border="0"></td>
								<td><a href='/module/login/logout_proc.php' class="top_out" target='_top'>로그아웃</a></td>
								<td width='20'></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td width='200' valign='top'>
		<?
			$sNum01 = '2';
			$sNum02 = '1';
			include './include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
		<?
			include 'form.php';
		?>
		</td>
		<td></td>
	</tr>
</table>

<?
	include 'footer.php';
?>