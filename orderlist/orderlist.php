<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	if($GBL_USERID){
		if($GBL_MTYPE == 'A'){	//관리자인 경우 검색조건을 추가한다.
			if($f_word)	 $query_ment = "where $f_field like '%$f_word%'";
			else	$query_ment = '';
		}else{	//일반회원인 경우 본인의 주문내역만 가져온다.
			$query_ment = "where userid='$GBL_USERID'";
		}

	}else{
		//로그인을 하지 않은 경우 주문자이름과 핸드폰번호를 검색해서 가져온다.
		$query_ment = "where oname='$f_oname' and ohp1='$f_ohp1' and ohp2='$f_ohp2' and ohp3='$f_ohp3'";
	}


	$sort_ment = "order by uid desc";



	$query = "select * from ks_order $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from ks_order $query_ment $sort_ment limit $record_start, $record_count";
	$result = mysql_query($query2);

?>


<script language='javascript'>
function oview(uid){
	form = document.frm01;
	form.uid.value = uid;
	form.type.value = 'view';
	form.submit();
}

function osearch(){
	form = document.frm01;
	form.uid.value = '';
	form.type.value = 'list';
	form.submit();
}

function oreview(uid,act,review){
	form = document.frm01;
	form.uid.value = uid;
	form.type.value = 'view';
	form.action = act+'?review=write&#review_focus';
	form.submit();
}


function goShip(){
//	window.open('https://www.doortodoor.co.kr/parcel/pa_004.jsp');
	window.open('http://www.ilogen.com/d2d/delivery/invoice_search.jsp');
}
</script>

<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>

<!-- 비회원 주문검색용 -->
<input type='hidden' name='f_oname' value='<?=$f_oname?>'>
<input type='hidden' name='f_ohp1' value='<?=$f_ohp1?>'>
<input type='hidden' name='f_ohp2' value='<?=$f_ohp2?>'>
<input type='hidden' name='f_ohp3' value='<?=$f_ohp3?>'>
<!-- /비회원 주문검색용 -->



<!-- 관리자 주문검색용 -->
<?
	if($GBL_MTYPE == 'A'){
?>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td align='right'>
			<table cellpadding='0' cellspacing='0' border='0' >
				<tr>
					<td>
						<select name='f_field'>
							<option value='oname' <?if($f_field == 'oname'){echo 'selected';}?>>주문자</option>
							<option value='userid' <?if($f_field == 'userid'){echo 'selected';}?>>아이디</option>
						</select>
					</td>
					<td style='padding-left:5px;'><input type='text' name='f_word' style='width:100px;' value='<?=$f_word?>'></td>
					<td style='padding-left:5px;'><a href='javascript:osearch();'><img src="/images/common/search.gif" alt="검색"></a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?
	}
?>
<!-- /관리자 주문검색용 -->




<!-- 주문내역 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
	<tr>
		<td style="padding-top: 7;">

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td bgcolor="8c8c8c"  height="1" colspan="8"></td>
				</tr>
				<tr bgcolor='#f7f7f7'> 
					<td width="5%" align='center' class='bbs' height='26'>번호</td>
					<td width="15%" align='center' class='bbs'>이미지</td>
					<td width="27%" align='center' class='bbs'>상품명</td>
					<td width="15%" align='center' class='bbs'>주문자</td>
					<td width="10%" align='center' class='bbs'>결제금액</td>
					<td width="10%" align='center' class='bbs'>주문상태</td>
					<td width="10%" align='center' class='bbs'>송장번호</td>
					<td width="8%" align='center' class='bbs'>주문일시</td>
				</tr>
				<tr height="2">
					<td bgcolor="8d8d8d"></td>
					<td bgcolor="e86261" colspan="2"></td>
					<td bgcolor="8d8d8d" colspan="5"></td>
				</tr>


<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$userid = $row["userid"];
		$oname = $row["oname"];
		$amt = $row["amt"];
		$status = $row["status"];
		$ship_num = $row["ship_num"];
		$reg_date = $row["reg_date"];
		$reg_dateTxt = date("Y-m-d H:i:s",$reg_date);

		$sql01 = "select * from ks_order_list where userid='$userid' and code='$reg_date'";
		$result01 = mysql_query($sql01);
		$num01 = mysql_num_rows($result01);

		$imgTag = '';

		if($num01){
			$row01 = mysql_fetch_array($result01);
			$ptitle = $row01['ptitle'];
			$pid = $row01['pid'];

			if($num01 > 1){
				$num01 -= 1;
				$title_txt = $ptitle.'외 '.$num01.'건';
			}else{
				$title_txt = $ptitle;
			}

			//제품이미지 가져오기
			$sql02 = "select * from ks_product where uid='$pid'";
			$result02 = mysql_query($sql02);
			$row02 = mysql_fetch_array($result02);
			$upfile01 = $row02["upfile01"];	//이미지

			if($upfile01){
				$imgFile = $path.'thumb_'.$upfile01;
				if(!is_file($imgFile))	$imgFile = $path.$upfile01;
				$resize = Util::AutoImgSize($imgFile,120,146);
				$imgTag = "<img src='$imgFile' $resize>";
			}
		}

		if($userid == '_guest'){
			$css = "style='color:#de712e;'";
			$useridTxt = '(비회원)';
		}else{
			$css = "style='color:#52809a;'";
			$useridTxt = '('.$userid.')';
		}

		$amtTxt = number_format($amt);
?>
				<tr height='40'> 
					<td align='center'><?=$i?></td>
					<td align='center' style='padding:5px 0px 5px 0px;'><a href="javascript:oview('<?=$uid?>');"  onFocus="this.blur()" ><?=$imgTag?></a></td>
					<td class='bbs' style='padding-left:5px;'><a href="javascript:oview('<?=$uid?>');"  onFocus="this.blur()" ><?=$title_txt?></a></td>
					<td align='center'><?=$oname?></td>
					<td class='bbs04' align='center'><?=$amtTxt?> 원</td>
					<td align='center'><?=$status?></td>
					<td align='center'>
					<?
						if($ship_num){
					?>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td align='center'><?=$ship_num?></td>
							</tr>
							<tr>
								<td align='center'><input type='button' name='sbtn' value='배송조회' onclick='goShip();' style='cursor:hand;'></td>
							</tr>
						</table>
					<?
						}else{
							echo '-';
						}
					?>
					</td>
					<td align='center'><?=$reg_dateTxt?></td>
				</tr>
				<tr>
					<td colspan="8" bgcolor="cccccc"  height="1" style='padding:1px 0px 0px 0px;'></td>
				</tr>
<?
		$line_num++;
		$i--;
	}

}else{
?>
				<tr> 
					<td colspan="8" align='center' height='50'>접수된 주문내역이 없습니다</td>
				</tr>
<?
}
?>



				<tr>
					<td colspan="8" height="1" bgcolor="8c8c8c" style='padding:1px 0px 0px 0px;'></td>
				</tr>
				<tr>
					<td colspan="8" height="3" bgcolor="f5f5f5"></td>
				</tr>
			</table>

		</td>
	</tr>
</table>
<!-- 주문내역  END-->


</form>

<?
	$fName = 'frm01';
	include '../module/pageNum.php';
?>