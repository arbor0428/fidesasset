<?
	$mNum = '15';
	$sNum = '1';

	include '../header.php';

	$path = '../upfile/';	//상품이미지경로

	$G_Size01 = '120';	//이미지크기
	$G_Size02 = '150';	//이미지크기

?>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td align="center">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height='20'></td>
				</tr>

				<tr>
					<td>
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td height='40' style="background:url('../images/new/dot02.gif') repeat-x bottom;">
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td>
												<table cellpadding='0' cellspacing='0' border='0'>
													<tr height='40'>
														<td align="left" style="background:url('../images/new/dot01.gif') repeat-x bottom;"><font size="5" face="나눔고딕"><strong>장바구니</strong></font></td>
													</tr>
												</table>
											</td>
											<td align="right" valign="bottom"><a href="#">Home</a> > <strong>장바구니</strong></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td> 
				</tr>

				<tr>
					<td style='padding:20px 0px 0px 0px;'>
					<?
						include 'list2.php';
//						include 'list.php';
					?>
					</td>
				</tr>

			</table>
		</td>
	</tr>
</table>

<? include '../footer.php'; ?>