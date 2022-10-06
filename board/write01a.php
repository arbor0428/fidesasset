<?

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

		$reg_date = $row["reg_date"];

		//저장된 파일명
		$userfile01 = $row["userfile01"];
		$userfile02 = $row["userfile02"];
		$userfile03 = $row["userfile03"];
		$userfile04 = $row["userfile04"];
		$userfile05 = $row["userfile05"];
		$userfile06 = $row["userfile06"];
		$userfile07 = $row["userfile07"];
		$userfile08 = $row["userfile08"];
		$userfile09 = $row["userfile09"];
		$userfile10 = $row["userfile10"];

		//실제 파일명
		$realfile01 = $row["realfile01"];
		$realfile02 = $row["realfile02"];
		$realfile03 = $row["realfile03"];
		$realfile04 = $row["realfile04"];
		$realfile05 = $row["realfile05"];
		$realfile06 = $row["realfile06"];
		$realfile07 = $row["realfile07"];
		$realfile08 = $row["realfile08"];
		$realfile09 = $row["realfile09"];
		$realfile10 = $row["realfile10"];

		
		$endDate = $row["endDate"];

		$set_ry = date('Y',$reg_date);
		$set_rm = date('m',$reg_date);
		$set_rd = date('d',$reg_date);
		$set_rh = date('H',$reg_date);
		$set_ri = date('i',$reg_date);
		$set_rs = date('s',$reg_date);

	//재단소개 > 경영공시 > 업무추진비
	}elseif($table_id == 'table_1521100078'){
		$data01 = $f_data01;

	}

	if(!$name)	$name = $GBL_NAME;
	if(!$passwd)	$passwd = $GBL_PASSWORD;



	$sRange = '1';
	$eRange = '1';
	include '../module/Calendar.php';

?>



<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>
function check_form(){
	form = document.FRM;

	if(isFrmEmptyModal(form.title,"제목을 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.name,"작성자를 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.passwd,"비밀번호를 입력해 주십시오"))	return;

	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

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
<input type='hidden' name='userid' value="<?=$GBL_USERID?>">
<input type='hidden' name='next_url' value="<?=$PHP_SELF?>">
<input type='hidden' name='record_start' value="<?=$record_start?>">
<input type='hidden' name='field' value="<?=$field?>">
<input type='hidden' name='word' value="<?=$word?>">
<input type='hidden' name='f_data01' value="<?=$f_data01?>">
<input type='hidden' name='strRoot' value="<?=$strRoot?>">
<input type='hidden' name='boardRoot' value="<?=$boardRoot?>">

<input type='hidden' name='table_id' value="<?=$table_id?>">
<input type='hidden' name='dbfile01' value="<?=$userfile01?>">
<input type='hidden' name='dbfile02' value="<?=$userfile02?>">
<input type='hidden' name='dbfile03' value="<?=$userfile03?>">
<input type='hidden' name='dbfile04' value="<?=$userfile04?>">
<input type='hidden' name='dbfile05' value="<?=$userfile05?>">
<input type='hidden' name='dbfile06' value="<?=$userfile06?>">
<input type='hidden' name='dbfile07' value="<?=$userfile07?>">
<input type='hidden' name='dbfile08' value="<?=$userfile08?>">
<input type='hidden' name='dbfile09' value="<?=$userfile09?>">
<input type='hidden' name='dbfile10' value="<?=$userfile10?>">

<input type='hidden' name='realfile01' value="<?=$realfile01?>">
<input type='hidden' name='realfile02' value="<?=$realfile02?>">
<input type='hidden' name='realfile03' value="<?=$realfile03?>">
<input type='hidden' name='realfile04' value="<?=$realfile04?>">
<input type='hidden' name='realfile05' value="<?=$realfile05?>">
<input type='hidden' name='realfile06' value="<?=$realfile06?>">
<input type='hidden' name='realfile07' value="<?=$realfile07?>">
<input type='hidden' name='realfile08' value="<?=$realfile08?>">
<input type='hidden' name='realfile09' value="<?=$realfile09?>">
<input type='hidden' name='realfile10' value="<?=$realfile10?>">




<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout: fixed">
	<tr>
		<td>


			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2' style="table-layout: fixed">
<?
if($GBL_MTYPE == 'A'){
?>
				<tr> 
					<th>공지</th>
					<td colspan='3'> <input name="notice_chk" type="checkbox" value='1' <?if($notice_chk=='1') echo 'checked';?>> 체크하실 경우 리스트의 최상단에 출력됩니다</td>
				</tr>
<?
}else{
?>
<input type='hidden' name='notice_chk' value='<?=$notice_chk?>'>
<?
}
?>

<?
	//재단소개 > 경영공시 > 업무추진비
	if($table_id == 'table_1521100078___________'){
?>
				<tr> 
					<th>팀</th>
					<td colspan='3'>
						<select name='data01'>
							<option value=''>:: 선택 ::</option>
							<option value='대표이사' <?if($data01 == '대표이사'){echo 'selected';}?>>대표이사</option>
							<option value='경영지원팀' <?if($data01 == '경영지원팀'){echo 'selected';}?>>경영지원팀</option>
							<option value='문화정책사업팀' <?if($data01 == '문화정책사업팀'){echo 'selected';}?>>문화정책사업팀</option>
							<option value='공연예술팀' <?if($data01 == '공연예술팀'){echo 'selected';}?>>공연예술팀</option>
							<option value='문화정책연구소' <?if($data01 == '문화정책연구소'){echo 'selected';}?>>문화정책연구소</option>
						</select>
					</td>
				</tr>
<?
	}
?>
<?
	//열린공간 > 공지사항
	if($table_id == 'table_1512539542'){
?>
				<tr> 
					<th>분류</th>
					<td>
						<select name='data01'>
							<option value=''>:: 선택 ::</option>
							<option value='안내' <?if($data01 == '안내'){echo 'selected';}?>>안내</option>
							<option value='모집' <?if($data01 == '모집'){echo 'selected';}?>>모집</option>
							<option value='발표' <?if($data01 == '발표'){echo 'selected';}?>>발표</option>
						</select>
					</td>
					<th>마감일자</th>
					<td>						
						<input type='text' name='eDate' id='fpicker2' value="<?=$endDate?>">
					</td>
				</tr>
<?
	//열린공간 > 채용정보
	}elseif($table_id == 'table_1512539551'){
?>
				<tr>
					<th>분류</th>
					<td>
						<select name='data01'>
							<option value=''>:: 선택 ::</option>
							<option value='모집' <?if($data01 == '모집'){echo 'selected';}?>>모집</option>
							<option value='발표' <?if($data01 == '발표'){echo 'selected';}?>>발표</option>
						</select>
					</td>
					<th>마감일자</th>
					<td>
						<input type='text' name='eDate' id='fpicker2' value="<?=$endDate?>">
					</td>
				</tr>
<?
	}
?>

				<tr> 
					<th>제목</th>
					<td colspan='3'><input name="title" type="text" style='width:98%;' value="<?=$title?>"></td>
				</tr>
				<tr> 
					<th width="17%">작성자</th>
					<td width="33%"><input class="writer__nm" name="name" type="text" value="<?=$name?>"></td>
					<th width="17%">비밀번호</th>	
					<td width="33%" style='font-size:12px;'>
						<input class="writer__pw" name="passwd" type="password" value="<?=$passwd?>">&nbsp;
					<?
						//열린공간 > 재단에게 바란다
						if($table_id == 'table_1512539600'){
							echo ("<input type='hidden' name='pwd_chk' value='1'>");
						}else{
					?>					
						<input type='radio' name='pwd_chk' value='' <?if(!$pwd_chk) echo 'checked';?>>공개&nbsp;&nbsp;&nbsp;
						<input type='radio' name='pwd_chk' value='1' <?if($pwd_chk) echo 'checked';?>>비공개
					<?
						}
					?>
					</td>
				</tr>

<?
	if($GBL_MTYPE == 'A'){
?>
				<tr>
					<th>등록일시</th>
					<td colspan='3'>
						<select name='set_ry' style='height:30px;'>
						<?
							for($i=date('Y')+1; $i>=2016; $i--){
								if($i == $set_ry)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>년
						<select name='set_rm' style='height:30px;'>
						<?
							for($i=1; $i<=12; $i++){
								$set_rm_no = sprintf('%02d',$i);
								if($i == $set_rm)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>월
						<select name='set_rd' style='height:30px;'>
						<?
							for($i=1; $i<=31; $i++){
								$set_rd_no = sprintf('%02d',$i);
								if($i == $set_rd)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>일&nbsp;&nbsp;

						<select name='set_rh' style='height:30px;'>
						<?
							for($i=0; $i<=23; $i++){
								$set_rh_no = sprintf('%02d',$i);
								if($i == $set_rh)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>시
						<select name='set_ri' style='height:30px;'>
						<?
							for($i=0; $i<=59; $i++){
								$set_ri_no = sprintf('%02d',$i);
								if($i == $set_ri)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>분
						<select name='set_rs' style='height:30px;'>
						<?
							for($i=0; $i<=59; $i++){
								$set_rs_no = sprintf('%02d',$i);
								if($i == $set_rs)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>초&nbsp;&nbsp;
						<input type='button' name='btn_set' value='현재시간' onclick='setToDate(this.form);' style='height:30px;cursor:pointer;'>
					</td>
				</tr>
<?
	}
?>


<?
for($i=1; $i<=$upload_chk; $i++){
	$file_num = sprintf("%02d",$i);

	$upfile = ${'userfile'.$file_num};
	$realfile = ${'realfile'.$file_num};

	if($list_mod == '갤러리형' || $list_mod == '블로그형'){
		if($i == 1)	$fileTitle = "썸네일";
		else			$fileTitle = "첨부파일 #".($i-1);

	}else{
		$fileTitle = "첨부파일 #".$i;
	}
?>


				<tr> 
					<th><?=$fileTitle?></th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0' style="table-layout: fixed">
							<tr>
								<td>
									<div class="file_input">
										<input type="text" readonly title="File Route" id="file_route<?=$file_num?>" style="width:290px;padding:0 0 0 10px;">
										<label>찾아보기<input type="file" name="upfile<?=$file_num?>" onchange="javascript:document.getElementById('file_route<?=$file_num?>').value=this.value"></label>
									</div>
								</td>
							<?
								if($upfile){
							?>
								<td style='padding:0 0 0 10px;'>
									<div class="enable_btn">
										<div class="squaredThree">
											<input type="checkbox"  id="squaredDel<?=$file_num?>" type="checkbox" name="del_upfile<?=$file_num?>" value="Y" />
											<label for="squaredDel<?=$file_num?>"></label>										
										</div>
										<p style='margin:0 0 0 25px;'>삭제&nbsp;&nbsp;(<?=$realfile?>)</p>
									</div>
								</td>
							<?
								}
							?>
							</tr>
						</table>
					</td>
				</tr>

<?
}
?>

			</table>


		</td>
	</tr>

	<tr>
		<td style='padding:5px 0px;'><textarea name="ment" id="ment" style='width:100%;height:500px;'><?=$ment?></textarea></td>
	</tr>

<?
if($type == 'write'){
?>
	<tr>
		<td align='right' height='50'>
			<a class="edit__btn" href="javascript:check_form();">등록</a>&nbsp;
			<a class="del__btn" href="javascript:reg_list();">취소</a>
		</td>
	</tr>
<?
}else{
?>
	<tr>
		<td align='right' height='50'>
			<a class="edit__btn" href="javascript:check_form();">수정</a>&nbsp;
			<a class="del__btn" href="javascript:reg_del();">삭제</a>&nbsp;
			<a class="goback__btn" href="javascript:reg_list();">목록보기</a>
		</td>
	</tr>
<?
}
?>
			
</table>


</form>

<script type="text/javascript">

var oEditors = [];

nhn.husky.EZCreator.createInIFrame({

    oAppRef: oEditors,

    elPlaceHolder: "ment",

    sSkinURI: "/smarteditor/SmartEditor2Skin.html",

	/* 페이지 벗어나는 경고창 없애기 */
	htParams : {
		bUseToolbar : true,
		bUseVerticalResizer : false,
		fOnBeforeUnload : function(){},
		fOnAppLoad : function(){}
	}, 

    fCreator: "createSEditor2"

});

</script>


<style>
	.gTable2 th {background: transparent; color: #333; border:1px solid #333;}
	.gTable2 td {border:1px solid #333;}
	 .writer__nm {width:205px !important;}
	 .writer__pw {width:140px;}
	 input[type="text"], input[type="password"], .gTable2 select {border-radius: 5px; border: 1px solid #bbb;}
	 .file_input label {background: #000; border-radius: 5px;}
	.file_input label:hover {background: #000;}
	.edit__btn {padding: 5px 20px; background-color:#f99a06; color: #fff; margin: 0 5px; border-radius: 5px;}
	.del__btn {padding: 5px 20px; background-color:#c22d1b; color: #fff; margin: 0 5px; border-radius: 5px;}
	.goback__btn {padding: 5px 20px; background-color:#000; color: #fff; margin: 0 5px; border-radius: 5px;}


	 @media screen and (max-width: 768px) { 
	.writer__nm {width:98% !important;}
	 .writer__pw {width:98%;}
	 .file_input input {width: 130px !important;}
	}
</style>

