<?
	include "../header.php";

	$cArr = Array('여성한복','남성한복','커플한복','촬영한복','혼주한복','여아한복','남아한복','친인척한복','잔치한복','털배자(조끼)','장신구','여아한복(판매)','남아한복(판매)','장신구(판매)');

	if(!$cade01)	$cade01 = '여성한복';


	
	if($cade01 == '촬영한복')			$sort_ment = "order by esort01 desc, uid desc";
	elseif($cade01 == '혼주한복')	$sort_ment = "order by esort02 desc, uid desc";
	elseif($cade01 == '친인척한복')	$sort_ment = "order by esort03 desc, uid desc";
	elseif($cade01 == '잔치한복')	$sort_ment = "order by esort04 desc, uid desc";
	else										$sort_ment = '';

	if($sort_ment)	$query_ment = "where cade02 like '%$cade01%'";
	else{
		$query_ment = "where cade01='$cade01'";
		$sort_ment = "order by msort desc, uid desc";
	}

	$sql = "select * from ks_product $query_ment $sort_ment";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
?>

<title>황후나비 상품정렬</title>

<script src="/module/js/jquery-1.11.3.min.js" type="text/javascript"></script>

<style type='text/css'>
#selc, #selc option{
	font-size:14px;
	padding:5px 10px;
}

#sel, #sel option{
	font-size:14px;
	padding:5px 10px;
}
</style>

<script language='javascript'>
function saveSort(){
	form = document.frm01;
	plist = '';

    slist = form.sort_list;
	
	for (i=0; i<slist.length; i++){
		plist += slist[i].value+"|+|";
	}	

	form.pro_list.value = plist;

	form.type.value = 'sort';
	form.action = 'sortProc.php';
	form.submit();
}


function setCade01(){
	form = document.frm01;
	form.type.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

</script>




<form name='frm01' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value=''>
<input type='hidden' name='pro_list' value=''>
<input type='text' style='display:none;'>




<table cellpadding='10' cellspacing='0' border='0' width='100%'>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr>
					<th width='20%'>상품분류</th>
					<td width='80%'>
						<select name='cade01' id='selc' onchange='setCade01();'>
						<?
							for($i=0; $i<count($cArr); $i++){
								$cTxt = $cArr[$i];
								if($cTxt == $cade01)	$chk = 'selected';
								else							$chk = '';

								echo ("<option value='$cTxt' $chk style='font-size:14px;padding:5px 10px;'>$cTxt</option>");
							}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<th>출력순서</th>
					<td>
					<?
						if($num == 0){
							echo ("등록된 상품이 없습니다");
						}else{
					?>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
								<?
									if($num > 20)	$sel_size = 20;
									else				$sel_size = $num;;
								?>

									<select name="sort_list" size='<?=$sel_size?>' id='sel'>

								<?

									for($i=0; $i<$num; $i++){
										$no = $num - $i;
										$row = mysql_fetch_array($result);
										$uid = $row['uid'];
										$title = $row['title'];

										echo ("<option value='$uid'>$no : $title</option>");
									}
								?>

									</select>
								</td>
								<td style='padding:0 0 0 10px;'>
									<table cellpadding='0' cellspacing='0' border='0'>
										<tr>
											<td>
												<a href='#' class='small cbtn blue' id='sel_first' style='width:70px;'>첫번째로<br>이동</a>
												<a href='#' class='small cbtn blue' id='sel_up' style='width:50px;margin:0 0 0 5px;'>한단계<br>위로</a>
											</td>
										</tr>
										<tr>
											<td style='padding:5px 0 0 0;'>
												<a href='#' class='small cbtn blood' id='sel_last' style='width:70px;'>마지막으로<br>이동</a>
												<a href='#' class='small cbtn blood' id='sel_down' style='width:50px;margin:0 0 0 5px;'>한단계<br>아래로</a>
											</td>
										</tr>
									</table>

								</td>
								<td style='padding:0 0 0 10px;'><a href="javascript:saveSort();" class='sbig cbtn black'>순서저장</a></td>
							</tr>
						</table>
					<?
						}
					?>
					</td>
				</tr>
			</table>







		</td>
	</tr>
</table>


</form>





<script>
$("#sel_first").click(function() {
    var opt = $("#sel option:selected");
    if(opt.size() > 0) {
        opt.insertBefore($("#sel option:first"));
    }else{
		alert('상품을 선택해 주시기 바랍니다');
		return;
    }
});
$("#sel_up").click(function() {
    var opt = $("#sel option:selected");
    if(opt.size() > 0) {
        opt.insertBefore(opt.prev());
    }else{
		alert('상품을 선택해 주시기 바랍니다');
		return;
	}
});
$("#sel_down").click(function() {
    var opt = $("#sel option:selected");
    if(opt.size() > 0) {
        opt.insertAfter(opt.next());
    }else{
		alert('상품을 선택해 주시기 바랍니다');
		return;
    }
});
$("#sel_last").click(function() {
    var opt = $("#sel option:selected");
    if(opt.size() > 0) {
         opt.insertAfter($("#sel option:last"));
    }else{
		alert('상품을 선택해 주시기 바랍니다');
		return;
    }
});
</script>