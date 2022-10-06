<?
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

	$sql01 = "select * from ks_order $query_ment order by uid desc";
	$result01 = mysql_query($sql01);
	$num01 = mysql_num_rows($result01);

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
</script>

<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>

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
					<td bgcolor="8c8c8c"  height="1" colspan="6"></td>
				</tr>
				<tr> 
					<td width="12%" align='center' class='bbs' height='26'>주문일자</td>
					<td width="38%" align='center' class='bbs'>상품명</td>
					<td width="12%" align='center' class='bbs'>주문자</td>
					<td width="13%" align='center' class='bbs'>결제금액</td>
					<td width="13%" align='center' class='bbs'>배송현황</td>
					<td width="12%" align='center' class='bbs'>비고</td>
				</tr>
				<tr height="2">
					<td bgcolor="8d8d8d"></td>
					<td bgcolor="e86261" colspan="1"></td>
					<td bgcolor="8d8d8d" colspan="4"></td>
				</tr>


<?
if($num01 > 0){
	for($i=0; $i<$num01; $i++){
		$row = mysql_fetch_array($result01);
		$uid = $row["uid"];
		$userid = $row["userid"];
		$cart_idx = $row["cart_idx"];
		$oname = $row["oname"];
		$result_price = $row["result_price"];
		$status = $row["status"];
		$reg_date = $row["reg_date"];
		$reg_date_txt = date("Y-m-d",$reg_date);

		$resulttxt = number_format($result_price);

		//주문한 상품의수와 첫번째 상품명을 가져온다.
		$idx_list = explode(',',$cart_idx);
		$onum = count($idx_list);	//주문한 상품 종류의 수
		$pid = $idx_list[0];

		$sql02 = "select title,cade01,cade02 from ks_product where uid='$pid'";
		$result02 = mysql_query($sql02);
		$title = @mysql_result($result02,0,0);
		$cade01 = @mysql_result($result02,0,1);
		$cade02 = @mysql_result($result02,0,2);

		$act = '';

		if($cade01 == '농협안심한우')		$act = '/sub02/product.php';
		elseif($cade01 == '참목원')			$act = '/sub03/product.php';
		elseif($cade01 == '진성비프')		$act = '/sub04/product.php';
		elseif($cade01 == '돈육상품')		$act = '/sub05/product.php';
		elseif($cade01 == '가공품')			$act = '/sub06/product.php';
		elseif($cade01 == '돼지반마리')		$act = '/sub07/product.php';


		if($onum > 1){
			$onum -= 1;
			$title_txt = $title.'외 '.$onum.'건';
		}else{
			$title_txt = $title;
		}
?>
				<tr height='40'> 
					<td align='center'><?=$reg_date_txt?></td>
					<td class='bbs' style='padding-left:5px;'><a href="javascript:oview('<?=$uid?>');"  onFocus="this.blur()" ><?=$title_txt?></a></td>
					<td align='center'><?=$oname?></td>
					<td class='bbs04' align='center'><?=$resulttxt?> 원</td>
					<td class='bbs04' align='center'><?=$status?></td>
					<td align='center'><a href="javascript:oreview('<?=$pid?>','<?=$act?>','review');"  onFocus="this.blur()" ><img src="/images/btn/btn_review.gif" border='0' /></a>
					<!--
						<table border="0" cellspacing="3" cellpadding="0">
							<tr>
								<td><a href="javascript:oreview('<?=$pid?>','<?=$cade01?>','review');"  onFocus="this.blur()" ><img src="/images/btn/btn_review.gif" border='0' /></a></td>
							</tr>
							<tr>
								<td><a href="javascript:oreview('<?=$pid?>','<?=$cade01?>','');"  onFocus="this.blur()" ><img src="/images/btn/btn_reorder.gif" border='0' /></a></td>
							</tr>
						</table>
					-->
					</td>
				</tr>
				<tr>
					<td colspan="6" bgcolor="cccccc"  height="1"></td>
				</tr>
<?
	}
}else{
?>
				<tr>
					<td colspan='6' height='30' align='center'>주문내역이 없습니다</td>
				</tr>
<?
}
?>



				<tr>
					<td colspan="6" height="1" bgcolor="8c8c8c"></td>
				</tr>
				<tr>
					<td colspan="6" height="3" bgcolor="f5f5f5"></td>
				</tr>
			</table>

		</td>
	</tr>
</table>
<!-- 주문내역  END-->


</form>