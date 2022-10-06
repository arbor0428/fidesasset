<?
	include '../../module/class/class.DbCon.php';

	//검색기간
	$f_sArr = explode('-',$f_rDate01);
	$start_date = mktime(0,0,0,$f_sArr[1],$f_sArr[2],$f_sArr[0]);
	$f_eArr = explode('-',$f_rDate02);
	$end_date = mktime(23,59,59,$f_eArr[1],$f_eArr[2],$f_eArr[0]);

	//쿼리조건
	$query_ment = " where rTime>='$start_date' and rTime<='$end_date'";

	if($f_code)		$query_ment .= " and code like '%$f_code%'";
	if($f_name)		$query_ment .= " and name like '%$f_name%'";
	if($f_guest)		$query_ment .= " and guest like '%$f_guest%'";
	if($f_carNum)	$query_ment .= " and carNum like '%$f_carNum%'";

	$sort_ment = "order by uid desc";



	$query = "select * from ks_ticket $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);


	$agent = $_SERVER['HTTP_USER_AGENT'];


	$file_name = '면제권내역('.date('YmdHis').')';

	//사파리
	if(preg_match('/Safari/i',$agent)){
		$file_name = iconv('euc-kr','utf-8',$file_name);
	}

	header( "Content-type: application/vnd.ms-excel; charset=euc-kr" );
	header("Content-Disposition: attachment; filename=$file_name.xls"); 
?>






<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>


<style>
br{mso-data-placement:same-cell;}
</style>


<table cellpadding='0' cellspacing='0' border='1'>
	<tr align='center' height='30'>
		<th bgcolor='eeeeee'>일련번호</th>
		<th bgcolor='eeeeee'>방문자</th>
		<th bgcolor='eeeeee'>차량번호</th>
		<th bgcolor='eeeeee'>사유</th>
		<th bgcolor='eeeeee'>등록자</th>
		<th bgcolor='eeeeee'>등록일시</th>
	</tr>

<?
if($total_record != '0'){
	$i = $total_record;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$code = $row['code'];
		$name = $row["name"];
		$guest = $row['guest'];
		$carNum = $row['carNum'];
		$ment = $row['ment'];
		$rDate = $row['rDate'];
?>


	<tr align='center' height='30'>
		<td><b><?=$code?></b></td>
		<td><?=$guest?></td>
		<td><?=$carNum?></td>
		<td><?=$ment?></td>
		<td><?=$name?></td>
		<td><?=$rDate?></td>
	</tr>
<?
		$i--;
	}
}?>

</table>