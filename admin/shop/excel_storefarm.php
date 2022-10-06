<?
	$xls_name = '스토어팜샘플('.$cade01.')_'.date('YmdHis');
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=$xls_name.xls"); 

	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';
	include '../../module/class/class.Msg.php';


	//쿼리조건
	$query_ment = "where cade01='$cade01'";

	$sort_ment = "order by msort desc, uid desc";

	$sql = "select * from ks_product $query_ment $sort_ment";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
?>


<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>

<table border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
	<tr align='center'>
		<td style="font-size:12px;background-color:f9f9f9;">상품명</td>
		<td style="font-size:12px;background-color:f9f9f9;">대표이미지파일명</td>
		<td style="font-size:12px;background-color:f9f9f9;">세일전가격</td>
		<td style="font-size:12px;background-color:f9f9f9;">상세설명</td>
	</tr>

<?
$cade01Txt = $cade01.' ';
$simg01 = "<img src='http://www.hwnvhanbok.co.kr/images/viewA_Top01.jpg'>";
$simg02 = "<img src='http://www.hwnvhanbok.co.kr/images/viewA_Foot01_20170330.jpg'>";
$simg03 = "<img src='http://www.hwnvhanbok.co.kr/images/viewA_Foot02_20170330.jpg'>";

for($i=0; $i<$num; $i++){
	$row = mysql_fetch_array($result);

	$title = $row["title"];					//상품명
	$oprice = $row["oprice"];			//세일전가격
	$ment = $row["ment"];

	$titleTxt = eregi_replace($cade01Txt, '', $title);

	$imgTitle = $titleTxt.'.jpg';

	$ment = eregi_replace('\"', "'", $ment);
	$ment = eregi_replace("http://www.hwnvhanbok.co.kr", "", $ment);
	$ment = eregi_replace("http://hwnvhanbok.co.kr", "", $ment);
	$ment = eregi_replace(" border='0'", "", $ment);
	$ment = eregi_replace(" border=0", "", $ment);
	$ment = eregi_replace("<br>", "", $ment);
	$ment = eregi_replace("<p>", "", $ment);
	$ment = eregi_replace("</p>", "", $ment);
	$ment = eregi_replace("<br style='clear: both;'>", "", $ment);
	$ment = eregi_replace("&nbsp;", "", $ment);
	$ment = eregi_replace("style='height: auto; max-width: 1000px;'", "style='height: auto; max-width: 860px;'", $ment);

	$ment = eregi_replace("src='/", "src='http://www.hwnvhanbok.co.kr/", $ment);

	if($cade01 != '장신구'){
		$ment = $simg01.'<br>'.$ment.'<br>'.$simg02.'<br>'.$simg03;
	}

	$mentDiv = "<div style='width:100%;text-align:center;'>".$ment."</div>";


	$mentTxt = htmlspecialchars($mentDiv);
?>
	<tr height='30' align='center'>
		<td style="font-size:12px;mso-number-format:'\@'"><?=$titleTxt?></td>
		<td style="font-size:12px;mso-number-format:'\@'"><?=$imgTitle?></td>
		<td style="font-size:12px;mso-number-format:'\@'"><?=$oprice?></td>
		<td style="font-size:12px;"><?=$mentTxt?></td>
	</tr>
<?
}
?>
</table>