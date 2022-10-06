<? 

	$xls_name = 'EP자료('.$cade01.')_'.date('YmdHis');
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=$xls_name.xls"); 


	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';
	include '../../module/class/class.Msg.php';

	$flag = '대여';
	$ship = 6000;

	if($cade01 == '여성한복'){
		$path = '/sub02/sub01.php';
		$attribute = '사이즈:44~88^속치마,속바지,버선 무료';

	}elseif($cade01 == '남성한복'){
		$path = '/sub03/sub01.php';
		$attribute = '사이즈:28~42';

	}elseif($cade01 == '커플한복'){
		$path = '/sub04/sub01.php';
		$attribute = '사이즈(여):44~88^속치마,속바지,버선 무료^사이즈(남):28~42';

	}elseif($cade01 == '여아한복'){
		$path = '/sub02_1/sub01.php';
		$attribute = '백일:첫돌1호^첫돌:2세2호';

	}elseif($cade01 == '남아한복'){
		$path = '/sub03_1/sub01.php';
		$attribute = '백일:첫돌1호^첫돌:2세2호';

	}elseif($cade01 == '털배자(조끼)'){
		$path = '/sub11/sub01.php';
		$attribute = '사이즈:55,66,77,88';

	}elseif($cade01 == '장신구'){
		$path = '/sub05/sub01.php';
		$attribute = '';

	}elseif($cade01 == '여아한복(판매)'){
		$path = '/sub02_2/sub01.php';
		$attribute = '백일:첫돌1호^첫돌:2세2호';
		$flag = '판매';
		$ship = 0;

	}elseif($cade01 == '남아한복(판매)'){
		$path = '/sub03_2/sub01.php';
		$attribute = '백일:첫돌1호^첫돌:2세2호';
		$flag = '판매';
		$ship = 0;

	}elseif($cade01 == '장신구(판매)-아동'){
		$path = '/sub05_2/sub01.php';
		$attribute = '';
		$flag = '판매';
		$ship = 0;

	}else{
		$path = '';
	}

	if($path == ''){
		Msg::backMsg('접근오류');
		exit;
	}


	//쿼리조건
	$query_ment = "where cade01='$cade01'";

	if($f_c02a || $f_c02b || $f_c02c || $f_c02d){
		if($f_c02a)	$query_ment2 = "cade02 like '%$f_c02a%'";
		if($f_c02b){
			if($query_ment2)	$query_ment2 .= ' or ';
			$query_ment2 .= "cade02 like '%$f_c02b%'";
		}
		if($f_c02c){
			if($query_ment2)	$query_ment2 .= ' or ';
			$query_ment2 .= "cade02 like '%$f_c02c%'";
		}
		if($f_c02d){
			if($query_ment2)	$query_ment2 .= ' or ';
			$query_ment2 .= "cade02 like '%$f_c02d%'";
		}

		$query_ment .= " and (".$query_ment2.")";
	}


	if($f_title)	$query_ment .= " and title like '%$f_title%'";

	if($f_enable01 && !$f_enable02)	$query_ment .= " and enable='1'";
	if(!$f_enable01 && $f_enable02)	$query_ment .= " and enable=''";

	$sort_ment = "order by msort desc, uid desc";

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
	$upfile01 = $row["upfile01"];		//이미지
	$title = $row["title"];					//상품명
	$price = $row["price"];				//판매가격
	$reg_date = $row["reg_date"];

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
		<td style="font-size:12px;mso-number-format:'\@'"><?=$cade01?></td>
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