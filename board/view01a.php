<?

	if($uid){

		//조회수증가
		$sql = "update tb_board_list set hit = hit + 1 where uid='$uid'";
		$result = mysql_query($sql);


		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$userid = $row["userid"];
		$title = $row["title"];
		$name = $row["name"];
		$email = $row["email"];
		$ment = $row["ment"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$data04 = $row["data04"];
		$data05 = $row["data05"];
		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d H:i:s",$reg_date);

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
	}




?>



<script language='javascript'>
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

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_modify(){
	form = document.FRM;
	form.type.value = 'edit';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_reply(){
	form = document.FRM;
	form.type.value = 're_write';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function error_msg(mod){
	if(mod == 'r'){
		alert('답글작성 권한이 없습니다');
		return;

	}else if(mod == 'w'){
		alert('글쓰기 권한이 없습니다');
		return;

	}
}
</script>



<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='upid' value='<?=$uid?>'><!-- 답글작성용 -->
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='word' value='<?=$word?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>


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
<a href="https://efac.or.kr<?=$PHP_SELF?>?type=view&uid=<?=$uid?>" onclick="copy_trackback(this.href); return false;" style='text-align:right;display:none;' class="small cbtn black">주소복사</a>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class='gTable2'>

				<tr align="" height='30'>
					<th width="20%" class='bbs'>작성자</th>
					<th width="57%" class='bbs'>제목</th>
					<th width="23%" class='bbs'>등록일</th>
				</tr>

				<tr align="" height='30'>
					<td class='bbs01'><?=$name?></td>
					<td class='bbs01'><?=$title?></td>
					<td class='bbs01'><?=$reg_date?></td>
				</tr>

				<tr height="300" valign="top">
					<td class='bbs01' colspan='3' style="padding:10px 0;"><div style="width:100%; height: 100%; box-sizing:border-box; padding: 20px; border-radius: 5px; border:1px solid #c3c3c3; background-color:#fbfbfb; text-align: left;"><?=$ment?></div></td>
				</tr>



<?

$fno = 0;
if($download_chk == '')	$upload_chk = 0;

for($i=1; $i<=$upload_chk; $i++){
	$file_num = sprintf("%02d",$i);
	$file_name = ${'realfile'.$file_num};

	if($file_name){
		$fno++;
?>



				<tr>
					<th class='bbs'>첨부파일#<?=$fno?></th>
					<td class='bbs01' colspan='2'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
							<tr>
								<td><?=$file_name?></td>
							<?
								if($download_chk){
							?>
								<td width='80' align='right'><a href="javascript:file_down('FRM','<?=$file_num?>');" class='mini cbtn black'>다운로드</a></td>
							<?
								}
							?>
							</tr>
						</table>
					</td>
				</tr>

<?
	}
}
?>


			</table>


		</td>
	</tr>



	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td width='40%'>

					<!-- 수정 or 삭제시 비밀번호 입력 테이블 -->

<script language='javascript'>


function isEnter4(){
	if(event.keyCode==13){
		mod_pwd();
		return;
	}
}

function mod_pwd(){
	form = document.FRM;

	if(isFrmEmpty(form.mod_pwd,"비밀번호를 입력해 주십시오"))	return;
	form.action = '<?=$boardRoot?>pwd_proc.php';
	form.submit();

}

function tblDataPwd(mod){

	form = document.FRM;

	var tr = document.getElementById("tbl_mod");


	if(mod == 'del'){
		if(!confirm('삭제하시겠습니까?')){
			return;
		}
	}

	tr.style.display='';
	form.type.value = mod;
	form.mod_pwd.focus();


}

</script>

						<table cellpadding='0' cellspacing='0' border='0' id='tbl_mod' style="display:none;">
							<tr>
								<td><b>비밀번호</b></td>
								<td width='5'></td>
								<td><input type='password' name='mod_pwd' style='width:130px;' onKeyPress="javascript:isEnter4()"></td>
								<td width='5'></td>
								<td><a href="javascript:mod_pwd();"><img src="<?=$boardRoot?>img/pwd_ok.gif" alt="확인"></a></td>
							</tr>
						</table>

					<!-- /수정 or 삭제시 비밀번호 입력 테이블 -->

					</td>


<?
//답글쓰기 권한설정
include $boardRoot.'chk_reply.php';
//글쓰기 권한 설정
include $boardRoot.'chk_write.php';

?>


<?
//수정 & 삭제버튼 설정
if($GBL_MTYPE){
	if($GBL_MTYPE == 'A' || $GBL_USERID == $userid || $chk_type == 'ok'){
		$btn_tbl_type = 'ok';

	}else{
		$btn_tbl_type = 'pwd';

	}

}else{
	$btn_tbl_type = 'pwd';
}
?>


				<?
					if($btn_tbl_type == 'ok'){
				?>

					<td width='60%' align='right'>
						<?=$btn_re_write?>
						<a href="javascript:reg_modify();" class='edit__btn'>수정</a>&nbsp;
						<a href="javascript:reg_del();" class='del__btn'>삭제</a>&nbsp;
						<a href="javascript:reg_list();" class='goback__btn'>목록</a>
					</td>

				<?
					}else{
				?>
					<td width='60%' align='right'>
					<!--
						<?=$btn_re_write?>
						<a href="javascript:tblDataPwd('edit');"><img src="<?=$boardRoot?>img/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:tblDataPwd('del');"><img src="<?=$boardRoot?>img/delete1.gif" border=0></a>&nbsp;
					-->
						<a href="javascript:reg_list();" class='goback__btn'>목록</a>
					</td>
				<?
					}
				?>
				</tr>
			</table>
		</td>
	</tr>
</table>





<!-- 한줄의견-->
<?
include $boardRoot.'coment.php';
?>
<!-- /한줄의견 -->




</form>

<iframe name='ifra_down' src='about:blank' width='0' height='0' frameborder='0' scrolling='0'></iframe>

<style>
	.gTable2 th {border: 1px solid #333; color: #333; background: transparent; padding: 0; text-align:center;}
	.gTable2 td {border: 1px solid #333; color: #333; padding:5px 0; text-align:center;}
	.edit__btn {padding: 5px 20px; background-color:#f99a06; color: #fff; margin: 0 5px; border-radius: 5px;}
	.del__btn {padding: 5px 20px; background-color:#c22d1b; color: #fff; margin: 0 5px; border-radius: 5px;}
	.goback__btn {padding: 5px 20px; background-color:#000; color: #fff; margin: 0 5px; border-radius: 5px;}

	@media screen and (max-width: 768px) {
		.edit__btn {margin: 0 3px; padding: 6px 15px; font-size: 15px;}
		.del__btn {margin: 0 3px; padding: 6px 15px; font-size: 15px;}
		.goback__btn {margin: 0 3px; padding: 6px 15px; font-size: 15px;}
	}
</style>