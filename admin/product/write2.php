<?
	$sql = "select * from ks_brochure where uid=1";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$uid = $row['uid'];

	$upfile01 = $row['upfile01'];
	$realfile01 = $row['realfile01'];
	$upfile02 = $row['upfile02'];
	$realfile02 = $row['realfile02'];

	$link02 = $row['link02'];
	$upfile03 = $row['upfile03'];
	$realfile03 = $row['realfile03'];
	$upfile04 = $row['upfile04'];
	$realfile04 = $row['realfile04'];

	$link03 = $row['link03'];
	$upfile05 = $row['upfile05'];
	$realfile05 = $row['realfile05'];
	$upfile06 = $row['upfile06'];
	$realfile06 = $row['realfile06'];

	$link04 = $row['link04'];
	$upfile07 = $row['upfile07'];
	$realfile07 = $row['realfile07'];
	$upfile08 = $row['upfile08'];
	$realfile08 = $row['realfile08'];

	$link05 = $row['link05'];
	$upfile09 = $row['upfile09'];
	$realfile09 = $row['realfile09'];
	$link10 = $row['link10'];
	$upfile10 = $row['upfile10'];
	$realfile10 = $row['realfile10'];

	include 'script.php';
?>


<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='edit'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='up_index2.php'>

<input type='hidden' name='dbfile01' value='<?=$upfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>
<input type='hidden' name='dbfile02' value='<?=$upfile02?>'>
<input type='hidden' name='realfile02' value='<?=$realfile02?>'>
<input type='hidden' name='dbfile03' value='<?=$upfile03?>'>
<input type='hidden' name='realfile03' value='<?=$realfile03?>'>
<input type='hidden' name='dbfile04' value='<?=$upfile04?>'>
<input type='hidden' name='realfile04' value='<?=$realfile04?>'>
<input type='hidden' name='dbfile05' value='<?=$upfile05?>'>
<input type='hidden' name='realfile05' value='<?=$realfile05?>'>
<input type='hidden' name='dbfile06' value='<?=$upfile06?>'>
<input type='hidden' name='realfile06' value='<?=$realfile06?>'>
<input type='hidden' name='dbfile07' value='<?=$upfile07?>'>
<input type='hidden' name='realfile07' value='<?=$realfile07?>'>
<input type='hidden' name='dbfile08' value='<?=$upfile08?>'>
<input type='hidden' name='realfile08' value='<?=$realfile08?>'>
<input type='hidden' name='dbfile09' value='<?=$upfile09?>'>
<input type='hidden' name='realfile09' value='<?=$realfile09?>'>
<input type='hidden' name='dbfile10' value='<?=$upfile10?>'>
<input type='hidden' name='realfile10' value='<?=$realfile10?>'>



<div style='width:1000px;'>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
	<tr>
		<th colspan='3'>
			<span style='color:#ff0000;font-size:16px;line-height:24px;'>
			※ PDF 파일만 등록이 가능합니다.
			</span>
		</th>
	</tr>
<?
	$n = 1;

	for($i=1; $i<=2; $i++){
		$ino = sprintf('%02d',$i);
		$no = sprintf('%02d',$n);
		$upfile = ${'upfile'.$no};
		$realfile = ${'realfile'.$no};
		if($i==1){
			$fileTxt='일반의약품 브로셔';
		}else{
			$fileTxt='전문의약품 브로셔';
		}

		$n++;
?>
		<tr>
			<th width='17%'><?=$fileTxt?></th>
			<th>첨부파일</th>
			<td>
				<table cellpadding='0' cellspacing='0' border='0'>

					<tr>
						<td>
							<div class="file_input">
								<input type="text" readonly title="File Route" id="file_route<?=$no?>" style="width:250px;padding:0 0 0 10px;" placeholder="PDF 파일만 등록이 가능합니다.">
								<label>파일선택<input type="file" name="upfile<?=$no?>" id="upfile<?=$no?>" onchange="fileChk2('<?=$no?>');"></label>
							</div>
						</td>
					<?
						if($upfile){
					?>
						<td style='padding:0 0 0 10px;'>
							<div class="squaredThree">
								<input type="checkbox" value="Y" id="fDel<?=$no?>" name="del_upfile<?=$no?>">
								<label for="fDel<?=$no?>"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>삭제&nbsp;&nbsp;(<?=$realfile?>)</p>
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


	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td align='center' style='padding:30px 0;'>
				<a href="javascript:check_form2();" class='big cbtn blue'>저장</a>
			</td>
		</tr>
	</table>


</div>

</form>