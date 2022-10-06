<? 
	$xls_name = 'EP자료('.$cade02.')_'.date('YmdHis');
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=$xls_name.xls"); 

	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';
	include '../../module/class/class.Msg.php';


	$flag = '대여';
	$ship = 6000;


	//쿼리조건
	$query_ment = "where cade02 like '%$cade02%'";


	if($f_title)	$query_ment .= " and title like '%$f_title%'";

	if($f_enable01 && !$f_enable02)	$query_ment .= " and enable='1'";
	if(!$f_enable01 && $f_enable02)	$query_ment .= " and enable=''";

	if($cade02 == '촬영한복')			$sort_ment = "order by esort01 desc, uid desc";
	elseif($cade02 == '혼주한복')	$sort_ment = "order by esort02 desc, uid desc";
	elseif($cade02 == '친인척한복')	$sort_ment = "order by esort03 desc, uid desc";
	elseif($cade02 == '잔치한복')	$sort_ment = "order by esort04 desc, uid desc";

	$sql = "select * from ks_product $query_ment $sort_ment";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
?>


<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>

<table border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
	<tr align='center'>
		<td style="font-size:12px;background-color:f9f9f9;">id</td>
		<td style="font-size:12px;background-color:f9f9f9;">title</td>
		<td style="font-size:12px;background-color:f9f9f9;">price_pc</td>
		<td style="font-size:12px;background-color:f9f9f9;">link</td>
		<td style="font-size:12px;background-color:f9f9f9;">image_link</td>
		<td style="font-size:12px;background-color:f9f9f9;">category_name1</td>
		<td style="font-size:12px;background-color:f9f9f9;">shipping</td>
		<td style="font-size:12px;background-color:f9f9f9;">class</td>
		<td style="font-size:12px;background-color:f9f9f9;">update_time</td>
		<td style="font-size:12px;background-color:f9f9f9;">product_flag</td>
		<td style="font-size:12px;background-color:f9f9f9;">attribute</td>
	</tr>

<?
for($i=0; $i<$num; $i++){
	$row = mysql_fetch_array($result);

	$uid = $row["uid"];
	$cade01 = $row["cade01"];
	$upfile01 = $row["upfile01"];		//이미지
	$title = $row["title"];					//상품명
	$price = $row["price"];				//판매가격
	$reg_date = $row["reg_date"];
	$attribute = '';

	if($cade01 == '여성한복'){
		$path = "/sub02/sub01.php";
		$attribute = '사이즈:44~88^속치마,속바지,버선 무료';

	}elseif($cade01 == '남성한복'){
		$path = "/sub03/sub01.php";
		$attribute = '사이즈:28~42';

	}elseif($cade01 == '커플한복'){
		$path = "/sub04/sub01.php";
		$attribute = '사이즈(여):44~88^속치마,속바지,버선 무료^사이즈(남):28~42';

	}

	$purl = 'http://'.$_SERVER['HTTP_HOST'].$path.'?type=view&uid='.$uid;
	$imgurl = 'http://www.hwnvhanbok.co.kr/upfile/'.$upfile01;
	$reg_dateTxt = date('Y-m-d H:i:s',$reg_date);

?>
	<tr height='30' align='center'>
		<td style="font-size:12px;mso-number-format:'\@'"><?=$uid?></td>
		<td style="font-size:12px;mso-number-format:'\@'"><?=$title?></td>
		<td style="font-size:12px;mso-number-format:'\@'"><?=$price?></td>
		<td style="font-size:12px;mso-number-format:'\@'"><?=$purl?></td>
		<td style="font-size:12px;mso-number-format:'\@'"><?=$imgurl?></td>
		<td style="font-size:12px;mso-number-format:'\@'"><?=$cade02?></td>
		<td style="font-size:12px;mso-number-format:'\@'"><?=$ship?></td>
		<td style="font-size:12px;mso-number-format:'\@'">I</td>
		<td style="font-size:12px;mso-number-format:'\@'"><?=$reg_dateTxt?></td>
		<td style="font-size:12px;mso-number-format:'\@'"><?=$flag?></td>
		<td style="font-size:12px;mso-number-format:'\@'"><?=$attribute?></td>
	</tr>
<?
}
?>
</table>