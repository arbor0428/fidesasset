<?	
	$chk_icon01 = "<img src='/images/common/join_tt_icon01.gif' style='margin:0 5 0 0'>";
	$chk_icon02 = "<img src='/images/common/join_tt_icon02.gif' style='margin:0 5 0 0'>";

	if($type=='edit' && $uid){
		$sql = "select * from ks_product where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$cade02 = $row["cade02"];	//소분류
		$title = $row["title"];				//상품명
		$icon = $row["icon"];			//아이콘
		$oprice = $row["oprice"];		//세일전가격
		$price = $row["price"];			//판매가격
		$baeja = $row["baeja"];			//여성한복 배자여부
		$slide = $row["slide"];			//메인화면슬라이드출력
		$main = $row["main"];			//메인화면출력
		$enable = $row["enable"];		//상태
		$upfile01 = $row["upfile01"];	//이미지

		$upfile02 = $row["upfile02"];	//상세설명 상단이미지
		$upfile03 = $row["upfile03"];	//상세설명 하단이미지#1
		$upfile04 = $row["upfile04"];	//상세설명 하단이미지#2 (사이즈측정법)

		$ment = $row["ment"];

		$iconArr = explode(',',$icon);

	}else{
		$iconArr = Array();
	}

?>

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>

function check_form(){
	form = document.frm01;

	if(form.cade01.value == ''){
		alert('대분류 설정값 오류입니다. 다시 접속해 주시기 바랍니다');
		return;
	}

	if(isFrmEmpty(form.title,"상품명을 입력해 주십시오"))	return;

	if(isFrmEmpty(form.price,"대여료를 입력해 주십시오"))	return;

	if('<?=$type?>' == 'write'){
		if(isFrmEmpty(form.upfile01,"이미지를 등록해 주십시오"))	return;
	}

	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

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

	if(cade01 == '여성한복')			act = 'up_index01.php';
	else if(cade01 == '남성한복')		act = 'up_index02.php';
	else if(cade01 == '커플한복')	 	act = 'up_index03.php';
	else if(cade01 == '장진수')		act = 'up_index05.php';

	if(act){
		form.action = act;
		form.submit();
	}
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

<!-- 검색관련 -->
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
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
				<tr>
					<td height='40' align='center' colspan='4' style="color:#de712e;font-size:16px;font-weight:bold;"><?=$cade01?></td>
				</tr>

				<tr> 
					<td width='17%' class='tab_tit'><?=$chk_icon01?> 상품명</td>
					<td width='33%' class='tab'><input type='text' name='title' style='width:224px;' value='<?=$title?>'></td>
					<td width='17%' class='tab_tit'><?=$chk_icon01?> 상태</td>
					<td width='33%' class='tab'>
						<input type='radio' name='enable' value='' <?if($enable == ''){echo 'checked';}?>>판매중
						<input type='radio' name='enable' value='1' <?if($enable == '1'){echo 'checked';}?>>판매중지
					</td>
				</tr>

				<tr> 
					<td width='17%' class='tab_tit'><?=$chk_icon01?> 대여료</td>
					<td width='33%' class='tab'><input type='text' name='price' style='width:120px;ime-mode:disabled;' value='<?=$price?>' onkeypress='onlyNumber();'> 원</td>
					<td width='17%' class='tab_tit'><?=$chk_icon02?> 세일전가격</td>
					<td width='33%' class='tab'><input type='text' name='oprice' style='width:120px;ime-mode:disabled;' value='<?=$oprice?>' onkeypress='onlyNumber();'> 원</td>
				</tr>

			<?
				if($cade01 == '여성한복' || $cade01 == '커플한복'){
			?>
				<tr> 
					<td class='tab_tit'><?=$chk_icon01?> 배자여부</td>
					<td class='tab' colspan='3'>
						<input type='radio' name='baeja' value='1' <?if($baeja){echo 'checked';}?>>배자있음
						<input type='radio' name='baeja' value='' <?if($baeja == ''){echo 'checked';}?>>배자없음
					</td>
				</tr>
			<?
				}
			?>







		<?
			$msql = "select * from ks_product where slide!=''";
			$mresult = mysql_query($msql);
			$mnum = mysql_num_rows($mresult);
			$m_array = Array();

			for($i=0; $i<$mnum; $i++){
				$mrow = mysql_fetch_array($mresult);
				$m = $mrow['slide'];
				$m_array[] = $m;
			}
		?>
				<tr> 
					<td class='tab_tit'><?=$chk_icon02?> 메인 슬라이드상품</td>
					<td class='tab' colspan='3'>
						<select name='slide'>
							<option value=''>==</option>
							<option value='1' <?if($slide == '1'){echo 'selected';}?> <?if(in_array('1',$m_array)){echo "style='color:#ff0000;'";}?>>1</option>
							<option value='2' <?if($slide == '2'){echo 'selected';}?> <?if(in_array('2',$m_array)){echo "style='color:#ff0000;'";}?>>2</option>
							<option value='3' <?if($slide == '3'){echo 'selected';}?> <?if(in_array('3',$m_array)){echo "style='color:#ff0000;'";}?>>3</option>
							<option value='4' <?if($slide == '4'){echo 'selected';}?> <?if(in_array('4',$m_array)){echo "style='color:#ff0000;'";}?>>4</option>
							<option value='5' <?if($slide == '5'){echo 'selected';}?> <?if(in_array('5',$m_array)){echo "style='color:#ff0000;'";}?>>5</option>
							<option value='6' <?if($slide == '6'){echo 'selected';}?> <?if(in_array('6',$m_array)){echo "style='color:#ff0000;'";}?>>6</option>
							<option value='7' <?if($slide == '7'){echo 'selected';}?> <?if(in_array('7',$m_array)){echo "style='color:#ff0000;'";}?>>7</option>
							<option value='8' <?if($slide == '8'){echo 'selected';}?> <?if(in_array('8',$m_array)){echo "style='color:#ff0000;'";}?>>8</option>
							<option value='9' <?if($slide == '9'){echo 'selected';}?> <?if(in_array('9',$m_array)){echo "style='color:#ff0000;'";}?>>9</option>
							<option value='10' <?if($slide == '10'){echo 'selected';}?> <?if(in_array('10',$m_array)){echo "style='color:#ff0000;'";}?>>10</option>
							<option value='11' <?if($slide == '11'){echo 'selected';}?> <?if(in_array('11',$m_array)){echo "style='color:#ff0000;'";}?>>11</option>
							<option value='12' <?if($slide == '12'){echo 'selected';}?> <?if(in_array('12',$m_array)){echo "style='color:#ff0000;'";}?>>12</option>
							<option value='13' <?if($slide == '13'){echo 'selected';}?> <?if(in_array('13',$m_array)){echo "style='color:#ff0000;'";}?>>13</option>
							<option value='14' <?if($slide == '14'){echo 'selected';}?> <?if(in_array('14',$m_array)){echo "style='color:#ff0000;'";}?>>14</option>
							<option value='15' <?if($slide == '15'){echo 'selected';}?> <?if(in_array('15',$m_array)){echo "style='color:#ff0000;'";}?>>15</option>
							<option value='16' <?if($slide == '16'){echo 'selected';}?> <?if(in_array('16',$m_array)){echo "style='color:#ff0000;'";}?>>16</option>
							<option value='17' <?if($slide == '17'){echo 'selected';}?> <?if(in_array('17',$m_array)){echo "style='color:#ff0000;'";}?>>17</option>
							<option value='18' <?if($slide == '18'){echo 'selected';}?> <?if(in_array('18',$m_array)){echo "style='color:#ff0000;'";}?>>18</option>
							<option value='19' <?if($slide == '19'){echo 'selected';}?> <?if(in_array('19',$m_array)){echo "style='color:#ff0000;'";}?>>19</option>
							<option value='20' <?if($slide == '20'){echo 'selected';}?> <?if(in_array('20',$m_array)){echo "style='color:#ff0000;'";}?>>20</option>
						</select> (붉은색으로 표시된 부분은 등록된 상품이 있는경우입니다)
					</td>
				</tr>








		<?
			$msql = "select * from ks_product where cade01='$cade01' and main!=''";
			$mresult = mysql_query($msql);
			$mnum = mysql_num_rows($mresult);
			$m_array = Array();

			for($i=0; $i<$mnum; $i++){
				$mrow = mysql_fetch_array($mresult);
				$m = $mrow['main'];
				$m_array[] = $m;
			}
		?>
				<tr> 
					<td class='tab_tit'><?=$chk_icon02?> 메인상품</td>
					<td class='tab' colspan='3'>
						<select name='main'>
							<option value=''>==</option>
							<option value='1' <?if($main == '1'){echo 'selected';}?> <?if(in_array('1',$m_array)){echo "style='color:#ff0000;'";}?>>1</option>
							<option value='2' <?if($main == '2'){echo 'selected';}?> <?if(in_array('2',$m_array)){echo "style='color:#ff0000;'";}?>>2</option>
							<option value='3' <?if($main == '3'){echo 'selected';}?> <?if(in_array('3',$m_array)){echo "style='color:#ff0000;'";}?>>3</option>
							<option value='4' <?if($main == '4'){echo 'selected';}?> <?if(in_array('4',$m_array)){echo "style='color:#ff0000;'";}?>>4</option>
							<option value='5' <?if($main == '5'){echo 'selected';}?> <?if(in_array('5',$m_array)){echo "style='color:#ff0000;'";}?>>5</option>
							<option value='6' <?if($main == '6'){echo 'selected';}?> <?if(in_array('6',$m_array)){echo "style='color:#ff0000;'";}?>>6</option>
							<option value='7' <?if($main == '7'){echo 'selected';}?> <?if(in_array('7',$m_array)){echo "style='color:#ff0000;'";}?>>7</option>
							<option value='8' <?if($main == '8'){echo 'selected';}?> <?if(in_array('8',$m_array)){echo "style='color:#ff0000;'";}?>>8</option>
							<option value='9' <?if($main == '9'){echo 'selected';}?> <?if(in_array('9',$m_array)){echo "style='color:#ff0000;'";}?>>9</option>
							<option value='10' <?if($main == '10'){echo 'selected';}?> <?if(in_array('10',$m_array)){echo "style='color:#ff0000;'";}?>>10</option>
							<option value='11' <?if($main == '11'){echo 'selected';}?> <?if(in_array('11',$m_array)){echo "style='color:#ff0000;'";}?>>11</option>
							<option value='12' <?if($main == '12'){echo 'selected';}?> <?if(in_array('12',$m_array)){echo "style='color:#ff0000;'";}?>>12</option>
							<option value='13' <?if($main == '13'){echo 'selected';}?> <?if(in_array('13',$m_array)){echo "style='color:#ff0000;'";}?>>13</option>
							<option value='14' <?if($main == '14'){echo 'selected';}?> <?if(in_array('14',$m_array)){echo "style='color:#ff0000;'";}?>>14</option>
							<option value='15' <?if($main == '15'){echo 'selected';}?> <?if(in_array('15',$m_array)){echo "style='color:#ff0000;'";}?>>15</option>
							<option value='16' <?if($main == '16'){echo 'selected';}?> <?if(in_array('16',$m_array)){echo "style='color:#ff0000;'";}?>>16</option>
						<?
							if($cade01 == '여성한복'){
						?>
							<option value='17' <?if($main == '17'){echo 'selected';}?> <?if(in_array('17',$m_array)){echo "style='color:#ff0000;'";}?>>17</option>
							<option value='18' <?if($main == '18'){echo 'selected';}?> <?if(in_array('18',$m_array)){echo "style='color:#ff0000;'";}?>>18</option>
							<option value='19' <?if($main == '19'){echo 'selected';}?> <?if(in_array('19',$m_array)){echo "style='color:#ff0000;'";}?>>19</option>
							<option value='20' <?if($main == '20'){echo 'selected';}?> <?if(in_array('20',$m_array)){echo "style='color:#ff0000;'";}?>>20</option>
							<option value='21' <?if($main == '21'){echo 'selected';}?> <?if(in_array('21',$m_array)){echo "style='color:#ff0000;'";}?>>21</option>
							<option value='22' <?if($main == '22'){echo 'selected';}?> <?if(in_array('22',$m_array)){echo "style='color:#ff0000;'";}?>>22</option>
							<option value='23' <?if($main == '23'){echo 'selected';}?> <?if(in_array('23',$m_array)){echo "style='color:#ff0000;'";}?>>23</option>
							<option value='24' <?if($main == '24'){echo 'selected';}?> <?if(in_array('24',$m_array)){echo "style='color:#ff0000;'";}?>>24</option>
						<?
							}
						?>
						</select> (붉은색으로 표시된 부분은 등록된 상품이 있는경우입니다)
					</td>
				</tr>


				<tr> 
					<td class='tab_tit'><?=$chk_icon02?> 아이콘</td>
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
					<td class='tab_tit'><?=$chk_icon01?> 상품이미지</td>
					<td class='tab' colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
					<?
						if($upfile01){
							$imgFile = $path.'thumb_'.$upfile01;
							if(!is_file($imgFile))	$imgFile = $path.$upfile01;

							$resize = Util::AutoImgSize($imgFile,$size01,$size02);
					?>
							<tr>
								<td><img src='<?=$imgFile?>' <?=$resize?>></td>
							</tr>
					<?
						}
					?>
							<tr>
								<td><input type='file' name='upfile01' class='file01' style='width:310px;'>&nbsp;(가로:356px * 세로:500px)</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr> 
					<td class='tab_tit'><?=$chk_icon02?> 상세설명 상단이미지<br>(<?=$cade01?> 공통이미지)</td>
					<td class='tab' colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
					<?
						if($upfile02){
							$imgFile = $path.'thumb_'.$upfile02;
							if(!is_file($imgFile))	$imgFile = $path.$upfile02;

							$resize = Util::AutoImgSize($imgFile,1150,1150);
					?>
							<tr>
								<td><img src='<?=$imgFile?>' <?=$resize?>> <input type='checkbox' name='del_upfile02' value='Y'>삭제</td>
							</tr>
					<?
						}
					?>
							<tr>
								<td><input type='file' name='upfile02' class='file01' style='width:310px;'>&nbsp;(가로:1150px * 제한없음)</td>
							</tr>
						</table>
					</td>
				</tr>




			</table>
		</td>
	</tr>
	<!-- /필수정보 -->




	<tr>
		<td style='padding:30px 0px 0px 0px;color:#666666;font-size:16px;font-weight:bold;'>* 상세설명</td>
	</tr>
	<tr>
		<td><textarea name="ment" id="ment" style='width:100%;height:400px;'><?=$ment?></textarea></td>
	</tr>
	
	
	<tr>
		<td style='padding:50px 0px 0px 0px;'>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides">
				<tr> 
					<td bgcolor="cccccc"  height="1" style='padding:1px 0px 0px 0px;' colspan="4"></td>
				</tr>
				<tr> 
					<td width='17%' class='tab_tit'><?=$chk_icon02?> 상세설명 하단이미지#1<br>(<?=$cade01?> 공통이미지)</td>
					<td width='83%' class='tab'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
					<?
						if($upfile03){
							$imgFile = $path.'thumb_'.$upfile03;
							if(!is_file($imgFile))	$imgFile = $path.$upfile03;

							$resize = Util::AutoImgSize($imgFile,1150,1150);
					?>
							<tr>
								<td><img src='<?=$imgFile?>' <?=$resize?>> <input type='checkbox' name='del_upfile03' value='Y'>삭제</td>
							</tr>
					<?
						}
					?>
							<tr>
								<td><input type='file' name='upfile03' class='file01' style='width:310px;'>&nbsp;(가로:1150px * 제한없음)</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr> 
					<td class='tab_tit'><?=$chk_icon02?> 상세설명 하단이미지#2<br>(<?=$cade01?> 공통이미지)</td>
					<td class='tab'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
					<?
						if($upfile04){
							$imgFile = $path.'thumb_'.$upfile04;
							if(!is_file($imgFile))	$imgFile = $path.$upfile04;

							$resize = Util::AutoImgSize($imgFile,1150,1150);
					?>
							<tr>
								<td><img src='<?=$imgFile?>' <?=$resize?>> <input type='checkbox' name='del_upfile04' value='Y'>삭제</td>
							</tr>
					<?
						}
					?>
							<tr>
								<td><input type='file' name='upfile04' class='file01' style='width:310px;'>&nbsp;(가로:1150px * 제한없음)</td>
							</tr>
						</table>
					</td>
				</tr>	
			</table>
		</td>
	</tr>
	
	
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






<!------------------------------------ 미니달력 ------------------------------------>
<div id='CalendarLayer' style="position:absolute; display:none; z-index:1; background-color:#FFFFFF;">
<table cellpadding='0' cellspacing='0' border='0' style='border:2px solid #cccccc;'>
	<tr>
		<td><iframe name='ifra_cal' src='about:blank' width='220' height='265' frameborder='0' scrolling='no'></iframe></td>
	</tr>
</table>
</div>
<!------------------------------------ /미니달력 ------------------------------------>




<script type="text/javascript">

var oEditors = [];

nhn.husky.EZCreator.createInIFrame({

    oAppRef: oEditors,

    elPlaceHolder: "ment",

    sSkinURI: "/smarteditor/SmartEditor2Skin.html",

    fCreator: "createSEditor2"

});

</script>