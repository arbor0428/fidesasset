<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "where cade02 like '%$cade02%'";


	if($f_title)	$query_ment .= " and title like '%$f_title%'";

	if($f_enable01 && !$f_enable02)	$query_ment .= " and enable='1'";
	if(!$f_enable01 && $f_enable02)	$query_ment .= " and enable=''";

	if($cade02 == '촬영한복')			$sort_ment = "order by esort01 desc, uid desc";
	elseif($cade02 == '혼주한복')	$sort_ment = "order by esort02 desc, uid desc";
	elseif($cade02 == '친인척한복')	$sort_ment = "order by esort03 desc, uid desc";
	elseif($cade02 == '잔치한복')	$sort_ment = "order by esort04 desc, uid desc";



	$query = "select * from ks_product $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from ks_product $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);





	$priceTitle = '대여료';
?>

<script language='javascript'>
function All_del(){

    var chk = document.getElementsByName('chk[]');
	var isChk = false;

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked)	isChk = true; 
    }

	if(!isChk){
		alert('삭제하실 상품을 선택하여 주십시오.');
		return;
	}

	if(confirm('선택하신 상품을 삭제하시겠습니까?')){

		form = document.frm01;

		form.type.value = 'all_del'
		form.action = 'proc.php';
		form.submit();

	}

}

function go_modify(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function go_sort(uid,mode){
	form = document.frm01;
	form.type.value = mode;
	form.uid.value = uid;
	form.target = 'ifra_status';
	form.action = 'setSortEtc.php';
	form.submit();
}

function ifra_xls(){
	form = document.frm01;
//	form.target = 'ifra_xls';
	form.action = 'excel_etc.php';
	form.submit();
}
</script>

<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>

<input type='hidden' name='cade01' value='<?=$cade01?>'>
<input type='hidden' name='cade02' value='<?=$cade02?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
		<?
			include 'search.php';
		?>
		</td>
	</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style='margin-top:10px;'>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td width='30%'><a href="javascript:All_chk_btn('all_chk','chk[]')"><img src='/images/common/allselect.gif' align='absmiddle'></a> <a href="javascript:All_del()"><img src='/images/common/alldelete.gif' align='absmiddle'></a></td>
					<td width='40%' align='center'>
						<a href="javascript:openCenterWin('sort.php?cade01=<?=$cade02?>','spop','800','700','1','1');" class='super cbtn blue'>상품정렬</a>&nbsp;&nbsp;
						<a href="javascript:ifra_xls();" class='super cbtn green'>EP저장</a>
					</td>
					<td width='30%'></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>						
		<td style='padding:5px 0 0 0;'>
			<table width="100%" border="0" cellspacing="0" cellpadding="3">
				<tr> 
					<td bgcolor="cccccc"  height="2" style='padding:2px 0px 0px 0px;' colspan="9"></td>
				</tr>
				<tr bgcolor="676767" align='center'>
					<td width="5%"><input name='all_chk' type='checkbox' onclick="All_chk('all_chk','chk[]');"></td>
					<td width="5%" class='w'>번호</td>
					<td width="15%" class='w'>이미지</td>
					<td width="25%" class='w'>상품명</td>
					<td width="10%" class='w'>상태</td>
					<td width="10%" class='w'>메인표시</td>
					<td width="10%" class='w'>세일전가격</td>
					<td width="10%" class='w'><?=$priceTitle?></td>
					<td width="10%" class='w'>출력순서</td>
				</tr>
				<tr> 
					<td bgcolor="cccccc"  height="1" style='padding:1px 0px 0px 0px;' colspan="9"></td>
				</tr>



<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$cade02 = $row["cade02"];
		$enable = $row["enable"];		//상태
		$main = $row["main"];			//메인표시
		$upfile01 = $row["upfile01"];	//이미지
		$title = $row["title"];				//상품명
		$oprice = $row["oprice"];		//세일전가격
		$price = $row["price"];			//판매가격

		if($cade02){
			$cade02 = eregi_replace(",", "<br>", $cade02);
			$cade02Txt = "<font color='#de712e'><b>".$cade02."</b></font><br>";
		}else{
			$cade02Txt = '';
		}

		if($enable)	$enableTxt = "<font color='#de712e'>판매중지</font>";
		else			$enableTxt = "판매중";

		if($main)		$mainTxt = "<font color='#049900'>MAIN</font>";
		else			$mainTxt = '';

		$imgTag = '';

		if($upfile01){
			$imgFile = $path.'thumb_'.$upfile01;
			if(!is_file($imgFile))	$imgFile = $path.$upfile01;
			$resize = Util::AutoImgSize($imgFile,120,146);
			$imgTag = "<img src='$imgFile' $resize>";
		}

		if($oprice)	$opriceTxt = number_format($oprice).'원';
		else			$opriceTxt = '';

		$priceTxt = number_format($price).'원';
?>
				<tr title='<?=$title?>' style="cursor:hand;" align='center' height='30' onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'"> 
					<td><input name='chk[]' type='checkbox' value='<?=$uid?>'></td>
					<td onclick="go_modify('<?=$uid?>')"><?=$i?></td>
					<td onclick="go_modify('<?=$uid?>')"><?=$imgTag?></td>
					<td onclick="go_modify('<?=$uid?>')"><?=$cade02Txt?><?=$title?></td>
					<td onclick="go_modify('<?=$uid?>')"><?=$enableTxt?></td>
					<td onclick="go_modify('<?=$uid?>')"><?=$mainTxt?></td>
					<td onclick="go_modify('<?=$uid?>')"><?=$opriceTxt?></td>
					<td onclick="go_modify('<?=$uid?>')" class='ks_red'><?=$priceTxt?></td>
					<td>
					<?
						if($total_record > $i){
					?>
						<a href="javascript:go_sort('<?=$uid?>','up');"><img src='/images/a_up.gif'></a>
					<?
						}

						if($i > 1){
					?>
						<a href="javascript:go_sort('<?=$uid?>','down');"><img src='/images/a_down.gif'></a>
					<?
						}
					?>
					</td>
				</tr>
				<tr> 
					<td bgcolor="cccccc"  height="1" style='padding:1px 0px 0px 0px;' colspan="9"></td>
				</tr>
<?
		$i--;
	}
}else{
?>
				<tr> 
					<td colspan="9" align='center' height='50'>등록된 상품이 없습니다</td>
				</tr>
<?
}
?>
			</table>									
		</td>
	</tr>
</table>





</form>




<?
	$fName = 'frm01';
	include '../../module/pageNum.php';
?>









<iframe name='ifra_status' src='about:blank' width='0' height='0' frameborder='0' scrolling='no'></iframe>