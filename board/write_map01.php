<?
	$chk_icon01 = "<img src='/images/common/join_tt_icon01.gif' style='margin:0 5 0 0'>";
	$chk_icon02 = "<img src='/images/common/join_tt_icon02.gif' style='margin:0 5 0 0'>";

	if($type=='edit' && $uid){
		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$title = $row["title"];
		$name = $row["name"];
		$email = $row["email"];
		$passwd = $row["passwd"];
		$pwd_chk = $row["pwd_chk"];
		$notice_chk = $row["notice_chk"];
		$ment = $row["ment"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$data04 = $row["data04"];
		$data05 = $row["data05"];
		$data06 = $row["data06"];
		$data07 = $row["data07"];
		$data08 = $row["data08"];

		//저장된 파일명
		$userfile01 = $row["userfile01"];
		$userfile02 = $row["userfile02"];
		$userfile03 = $row["userfile03"];
		$userfile04 = $row["userfile04"];
		$userfile05 = $row["userfile05"];

		//실제 파일명
		$realfile01 = $row["realfile01"];
		$realfile02 = $row["realfile02"];
		$realfile03 = $row["realfile03"];
		$realfile04 = $row["realfile04"];
		$realfile05 = $row["realfile05"];

	}

	if(!$name){
		if($GBL_COMPANY)	 $name = $GBL_COMPANY;
		else	$name = $GBL_NAME;
	}
	if(!$passwd)	$passwd = $GBL_PASSWORD;




?>



<script language='javascript' src='../../html_editor/languages/euc-kr/java.lang.js'></script>

<script language='javascript'>
var _editor_url = "../../html_editor";
var _contentValue = "ment";
var _contentName = "FRM";
var _i_uploaded = "";
var _m_uploaded = "";


function check_form(){
	form = document.FRM;

	if(isFrmEmpty(form.title,"상호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.data01,"대표명을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.data02,"전화번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.name,"지도주소를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.data04,"지도주소를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.data05,"실제표기주소를 입력해 주십시오"))	return;

	form.ment.value = SubmitHTML();

	form.action = '<?=$boardRoot?>proc.php';
	form.submit();
}



function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_del(){
	
	if(confirm('글을 삭제하시겠습니까?')){
		form = document.FRM;
		form.type.value = 'del'
		form.action = '<?=$boardRoot?>proc.php';
		form.submit();
	}else{
		return;
	}

}

</script>



<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value="<?=$type?>">
<input type='hidden' name='uid' value="<?=$uid?>">
<input type='hidden' name='next_url' value="<?=$PHP_SELF?>">
<input type='hidden' name='record_start' value="<?=$record_start?>">
<input type='hidden' name='field' value="<?=$field?>">
<input type='hidden' name='word' value="<?=$word?>">
<input type='hidden' name='strRoot' value="<?=$strRoot?>">
<input type='hidden' name='boardRoot' value="<?=$boardRoot?>">
<input type='hidden' name='userid' value="<?=$GBL_USERID?>">
<input type='hidden' name='table_id' value="<?=$table_id?>">
<input type='hidden' name='dbfile01' value="<?=$userfile01?>">
<input type='hidden' name='dbfile02' value="<?=$userfile02?>">
<input type='hidden' name='dbfile03' value="<?=$userfile03?>">
<input type='hidden' name='dbfile04' value="<?=$userfile04?>">
<input type='hidden' name='dbfile05' value="<?=$userfile05?>">

<input type='hidden' name='realfile01' value="<?=$realfile01?>">
<input type='hidden' name='realfile02' value="<?=$realfile02?>">
<input type='hidden' name='realfile03' value="<?=$realfile03?>">
<input type='hidden' name='realfile04' value="<?=$realfile04?>">
<input type='hidden' name='realfile05' value="<?=$realfile05?>">


<input type='hidden' name='pwd_chk' value=""><!-- 공개글 설정 -->
<input type='hidden' name='passwd' value="1234"><!-- 비밀번호 -->



<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
				<tr> 
					<td bgcolor="cccccc"  height="1" colspan="4"></td>
				</tr>

				<tr> 
					<td width="17%" class='tab_tit'><?=$chk_icon01?>상 호</td>
					<td width="33%" class='tab'><input type='text' name='title' value="<?=$title?>" style='width:98%;'></td>
					<td width="17%" class='tab_tit'><?=$chk_icon01?>대 표</td>
					<td width="33%" class='tab'><input type='text' name='data01' value="<?=$data01?>" style='width:98%;'></td>
				</tr>

				<tr> 
					<td class='tab_tit'><?=$chk_icon01?>전 화1</td>
					<td class='tab'><input type='text' name='data02' value="<?=$data02?>" style='width:98%;'></td>
					<td class='tab_tit'><?=$chk_icon02?>전 화2</td>
					<td class='tab'><input type='text' name='data03' value="<?=$data03?>" style='width:98%;'></td>
				</tr>

				<tr>
					<td colspan='4' class='tab' height='50'>
						 <p><font color='red'><img src='/images/common/arrowmap.gif'> 지도API에 사용될 주소는 빌딩명 또는 층수는 입력하지마시고 <strong>번지수까지만 입력</strong>을 해주셔야 합니다.<br></p>
						<img src='/images/common/arrowmap.gif'> 주소가</font> <u><font color='#000000'>서울 서대문구 충정로2가 골든타워빌딩 1702호</font></u> <font color='red'>인 경우 <b><u>서울 서대문구 충정로2가 191</u></b> 까지만 입력하셔야 합니다.</font>
					</td>
				</tr>

				<tr> 
					<td class='tab_tit'><?=$chk_icon01?>지도주소</td>
					<td class='tab' colspan='3'>
						<select name="name">
							<option value="">==</option>
							<option value="서울" <?if($name=='서울') echo 'selected';?>>서 울</option>
							<option value="경기" <?if($name=='경기') echo 'selected';?>>경 기</option>
							<option value="강원" <?if($name=='강원') echo 'selected';?>>강 원</option>
							<option value="경남" <?if($name=='경남') echo 'selected';?>>경 남</option>
							<option value="경북" <?if($name=='경북') echo 'selected';?>>경 북</option>
							<option value="광주" <?if($name=='광주') echo 'selected';?>>광 주</option>
							<option value="대구" <?if($name=='대구') echo 'selected';?>>대 구</option>
							<option value="대전" <?if($name=='대전') echo 'selected';?>>대 전</option>
							<option value="부산" <?if($name=='부산') echo 'selected';?>>부 산</option>
							<option value="울산" <?if($name=='울산') echo 'selected';?>>울 산</option>
							<option value="인천" <?if($name=='인천') echo 'selected';?>>인 천</option>
							<option value="전남" <?if($name=='전남') echo 'selected';?>>전 남</option>
							<option value="전북" <?if($name=='전북') echo 'selected';?>>전 북</option>
							<option value="제주" <?if($name=='제주') echo 'selected';?>>제 주</option>
							<option value="충남" <?if($name=='충남') echo 'selected';?>>충 남</option>
							<option value="충북" <?if($name=='충북') echo 'selected';?>>충 북</option>
						</select>
						<input type='text' name='data04' value="<?=$data04?>" style='width:281px;'> (지도API 에 사용될 주소)
					</td>
				</tr>

				<tr> 
					<td class='tab_tit'><?=$chk_icon01?>실제표기주소</td>
					<td class='tab' colspan='3'><input type='text' name='data05' value="<?=$data05?>" style='width:340px;'> (이용자 화면에 표기되는 주소)</td>
				</tr>

				<tr> 
					<td class='tab_tit'><?=$chk_icon02?>이메일</td>
					<td class='tab'><input type='text' name='data06' value="<?=$data06?>" style='width:98%;'></td>				
					<td class='tab_tit'><?=$chk_icon02?>홈페이지</td>
					<td class='tab'><input type='text' name='data07' value="<?=$data07?>" style='width:98%;'></td>
				</tr>

<?
for($i=1; $i<=$upload_chk; $i++){
	$file_num = sprintf("%02d",$i);
?>


				<tr> 
					<td class='tab_tit'><?=$chk_icon02?>첨부파일#<?=$i?></td>
					<td class='tab' colspan='3'>
						<input type='file' name='upfile<?=$file_num?>' class='file01'>
					<?
						if(${'userfile'.$file_num}){
					?>
						<input type='checkbox' name='del_upfile<?=$file_num?>' value='Y'>삭제 (<?=${'realfile'.$file_num}?>)
					<?
						}
					?>

					</td>
				</tr>

<?
}
?>




				<tr> 
					<td colspan='4' style='padding-top:5px;'>
						<!-- html_editor -->
						<table border='0' cellpadding='1' cellspacing='1' width='100%'>

							<tr>
								<td>
								<?
									include '../html_editor/btn_tool.php';
								?>			
								</td>
							</tr>

							<tr>
								<td>
									<table border='1' width='100%' cellspacing='0' bordercolor='#EFEFEF' bordercolordark='white' bordercolorlight='#DBDBDB'>
										<tr>
											<td>
											<iframe id='gmEditor' width='100%' height='300' scrolling='auto' border='0' frameborder='0' framespacing='0' hspace='0' marginheight='0' marginwidth='0' vspace='0'></iframe>
											<textarea cols=0 rows=0 style='display:none;' wrap='physical' name='ment' ><?=$ment?></textarea>
											<input type='hidden' name='editor_url' id='editor_url' value='/html_editor'>
											<input type='hidden' name='editor_stom' id='editor_stom' value='euc-kr'>
											<script language='javascript' src='/html_editor/gmEditor.js'></script>
											</td>
										</td>
									</table>
								</td>
							</tr>
						</table>
						<!-- html_editor -->
					</td>
				</tr>
				<tr>
					<td height="2" bgcolor="8c8c8c" colspan="4"></td>
				</tr>
			</table>
		</td>
	</tr>


<?
if($type == 'write'){
?>
	<tr>
		<td align='right' height='50'>
			<a href="javascript:check_form();"><img src='<?=$BTN_register?>'></a>&nbsp;
			<a href="javascript:reg_list();"><img src='<?=$BTN_cancel?>'></a>
		</td>
	</tr>
<?
}else{
?>
	<tr>
		<td align='right' height='50'>
			<a href="javascript:check_form();"><img src='<?=$BTN_register?>'></a>&nbsp;
			<a href="javascript:reg_del();"><img src='<?=$BTN_del01?>'></a>&nbsp;
			<a href="javascript:reg_list();"><img src='<?=$BTN_list?>'></a>
		</td>
	</tr>
<?
}
?>
</table>

</form>