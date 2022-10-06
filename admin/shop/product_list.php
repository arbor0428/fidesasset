<?
	include '../../module/login/head.php';
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Msg.php';
	include '../../module/class/class.Util.php';

	//이전에 선택된 회원 uid값
	if($prolist)	$prolistArr = explode(',',$prolist);

	if($c1 == 'acc'){
		$cade01 = '장신구';
		$f1 = 'acclist';
		$f2 = 'accData';

	}elseif($c1 == 'man'){
		$cade01 = '남성한복';
		$f1 = 'manlist';
		$f2 = 'manData';

	}elseif($c1 == 'vest'){
		$cade01 = '털배자(조끼)';
		$f1 = 'vestlist';
		$f2 = 'vestData';
	}

	$path = '../../upfile/';

	$sql = "select * from ks_product where cade01='$cade01' order by msort desc, uid desc";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title><?=$cade01?> 상품목록</title>
<script language='javascript' src='/module/js/jquery-1.11.3.min.js'></script>


<script type='text/javascript' language='JavaScript'>
function check_form(){
    chk = document.getElementsByName('chk[]');
	titleTxt = document.getElementsByName('titleTxt[]');

	cno = 0;
	str01 = '';
	str02 = '';

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked){
			cno++;

			uid = chk[i].value;
			title = titleTxt[i].value;

			if(str01)	str01 += ',';
			str01 += uid;

			if(str02)	str02 += ',';
			str02 += '<'+title+'>';

		}
    }

	if('<?=$c1?>' == 'acc' && cno > 5){
		alert('추전 장신구는 최대 5개까지 선택이 가능합니다');
		return;
	}

	opener.document.frm01['<?=$f1?>'].value = str01;
	opener.document.getElementById("<?=$f2?>").innerText = str02;
	self.close();
}

function search(){
	form = document.form1;
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function clickData(obj){
    chk = document.getElementsByName('chk[]');
	isChk = 0;

    for(i=0; i<chk.length; i++){
		if(chk[i].checked)		isChk++;
    }

	idChk = obj.id;

	if('<?=$cade01?>' == '장신구' && isChk > 5){
		alert('추천 장신구는 최대 5개까지만 선택이 가능합니다');
		$('#'+idChk).prop('checked',false);
		return;
	}
}
</script>



<style type='text/css'>


/*팝업창*/
.pop_box01{
	background-color:#dcdcdc;
	padding:3px 5px 10px 5px;
}

.pop_box02{
	background-color:#ffffff;
	padding:10px;
}

.pop_ttl{
	font-size: 14px;
	font-weight:bold;
	color:#777777;
	font-family:'돋움';
	padding-top: 5px;
}
</style>

<body>

<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" class="pop_box01">
	<tr>
		<td valign='top'>


<form name='form1' method='post' action=''>
<input type='hidden' name='type' value=''>
<input type='hidden' name='prolist' value='<?=$prolist?>'>

			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td class="pop_ttl">|<?=$cade01?> 상품목록</td>
				</tr>
			</table>

			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="pop_box02" style='margin:10px 0 0 0;'>
				<tr>
					<td>

						<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc"  frame="hsides">
							<tr height='35' align='center' bgcolor='#f9f9f9'>
								<td width='35' align='center'>
									<table cellpadding='0' cellspacing='0' border='0'>
										<tr>
											<td>
												<div class="squaredThree" style='margin-top:-10px;'>
													<input type="checkbox" id="agreeAll" name="all_chk" onclick="All_chk('all_chk','chk[]');">
													<label for="agreeAll"></label>
												</div>
											</td>
										</tr>
									</table>
								</td>
								<td width='130'>이미지</td>
								<td>상품명</td>
								<td width='100'>상태</td>
								<td width='150'>대여료</td>
							</tr>
						</table>

						<div style='width:100%;height:590px;overflow-x:hidden; overflow-y:scroll;'>
							<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc"  frame="hsides">

				<?
					if($num){
						for($i=0; $i<$num; $i++){
							$row = mysql_fetch_array($result);
							$uid = $row["uid"];
							$cade02 = $row["cade02"];
							$enable = $row["enable"];		//상태
							$upfile01 = $row["upfile01"];	//이미지
							$title = $row["title"];				//상품명
							$price = $row["price"];			//판매가격

							if($cade02){
								$cade02 = eregi_replace(",", "<br>", $cade02);
								$cade02Txt = "<font color='#de712e'><b>".$cade02."</b></font><br>";
							}else{
								$cade02Txt = '';
							}

							if($enable)	$enableTxt = "<font color='#de712e'>판매중지</font>";
							else			$enableTxt = "판매중";

							$imgTag = '';

							if($upfile01){
								$imgFile = $path.'thumb_'.$upfile01;
								if(!is_file($imgFile))	$imgFile = $path.$upfile01;
								$resize = Util::AutoImgSize($imgFile,120,146);
								$imgTag = "<img src='$imgFile' $resize>";
							}

							$priceTxt = number_format($price).'원';

							$chked = '';

							if(is_array($prolistArr)){
								if(in_array($uid,$prolistArr))	$chked = 'checked';
							}

				?>


								<tr align='center' height='30' onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'" style='cursor:pointer;'>
									<td width="35" align='center'>
										<table cellpadding='0' cellspacing='0' border='0'>
											<tr>
												<td>
													<div class="squaredThree" style='margin-top:-10px;'>
														<input type="checkbox" value="<?=$uid?>" id="agree<?=$uid?>" name="chk[]" <?=$chked?> onclick="clickData(this);">
														<label for="agree<?=$uid?>"></label>
													</div>
												</td>
											</tr>
										</table>
									</td>
									<td width='130' onclick="$('#agree<?=$uid?>').click();"><?=$imgTag?></td>
									<td onclick="$('#agree<?=$uid?>').click();"><?=$title?><input name='titleTxt[]' type='hidden' value='<?=$title?>'></td>
									<td width='100' onclick="$('#agree<?=$uid?>').click();"><?=$enableTxt?></td>
									<td width='133' onclick="$('#agree<?=$uid?>').click();"><?=$priceTxt?></td>
								</tr>
				<?
						}
					}else{
//						echo ("<tr><td height='240' align='center' colspan='4'>검색 결과가 없습니다</td></tr>");
					}
				?>





							</table>
						</div>





						<table cellpadding='0' cellspacing='0' border='0' align='center' style='padding-top:15px;'>
							<tr>
								<td><a href="javascript:check_form();"><img src='/images/common/ok.gif'></a></td>
							</tr>
						</table>

					</td>
				</tr>
			</table>

</form>


		</td>
	</tr>
</table>


<iframe name='ifra_clist' src='about:blank' width='0' height='0' frameborder='0' scrolling='no'></iframe>