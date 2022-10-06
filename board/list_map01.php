<?
	if($word == '서울')		$loc_no = '0';
	elseif($word == '인천')	$loc_no = '1';
	elseif($word == '경기')	$loc_no = '2';
	elseif($word == '강원')	$loc_no = '3';
	elseif($word == '충북')	$loc_no = '4';
	elseif($word == '충남')	$loc_no = '5';
	elseif($word == '대전')	$loc_no = '6';
	elseif($word == '경북')	$loc_no = '7';
	elseif($word == '경남')	$loc_no = '8';
	elseif($word == '대구')	$loc_no = '9';
	elseif($word == '울산')	$loc_no = '10';
	elseif($word == '부산')	$loc_no = '11';
	elseif($word == '전북')	$loc_no = '12';
	elseif($word == '전남')	$loc_no = '13';
	elseif($word == '광주')	$loc_no = '14';
	elseif($word == '제주')	$loc_no = '15';
?>

<script language='javascript'>

function click_del(txt,uid){

	if(confirm(txt+' 글을 삭제하시겠습니까?')){
		form = document.frm01;
		form.uid.value = uid;
		form.type.value = 'del'
		form.action = '<?=$boardRoot?>proc.php';
		form.submit();
	}else{
		return;
	}

	

}


function All_del(){

    var chk = document.getElementsByName('chk[]');
	var isChk = false;

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked)	isChk = true; 
    }

	if(!isChk){
		alert('삭제하실 글을 선택하여 주십시오.');
		return;
	}

	if(confirm('선택하신 글을 삭제하시겠습니까?')){

		form = document.frm01;

		form.type.value = 'all_del'
		form.action = '<?=$boardRoot?>proc.php';
		form.submit();

	}

}


function reg_register(){
	form = document.frm01;
	form.type.value = 'write';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reg_view(uid){
	form = document.frm01;
	form.type.value = 'view';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function error_msg(mod){
	if(mod == 'r'){
		alert('글읽기 권한이 없습니다');
		return;

	}else if(mod == 'w'){
		alert('글쓰기 권한이 없습니다');
		return;

	}
}


function boardsearch(loc){
	form = document.frm01;
	form.type.value = '';
	form.field.value = 'name';
	form.word.value = loc;
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

</script>


<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>
<input type='hidden' name='mCade01' value='<?=$mCade01?>'>
<input type='hidden' name='mCade02' value='<?=$mCade02?>'>
<input type='hidden' name='SET_SKIN_LANG' value='<?=$SET_SKIN_LANG?>'><!-- 스킨언어 -->


	



<table border="0" cellspacing="0" cellpadding="0" align='center'>
	<tr>
		<td width='300px' height='300px' align='center' valign='top'>

			<table border="0" cellspacing="0" cellpadding="0" align='center' style='border:1px solid #cccccc;'>				
				<tr>
					<td>
						<script language='javascript'>
							flash('300','300','<?=$boardRoot?>/flash/boardmap01.swf?main=<?=$loc_no?>&xmlRoot=<?=$boardRoot?>/flash/boardxmlMap01.xml');
						</script>
					</td>
				</tr>							
			</table>

		</td>
		<td width='30px'></td>
		<td width='390px' valign='top'>

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td colspan='3' height='30' align='right'>
						<select name="field">
							<option value='title' <?if($field == 'title') echo 'selected';?>>상호</option>
							<option value='name' <?if($field == 'name') echo 'selected';?>>지역</option>
						</select>
						<input name="word" type="text" size="20" value='<?=$word?>'> <a href='javascript:document.frm01.submit();'><img src='<?=$BTN_search?>' align='absmiddle' alt='검색'></a>
					</td>
				</tr>

				<tr> 
					<td bgcolor="8c8c8c"  height="1" colspan="3"></td>
				</tr>


				<tr>
					<td height='5'></td>
				</tr>

				<tr> 
					<td width="10%" align='center' class='bbs'>번호</td>
					<td width="60%" align='center' class='bbs'>상호</td>
					<td width="30%" align='center' class='bbs'>전화번호</td>
				</tr>

				<tr height="2">
					<td bgcolor="8d8d8d"></td>
					<td bgcolor="e86261"></td>
					<td bgcolor="8d8d8d"></td>
				</tr>

				

<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$title = $row["title"];
		$data02 = $row["data02"];


		//제목 글자수 제한		
		$title = Util::Shorten_String($title,44,'..');

?>
				<tr height='35' align='center' onclick="reg_view('<?=$uid?>');" style='cursor:hand;'>
					<td class='bbs01'><?=$i?></td>
					<td class='bbs01'><?=$title?></td>
					<td class='bbs01'><?=$data02?></td>
				</tr>


				<tr> 
					<td bgcolor="e2e2e2"  height="1" colspan="3"></td>
				</tr>



<?
//답글리스트
include $boardRoot.'reply_list01.php';
?>





<?
		$i--;
		$line_num++;
	}
}else{
?>

				<tr> 
					<td colspan="3" align='center' height='50'>등록된 데이터가 없습니다</td>
				</tr>

<?
}
?>

				<tr>
					<td colspan="3" height="1" bgcolor="e2e2e2"></td>
				</tr>


<?
//글쓰기 권한 설정
include $boardRoot.'chk_write.php';

?>

				<tr> 
					<td height="25" colspan="3" align='right' style="padding:7 5 0 0"><?=$btn_write?></td>
				</tr>


			</table>
			
		</td>
	</tr>
</table>





</form>