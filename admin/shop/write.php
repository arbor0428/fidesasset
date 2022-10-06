<?	
	$chk_icon01 = "<img src='/images/common/join_tt_icon01.gif' style='margin:0 5 0 0'>";
	$chk_icon02 = "<img src='/images/common/join_tt_icon02.gif' style='margin:0 5 0 0'>";

	$priceTitle = '판매가격';
	if($type=='edit' && $uid){
		$sql = "select * from ks_product where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$cade01 = $row["cade01"];	//대분류
		$cade02 = $row["cade02"];	//소분류
		$title = $row["title"];				//상품명
		$icon = $row["icon"];			//아이콘
		$oprice = $row["oprice"];		//세일전가격
		$price = $row["price"];			//판매가격
		$fix_price = $row["fix_price"];	//가격고정
		$baeja = $row["baeja"];			//여성한복 배자여부
		$slide = $row["slide"];			//메인화면슬라이드출력
		$main = $row["main"];			//메인화면출력
		$enable = $row["enable"];		//상태
		$upfile01 = $row["upfile01"];	//이미지

		$upfile02 = $row["upfile02"];	//상세설명 상단이미지
		$upfile03 = $row["upfile03"];	//상세설명 하단이미지#1
		$upfile04 = $row["upfile04"];	//상세설명 하단이미지#2 (사이즈측정법)

		$ment = $row["ment"];

		$esort01 = $row["esort01"];	//촬영한복 출력순서
		$esort02 = $row["esort02"];	//혼주한복 출력순서
		$esort03 = $row["esort03"];	//친인척한복 출력순서
		$esort04 = $row["esort04"];	//잔치한복 출력순서

		$etc_opt01 = $row["etc_opt01"];	//여성한복 > 촬영한복 추가옵션
		$etc_opt02 = $row["etc_opt02"];	//여성한복 > 촬영한복 추가옵션
		$etc_opt03 = $row["etc_opt03"];	//여성한복 > 촬영한복 추가옵션
		$etc_opt04 = $row["etc_opt04"];	//여성한복 > 촬영한복 추가옵션

		//재고
		$inven_44 = $row["inven_44"];		//여성한복(44사이즈)
		$inven_55 = $row["inven_55"];		//여성한복(55사이즈)
		$inven_66 = $row["inven_66"];		//여성한복(66사이즈)
		$inven_77 = $row["inven_77"];		//여성한복(7사이즈)
		$inven_88 = $row["inven_88"];		//여성한복(44사이즈)
		$inven_b1 = $row["inven_b1"];		//돌한복(1호)
		$inven_b2 = $row["inven_b2"];		//돌한복(2호)
		$inven_a1 = $row["inven_a1"];		//장신구

		//여성한복인경우 추천상품(장신구,커플한복,털배자(조끼))
		$acclist = $row["acclist"];
		$manlist = $row["manlist"];
		$vestlist = $row["vestlist"];

		$data04 = $row["data04"];
		$data05 = $row["data05"];
		$data06 = $row["data06"];
		$data07 = $row["data07"];
		$data08 = $row["data08"];
		$data09 = $row["data09"];

		//비고
		if($data04)	$data04 = Util::textareaDecodeing($data04);
		if($data05)	$data05 = Util::textareaDecodeing($data05);
		if($data06)	$data06 = Util::textareaDecodeing($data06);
		if($data07)	$data07 = Util::textareaDecodeing($data07);
		if($data08)	$data08 = Util::textareaDecodeing($data08);
		if($data09)	$data09 = Util::textareaDecodeing($data09);

		
		$useridTxt = $row["userid"];

		$cade02Arr = explode(',',$cade02);
		$iconArr = explode(',',$icon);

	}else{
		$cade02Arr = Array();
		$iconArr = Array();

	}

	$invenChk01 = false;
	$invenChk02 = false;
	$invenChk03 = false;
	$invenChk04 = false;

	if($cade01 == '여성한복' || $cade01 == '커플한복'){
		$invenChk01 = true;

	}elseif($cade01 == '여아한복' || $cade01 == '남아한복'){
		$invenChk02 = true;

	}elseif($cade01 == '털배자(조끼)'){
		$invenChk03 = true;

	}elseif($cade01 == '장신구'){
		$invenChk04 = true;
	}
?>

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>

function check_form(){
	form = document.frm01;

	if(isFrmEmpty(form.title,"상품명을 입력해 주십시오"))	return;

	if(isFrmEmpty(form.price,"<?=$priceTitle?>를 입력해 주십시오"))	return;

	if('<?=$type?>' == 'write'){
		if(isFrmEmpty(form.upfile01,"이미지를 등록해 주십시오"))	return;
	}
<?
	if($cade01=='온라인몰'){
?>
	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);
<?
	}	
?>
	form.action = 'proc.php';
	form.submit();
}

function check_del(){
	if(confirm('본 상품을 삭제하시겠습니까?\n삭제후에는 복구가 불가능합니다')){
		form = document.frm01;
		form.type.value = 'del';
		form.action = 'proc.php';
		form.submit();
	}else{
		return;
	}
}

function reg_list(){
	form = document.frm01;
	form.type.value = 'list';

	cade01 = form.cade01.value;

	form.action = 'up_index01.php';
	form.submit();
	
}

function onlyNumber(){
	var key = event.keyCode;
	
    if(key >= 48 && key <= 57){
		event.returnValue=true;
	}else{
		alert("숫자만 입력 가능합니다");
		event.returnValue=false;
	}
}

function setIcon(n){
	chk = document.getElementsByName('ico[]');
	chkLen = 0;

	for(i=0; i<16; i++){
		if(chk[i].checked)	 chkLen += 1;
	}

	if(chkLen > 3){
		chk[n].checked = false;
		alert('최대 3개까지 선택이 가능합니다');
		return;
	}
}

function productSearch(c1){
	form = document.frm01;

	if(c1 == 'acc')			prolist = form.acclist.value;
	else if(c1 == 'man')	prolist = form.manlist.value;
	else if(c1 == 'vest')	prolist = form.vestlist.value;

	openCenterWin('product_list.php?c1='+c1+'&prolist='+prolist,'p_list','750','730','','');
}

function setChkBox(obj,chk){
	eChk = document.getElementsByName(obj);

	if(eChk[chk].checked){
		for(i=0; i<eChk.length; i++){
			if(i == chk)	eChk[i].checked = true;
			else			eChk[i].checked = false;
		}
	}
}
</script>


<form name='frm01' action="proc.php" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='cade01' value='<?=$cade01?>'>
<input type='hidden' name='size01' value='<?=$size01?>'>
<input type='hidden' name='size02' value='<?=$size02?>'>
<input type='hidden' name='dbfile01' value='<?=$upfile01?>'>
<input type='hidden' name='dbfile02' value='<?=$upfile02?>'>
<input type='hidden' name='dbfile03' value='<?=$upfile03?>'>
<input type='hidden' name='dbfile04' value='<?=$upfile04?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>

<input type='hidden' name='esort01' value='<?=$esort01?>'>
<input type='hidden' name='esort02' value='<?=$esort02?>'>
<input type='hidden' name='esort03' value='<?=$esort03?>'>
<input type='hidden' name='esort04' value='<?=$esort04?>'>

<input type='hidden' name='acclist' value='<?=$acclist?>'>
<input type='hidden' name='manlist' value='<?=$manlist?>'>
<input type='hidden' name='vestlist' value='<?=$vestlist?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_c02a' value='<?=$f_c02a?>'>
<input type='hidden' name='f_c02b' value='<?=$f_c02b?>'>
<input type='hidden' name='f_c02c' value='<?=$f_c02c?>'>
<input type='hidden' name='f_c02d' value='<?=$f_c02d?>'>
<input type='hidden' name='f_title' value='<?=$f_title?>'>
<input type='hidden' name='f_enable01' value='<?=$f_enable01?>'>
<input type='hidden' name='f_enable02' value='<?=$f_enable02?>'>
<!-- /검색관련 -->




<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align='right'><?=$chk_icon01?> 표시는 필수입력사항입니다</td>
	</tr>

	<!-- 필수정보 -->
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>


				<tr style='display:none;'> 
					<th><?=$chk_icon01?>판매회원 설정</td>
					<td colspan='3'>

						<select name='userid'>
							<option value=''>::::판매회원 선택::::</option>
							<?
								$query = "select * from tb_member where mtype='C' order by name asc";
								$result = mysql_query($query);
								while( $row = mysql_fetch_array($result) ){
									$userid = $row["userid"];
									$name = $row["name"];

									if($useridTxt==$userid)		$chk='selected';
									else							$chk='';
							?>
								<option value='<?=$userid?>' <?=$chk?>><?=$name.' ('.$userid.')'?></option>
							<?
								}
							?>
						</select>
					</td>
				</tr>
				<tr> 
					<th width='17%'><?=$chk_icon01?> 상품명</th>
					<td width='33%'><input type='text' name='title' style='width:224px;' value='<?=$title?>'></td>
					<th width='17%'><?=$chk_icon01?> 상태</th>
					<td width='33%'>
						<input type='radio' name='enable' value='' <?if($enable == ''){echo 'checked';}?>>&nbsp;판매중&nbsp;
						<input type='radio' name='enable' value='1' <?if($enable == '1'){echo 'checked';}?>>&nbsp;판매중지
					</td>
				</tr>

				<tr> 
					<th><?=$chk_icon01?> <?=$priceTitle?></td>
					<td><input type='text' name='price' style='width:120px;ime-mode:disabled;' value='<?=$price?>' onkeydown="return onlyNumberNew(event)"> 원</td>
					<th><?=$chk_icon02?> 세일전가격</td>
					<td><input type='text' name='oprice' style='width:120px;ime-mode:disabled;' value='<?=$oprice?>' onkeydown="return onlyNumberNew(event)"> 원</td>
				</tr>
			

				<tr style='display:none;'> 
					<th><?=$chk_icon02?> 아이콘</td>
					<td class='tab' colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
							<tr>
								<td width='25%'><input type='checkbox' name='ico[]' value='ico01.gif' onclick="setIcon('0');" <?if(in_array('ico01.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico01.gif'></td>
								<td width='25%'><input type='checkbox' name='ico[]' value='ico02.gif' onclick="setIcon('1');" <?if(in_array('ico02.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico02.gif'></td>
								<td width='25%'><input type='checkbox' name='ico[]' value='ico03.gif' onclick="setIcon('2');" <?if(in_array('ico03.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico03.gif'></td>
								<td width='25%'><input type='checkbox' name='ico[]' value='ico04.gif' onclick="setIcon('3');" <?if(in_array('ico04.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico04.gif'></td>
							</tr>
							<tr>
								<td><input type='checkbox' name='ico[]' value='ico05.gif' onclick="setIcon('4');" <?if(in_array('ico05.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico05.gif'></td>
								<td><input type='checkbox' name='ico[]' value='ico06.gif' onclick="setIcon('5');" <?if(in_array('ico06.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico06.gif'></td>
								<td><input type='checkbox' name='ico[]' value='ico07.gif' onclick="setIcon('6');" <?if(in_array('ico07.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico07.gif'></td>
								<td><input type='checkbox' name='ico[]' value='ico08.gif' onclick="setIcon('7');" <?if(in_array('ico08.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico08.gif'></td>
							</tr>
							<tr>
								<td><input type='checkbox' name='ico[]' value='ico09.gif' onclick="setIcon('8');" <?if(in_array('ico09.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico09.gif'></td>
								<td><input type='checkbox' name='ico[]' value='ico10.gif' onclick="setIcon('9');" <?if(in_array('ico10.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico10.gif'></td>
								<td><input type='checkbox' name='ico[]' value='ico11.gif' onclick="setIcon('10');" <?if(in_array('ico11.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico11.gif'></td>
								<td><input type='checkbox' name='ico[]' value='ico12.gif' onclick="setIcon('11');" <?if(in_array('ico12.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico12.gif'></td>
							</tr>
							<tr>
								<td><input type='checkbox' name='ico[]' value='ico13.gif' onclick="setIcon('12');" <?if(in_array('ico13.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico13.gif'></td>
								<td><input type='checkbox' name='ico[]' value='ico14.gif' onclick="setIcon('13');" <?if(in_array('ico14.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico14.gif'></td>
								<td><input type='checkbox' name='ico[]' value='ico15.gif' onclick="setIcon('14');" <?if(in_array('ico15.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico15.gif'></td>
								<td><input type='checkbox' name='ico[]' value='ico16.gif' onclick="setIcon('15');" <?if(in_array('ico16.gif',$iconArr)){echo 'checked';}?>> <img src='/images/ico16.gif'></td>
							</tr>
						</table>
					</td>
				</tr>


				<tr> 
					<th><?=$chk_icon01?> 상품이미지</td>
					<td class='tab' colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
					<?
						if($upfile01){
							$imgFile = $path.'thumb_'.$upfile01;
							if(!is_file($imgFile))	$imgFile = $path.$upfile01;
							$imgFile ="/upfile/shop/".$upfile01;
							
					?>
							<tr>
								<td style='padding:0 0 10px 0;'><img src='<?=$imgFile?>' style='width:150px;'></td>
							</tr>
					<?
						}
					?>
							<tr>
								<td>
									<div class="file_input">
										<input type="text" readonly title="File Route" id="file_route01">
										<label>찾아보기<input type="file" name="upfile01" onchange="javascript:document.getElementById('file_route01').value=this.value"></label>
										&nbsp;(가로:400px * 세로:400px / 사진의 크기가 다를 경우 사진이 잘리거나 깨져보일 수 있습니다.)
									</div>
									
								</td>
							</tr>
						</table>
					</td>
				</tr>


			</table>
		</td>
	</tr>
	<!-- /필수정보 -->




<?
	if($cade01=='온라인몰'){
?>
	<tr>
		<td style='padding:30px 0px 0px 0px;color:#666666;font-size:16px;font-weight:bold;'>* 상세설명</td>
	</tr>
	<tr>
		<td><textarea name="ment" id="ment" style='width:100%;height:400px;'><?=$ment?></textarea></td>
	</tr>
<?
	}else{
?>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
				<tr>
					<th width='17%'>성상</th>
					<td colspan='3'><textarea name='data04' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$data04?></textarea></td>
				</tr>
				<tr>
					<th>성분/함량</th>
					<td colspan='3'><textarea name='data05' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$data05?></textarea></td>
				</tr>
				<tr>
					<th>용법/용량</th>
					<td colspan='3'><textarea name='data06' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$data06?></textarea></td>
				</tr>
				<tr>
					<th>포장단위</th>
					<td colspan='3'><textarea name='data07' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$data07?></textarea></td>
				</tr>
				<tr>
					<th>효능/효과</th>
					<td colspan='3'><textarea name='data08' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$data08?></textarea></td>
				</tr>
				<tr>
					<th>저장방법</th>
					<td colspan='3'><textarea name='data09' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$data09?></textarea></td>
				</tr>
			</table>
		</td>
	</tr>
<?
	}
?>	
	<tr>
		<td align='right' height='50'>
	<?
		if($type == 'edit'){
	?>
			<a href="javascript:check_form();"><img src="../../images/common/modify2.gif" border='0'></a>&nbsp;
			<a href="javascript:check_del();"><img src="../../images/common/delete1.gif" border='0'></a>&nbsp;
	<?
		}else{
	?>
			<a href="javascript:check_form();"><img src="../../images/common/register.gif" border='0'></a>&nbsp;
	<?
		}
	?>
			<a href="javascript:reg_list();"><img src="../../images/common/cancel.gif" border='0'></a>
		</td>
	</tr>
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