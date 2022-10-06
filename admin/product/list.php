<?
	if(!$f_record)	$f_record = 30;
	
	$record_count = $f_record;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = " where uid>0";

	//회원자명
	if($f_title)	$query_ment .= " and title like '%$f_title%'";
	if($f_cade01)	$query_ment .= " and cade01 ='$f_cade01'";



	//정렬방식
	$sort_ment = "order by uid desc";

	$query = "select * from ks_medicine $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from ks_medicine $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);


?>

<script language='javascript'>
function cwrite(){
	form = document.frm01;
	form.type.value = 'write';
	form.target = '';
	form.action = 'up_index.php';
	form.submit();
}

function cedit(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.target = '';
	form.action = 'up_index.php';
	form.submit();
}

function ifra_xls(){
	form = document.frm01;
	form.type.value = '';
	form.target = '';
	form.action = 'excel.php';
	form.submit();
}

function statusChk(uid){
	$.post('json_status.php',{'uid':uid}, function(c){
		if(c == '1')	$('#on'+uid).html("<span class='ico04'>승인</span>");
		else			$('#on'+uid).html("<span class='ico07'>미승인</span>");
	});
}

function classList(userid){
	document.getElementById("multiFrame").innerHTML = "<iframe src='about:blank' id='ifra_mlist' name='ifra_mlist' width='900' height='700' frameborder='0' scrolling='auto'></iframe>";

	form = document.FRM;
	
	form.userid.value = userid;

	form.target = 'ifra_mlist';
	form.action = '../classOrder/classList.php';
	form.submit();

	$(".multiBox_open").click();
}

function smsPhone(){
    var chk = document.getElementsByName('chk[]');
	var isChk = false;

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked)	isChk = true; 
    }

	if(!isChk){
		GblMsgBox('문자를 발송할 회원을 선택해 주십시오.','');
		return;
	}

	document.getElementById("multiFrame").innerHTML = "<iframe src='about:blank' id='ifra_slist' class='bgtp' name='ifra_slist' width='260' height='530' frameborder='0' scrolling='auto'></iframe>";

	form = document.frm01;

	form.target = 'ifra_slist';
	form.action = '/module/smsPhone.php';
	form.submit();

	$(".multiBox_open").click();

	$('.bgtp').parents('.popup_background').css({'background':'transparent'})
}
</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='userid' value=''>
</form>




<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='smsID' value='<?=$GBL_USERID?>'>

<?
	include 'search.php';
?>

<div style='margin:10px 0;float:left;'>
	<a href="javascript:cwrite();" class="super cbtn blue">제품등록</a>
<!--
	<a href="javascript:smsPhone();" class="super cbtn blood">문자보내기</a>
-->
	
</div>
<?
	if($total_record1){
?>
<div style='margin:10px 0;float:right;'>
	<a href="javascript:ifra_xls();" class="super cbtn green">엑셀변환</a>
</div>
<?
	}
?>



<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix'>
	<thead>
		<tr>
			<th width='50'>
				<div class="sChkBox">
					<input type="checkbox" value="" id="sL0" name="all_chk" onclick="All_chk('all_chk','chk[]');">
					<label for="sL0"></label>
				</div>
			</th>
			<th width='100'>번호</th>
			<th width='150'>구분</th>
			<th width='150'>제품이미지</th>
			<th>제품명</th>
			<th width='150'>보험코드</th>
			<th width='150'>보험약가</th>
		</tr>
	</thead>

<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$title = $row["title"];
		$cade01 = $row["cade01"];
		$cade02 = $row["cade02"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$data04 = $row["data04"];
		$data05 = $row["data05"];
		$data06 = $row["data06"];
		$data07 = $row["data07"];
		$data08 = $row["data08"];
		$data09 = $row["data09"];
		$upfile01 = $row["upfile01"];
		$realfile01 = $row["realfile01"];
		$upfile02 = $row["upfile02"];
		$realfile02 = $row["realfile02"];

		//비고
		if($data04)	$memo = Util::textareaDecodeing($data04);
		if($data05)	$memo = Util::textareaDecodeing($data05);
		if($data06)	$memo = Util::textareaDecodeing($data06);
		if($data07)	$memo = Util::textareaDecodeing($data07);
		if($data08)	$memo = Util::textareaDecodeing($data08);
		if($data09)	$memo = Util::textareaDecodeing($data09);
?>

	<tr align='center' style='cursor:pointer;' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'">
		<td style='padding:0 5px !important;cursor:default;'>
			<div class="sChkBox">
				<input type="checkbox" value="<?=$phone01?>" id="sL<?=$uid?>" name="chk[]">
				<label for="sL<?=$uid?>"></label>
			</div>
		</td>
		<td onclick="cedit('<?=$uid?>');"><?=$i?></td>
		<td onclick="cedit('<?=$uid?>');"><?=$cade01?></td>
		<td onclick="cedit('<?=$uid?>');"><img src='/upfile/<?=$upfile01?>' style='width:150px;height:150px;'></td>
		<td onclick="cedit('<?=$uid?>');"><?=$title?></td>
		<td onclick="cedit('<?=$uid?>');"><?=$data02?></td>		
		<td onclick="cedit('<?=$uid?>');"><?=$data03?></td>

	</tr>

<?
		$i--;
	}

}else{
?>
	<tr> 
		<td colspan="14" align='center' height='50'>등록된 이용자 정보가 없습니다</td>
	</tr>
<?
}
?>

</table>



</form>


<?
	$fName = 'frm01';
	include '../../module/pageNum.php';
	include '../../module/TableFix.php';
?>