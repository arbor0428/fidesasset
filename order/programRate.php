<?
	//제이쿼리 달력
	$sRange = date('Y') - 2017;
	$eRange = '1';

	//취소버튼활성화 ID
	$cancleBtnID = "";

	include '../module/Calendar.php';

	$getDate = date('Y-m-d');
	$getArr = explode('-',$getDate);
	$getTime = mktime(0,0,0,$getArr[1],$getArr[2],$getArr[0]);
?>

<style type='text/css'>
input[type="checkbox"]{width:15px;height:15px;cursor:pointer;}

.plus_ex{
	width: 100%;
	border-top: 1px solid #a2a2a2;
	border-bottom: 1px solid #d2d2d2;
	margin-top: 30px;
	background-color:#fff;
}

.pe_ttl{
	width:100%;
	font-size: 14px;
	text-align: center;
	background-color: #f7f7f7;
	line-height: 40px;
	height: 40px;
}

.pe_con{
	text-align:center;
	padding:15px 0;
	font-size:14px;
	background-color:#FFF;
}

.packageBox { padding:5px; border:2px solid #0081ba; border-radius:3px; background-color:#fff; position:absolute; display:none; margin-top:-20px;margin-left:150px;}        
.packageBox:after, .packageBox:before {
	right: 100%;
	top: 10px;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
}

.packageBox:after {
	border-color: rgba(252, 252, 252, 0);
	border-right-color: #fff;
	border-width: 5px;
	margin-top: -5px;
}
.packageBox:before {
	border-color: rgba(255, 101, 89, 0);
	border-right-color: #0081ba;
	border-width: 8px;
	margin-top: -8px;
}

.packageContent { width:100%; position:relative; color:#666; line-height:135%;}

#packageMent{font-family:'NanumGothic'; font-size:14px;}
</style>

<script language='javascript'>
function VaccConfirm(){
	document.getElementById("confirmTxt").innerText = '가상계좌 환불의 경우 수수료가 발생할 수 있습니다.';
	document.getElementById("conFirmCloseBtn").innerHTML = "";
	document.getElementById("confirmCancelBtn").innerHTML = "<input type='button' class='btn_notice_reg_cancel' value='동의안함' onclick='$(\"#pT2\").prop(\"checked\", false);'>";
	document.getElementById("confirmBtn").innerHTML = "<input type='button' class='btn_notice_reg_add' value='동의함'>";

	$(".conFirm_open").click();
	return;
}

//패키지 선택시 전체수강료 계산
function setAmt(){
	proList = $("#proList").val();
	proArr = proList.split(',');
	proCnt = proArr.length;

	programTot = 0;
	saleTot = 0;
	payTot = 0;

	for(i=0; i<proCnt; i++){
		pid = proArr[i];
		c = $("#package_"+pid).is(":checked");		

		programAmt = 0;

		if(c){
			weeKNum = $("#package_"+pid).val();

			if(weeKNum == 2)			programAmt = '50000';
			else if(weeKNum == 3)	programAmt = '70000';

		}else{
			programAmt = $("#programOmt"+pid).val();
		}

		//총강좌료
		programTot += parseInt(programAmt);

		//패키지신청시 감면적용하지 않는다.
		if(c == false){
			//감면액
			rate = $('#rate').val();
			rateID = $("#rateChk option:selected").val();

			//감면적용
			if(rate && (rateID == pid)){
				saleTot = Math.round(programAmt * (rate/100));
				programAmt -= saleTot;
			}
		}

		//프로그램별 수강료
		programAmtTxt = number_format(programAmt)+'원';
		$("#programAmtDiv_"+pid).text(programAmtTxt);
	}

	//총강좌료
	programAmtTotTxt = number_format(programTot)+'원';
	$("#programAmtTot").text(programAmtTotTxt);


	if(saleTot)	saleAmtTotTxt = '- '+number_format(saleTot)+'원';
	else			saleAmtTotTxt = '-';

	$("#saleAmtTot").text(saleAmtTotTxt);

	//최종결제금액
	payTot = programTot - saleTot;
	payAmtTotTxt = number_format(payTot)+'원';
	$("#payAmtTot").text(payAmtTotTxt);
	$("#payAmt").val(payTot);
}

function packageOpen(pid){
	$('#packageBox'+pid).fadeIn("fast");
}

function packageClose(){
	$('.packageBox').hide();
}
</script>



<ul class="pc pr_list_ttltop" id='pr_info2'>
	<li>강좌명</li>
	<li>요일 / 시간</li>
	<li>수강료</li>
</ul><!--pr_list_ttltop end-->

<ul class="pr_li_con" id='pr_info0'>
<?
//신청한 강좌내역
$osql = "select * from ks_userClass where userid='$GBL_USERID' and reFund=''";
$oresult = mysql_query($osql);
$onum = mysql_num_rows($oresult);

$oArr = Array();

for($o=0; $o<$onum; $o++){
	$orow = mysql_fetch_array($oresult);
	$oArr[$o] = $orow['programID'];
}


$proList = '';	//신청강좌 uid

$programAmt = 0;		//총강좌료
$saleAmt = 0;			//할인금액
$payAmt = 0;			//최종결제금액
$ment = '';

$fitnessNo = 1;		//휘트니스 강좌의 이용시작일 ID

$research = '';

//감면적용 selectbox option용
$titleArr = Array();
$rateChkAmt = 0;
$rateChkID = '';		//신청하는 강좌중 가장 높은 수강료의 강좌 자동선택

if($total_record){
	for($i=0; $i<$total_record; $i++){
		$pid = $pArr[$i];
		$etcAmt = $etcArr[$i];
		$cid = $cidArr[$i];

		$sql = "select * from ks_program where uid='$pid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$package = $row["package"];			//헬스 패키지
		$title = $row["title"];						//강좌명
		$season = $row["season"];			//학기
		$cade01 = $row["cade01"];			//분류
		$period = $row["period"];				//기간
		$fitnessType = $row["fitnessType"];	//휘트니스 이용권구분
		$yoilList = $row["yoilList"];				//강좌요일
		$sEduHour = $row["sEduHour"];		//강의시작시간
		$sEduMin = $row["sEduMin"];
		$eEduHour = $row["eEduHour"];		//강의종료시간
		$eEduMin = $row["eEduMin"];
		$oneAmt = $row['oneAmt'];
		$eduNum = $row['eduNum'];
		$eTime01 = $row["eTime01"];		//교육기간
		$eTime02 = $row["eTime02"];
		$maxNum = $row["maxNum"];		//정원
		$amt = $row["amt"];						//금액
		$ment02 = $row["ment02"];			//비고

		//2019-08-15 ~ 2019-08-31 설문지
		if($season == '가을'){
			if($cade01 == '사회교육(가을)' && $period == '9월프로그램')				$research = '1';
			elseif($cade01 == '사회교육(가을)' && $period == '가을학기프로그램')	$research = '1';
			elseif($cade01 == '사회체육(가을)' && $period == '9월프로그램')			$research = '1';
		}

		//개별프로그램 등록시 설정된 수강료
		if($etcAmt)	$amt = $etcAmt;

		//마감여부
		$fullChk = false;

		//수강신청여부
		$myClass = false;

		//휘트니스 프로그램용 필드
		$fitnessChk = false;

		if($season == '상시' && $cade01 == '휘트니스센터'){
			if($fitnessType == '1day')			$yoilList = '일일권';
			elseif($fitnessType == '1month')	$yoilList = '1개월권';
			elseif($fitnessType == '3month')	$yoilList = '3개월권';
			elseif($fitnessType == '6month')	$yoilList = '6개월권';

			$eduTime = '';

			$fitnessChk = true;


		}else{
			if($etcAmt){
				//수강신청일을 기준으로 지난 교육을 제외한 남은 교육횟수
				$realNum = Util::classOrderChk($eTime01,$eTime02,$yoilList,$getTime);

				//남은 교육횟수 * 프로그램 회당단가
//				if($realNum < $eduNum)	$amt = $realNum * $oneAmt;
			}

			$yoilList = str_replace('0','일',$yoilList);
			$yoilList = str_replace('1','월',$yoilList);
			$yoilList = str_replace('2','화',$yoilList);
			$yoilList = str_replace('3','수',$yoilList);
			$yoilList = str_replace('4','목',$yoilList);
			$yoilList = str_replace('5','금',$yoilList);
			$yoilList = str_replace('6','토',$yoilList);

			if($sEduHour && $eEduHour)	$eduTime = '<br>'.$sEduHour.':'.$sEduMin.' ~ '.$eEduHour.':'.$eEduMin;
			else									$eduTime = '';

			//해당 강좌를 신청/납부한 회원 수
//			$osql = "select count(*) from ks_userClass where programID='$pid' and reFund='' and (payMode='단말기' || payMode='신용카드' || payMode='현금' || payMode='현금' || payAmt=0 || payOk='결제확인')";
			$osql = "select count(*) from ks_userClass where programID='$pid' and reFund='' and (payMode!='' || payOk='결제확인')";
			$oresult = mysql_query($osql);
			$cnt01 = mysql_result($oresult,0,0);
			$userNumTxt = number_format($cnt01).'명';

			//설정된 정원이 있는 경우
			if($maxNum){
				$userNumTxt .= ' / '.number_format($maxNum).'명';

				//마감처리
				if($cnt01 >= $maxNum)		$fullChk = true;
			}

			//상시프로그램은 중복신청이 가능함
			if($season != '상시'){
				if(in_array($pid,$oArr))	$myClass = true;
			}
		}

		//마감된 강좌는 미표시처리
		if(!$fullChk && !$myClass){
			if($proList)	$proList .= ',';
			$proList .= $pid;

			$amtTxt = number_format($amt).'원';

			//총강좌료
			$programAmt += $amt;

			//비고
			if($ment02){
				if($ment)		$ment .= "<br><br>";
				$ment .= "[$title]<br>$ment02";
			}

			if($fitnessChk)	$div_pd = "style='margin-bottom:15px;'";
			else				$div_pd = '';

			if($season == '상시' && $cade01 == '한마음심리상담센터'){
			}else{
				//감면적용
				$titleArr[$i] = $title;
				if($amt > $rateChkAmt){
					$rateChkAmt = $amt;
					$rateChkID = $pid;
				}
			}
?>
	<li class="clearfix">
		<input type='hidden' name='programOmt<?=$pid?>' id='programOmt<?=$pid?>' value='<?=$amt?>'>

		<input type='hidden' name='programAmt<?=$pid?>' id='programAmt<?=$pid?>' value='<?=$amt?>'>
		<input type='hidden' name='etcAmt_<?=$pid?>' id='etcAmt_<?=$pid?>' value='<?=$etcAmt?>'>
		<input type='hidden' name='cid_<?=$pid?>' id='cid_<?=$pid?>' value='<?=$cid?>'>
<!--
		<a class="pr_name prfl prtxt prw1" href="javascript://" style='cursor:default;'>
-->
		<div class="pr_name prfl prtxt prw1" <?=$div_pd?>>
			<table class="pr_name_table">
				<tr>
					<td><?=$title?></td>
				</tr>
			<?
				if($fitnessChk){
			?>
				<tr>
					<td style="font-weight:normal;padding-bottom:10px !important;"><input type='text' name='fitnessDate_<?=$pid?>' id='fpicker<?=$fitnessNo?>' value='<?=date('Y-m-d')?>' readonly style="width:100px;height:25px;"> 부터 이용</td>
				</tr>
			<?
					$fitnessNo++;

				}elseif($package){
					$weeKNum = count(explode(',',$yoilList));
			?>
				<tr>
					<td>
						<table cellpadding='0' cellspacing='0' border='0' style='margin:0 auto;'>
							<tr>
								<td>
									<label class="pr_link" style='height:20px !important;line-height:20px !important;border:1px solid #d2d2d2 !important;' onMouseOver="packageOpen('<?=$pid?>');" onmouseout="packageClose();">
										<input required type='checkbox' class="cms2_1" name='package_<?=$pid?>' id='package_<?=$pid?>' value="<?=$weeKNum?>" onclick="setAmt();">
										<div class="box_radio" style="font-weight:normal;padding:0 5px !important;cursor:pointer;">헬스 1개월 패키지신청</div>

										<div class="packageBox" id="packageBox<?=$pid?>">
											<div class="packageContent">
												<p id="packageMent" style='line-height:20px;'>
													주2회 체육강좌 + 헬스(1개월) = 50,000원<br>
													주3회 체육강좌 + 헬스(1개월) = 70,000원
												</p>
											</div>
										</div>
									</label>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			<?
				}
			?>
			</table>
		</div>
		
		<div class="pr_time prfl prtxt prw3">
			<table class="pr_name_table">
				<tr>
					<td><?=$yoilList?> <?=$eduTime?></td>
				</tr>
			</table>
		</div>
		<div class="pr_ok prfl prtxt prw4">
			<table class="pr_name_table">
				<tr>
					<td id="programAmtDiv_<?=$pid?>"><?=$amtTxt?></td>
				</tr>
			</table>
		</div>
	</li>
<?
		}
	}

	//최종결제금액
	$payAmt = $programAmt - $saleAmt;
}else{
?>
	<li style="padding:100px 0 80px 0;text-align:center;">강좌 정보가 없습니다.</li>
<?
}
?>

</ul>


<?
	//비고 내용이 있을 경우에만 표시
	if($ment){
?>
<div class='plus_ex'>
	<div class="pe_ttl">추가안내사항</div>
	<div class="pe_con"><?=$ment?></div>
</div>
<?
	}
?>



<?
if($total_record){
	$programAmtTxt = number_format($programAmt).'원';

	if($saleAmt)		$saleAmtTxt = ' -'.number_format($saleAmt).'원';
	else				$saleAmtTxt = '-';

	$payAmtTxt = number_format($payAmt).'원';
?>

<input type="hidden" name="proList" id="proList" value="<?=$proList?>">
<input type="hidden" name="payAmt" id="payAmt" value="<?=$payAmt?>">

<ul class="pro_tprice clearfix" >
	<li style="background:#fff">
		<div class="pttpttl">
			총 강좌료
		</div>

		<div class="pttpcon" id="programAmtTot">
			<?=$programAmtTxt?>
		</div>
	</li>

	<li style="background:#fff">
		<div class="pttpttl">
			감면액
		</div>

		<div class="pttpcon" id="saleAmtTot">
			<?=$saleAmtTxt?>
		</div>
	</li>

	<li>
		<div class="pttpttl redbg">
			 최종결제금액
		</div>

		<div class="pttpcon redbg2 laspr"  id="payAmtTot">
			<?=$payAmtTxt?>
		</div>
	</li>	
</ul>


<table cellpadding='0' cellspacing='0' border='0' width='100%' class='formTable' style='margin-top:30px;background-color:#fff'>
	<tr>
		<th width='30%'><div class='eqc'>*</div>감면적용</th>
		<td width='70%'>
			<select name='rateChk' id='rateChk' onchange='setAmt();' style='height:30px;padding:5px !important;'>
		<?
			$titleNum = count($titleArr);
			if($titleNum > 0){
		?>
				<option value=''>적용안함</option>
		<?
				for($i=0; $i<count($pArr); $i++){
					$rateTitle = $titleArr[$i];
					$rateID = $pArr[$i];

					if($rateTitle){
						echo ("<option value='$rateID'>$rateTitle</option>");
					}
				}
			}else{
				echo ("<option value=''>해당없음</option>");
			}
		?>
			</select>
		</td>
	</tr>
	<tr>
		<th><div class='eqc'>*</div>결제수단</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td>
						<div class="squaredThree bill_01">
							<input type="checkbox" value="신용카드" id="pT1" name="payMode" onclick='setChkBox(this.name,0);'>
							<label for="pT1"></label>
						</div>
						<p style='margin:3px 0 0 25px;'><span class='ico04'>신용카드</span></p>
					</td>
					<td style='padding:0 0 0 40px;'>
						<div class="squaredThree bill_00">
							<input type="checkbox" value="가상계좌" id="pT2" name="payMode" onclick='setChkBox(this.name,1);'>
							<label for="pT2"></label>
						</div>
						<p style='margin:3px 0 0 25px;'><span class='ico06'>가상계좌</span></p>
					</td>
				<!--
					<td style='padding:0 0 0 40px;'>
						<div class="squaredThree bill_00">
							<input type="checkbox" value="현금" id="pT3" name="payMode" onclick='setChkBox(this.name,2);'>
							<label for="pT3"></label>
						</div>
						<p style='margin:3px 0 0 25px;'><span class='ico10'>현금</span></p>
					</td>
				-->
				</tr>
			</table>
		</td>
	</tr>
</table>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable' style='margin-top:30px;background-color:#fff;display:none'>
	<tr>
		<th width='30%'><span id='payColumn'></span></th>
		<td width='70%'>
			<div id='cashDiv' style="display:none;">
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="squaredThree">
								<input type="checkbox" value="발행" id="cT1" name="cashBill" onclick='setChkBill(this.name,0);'>
								<label for="cT1"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>발행</p>
						</td>
						<td style='padding:0 0 0 20px;'>
							<div class="squaredThree">
								<input type="checkbox" value="미발행" id="cT2" name="cashBill" onclick='setChkBill(this.name,1);'>
								<label for="cT2"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>미발행</p>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>




<div class="form_btn_wrap">
	<div class="fbw1 fbw"><a href="javascript:check_form();">신청하기</a></div>
	<div class="fbw2 fbw"><a href="javascript:history.back(-1);">뒤&nbsp;&nbsp;&nbsp;&nbsp;로</a></div>
</div>

<?
}
?>

<script>
$(document).ready(function () {
	$("#rateChk").val("<?=$rateChkID?>").attr("selected", "selected");
	setAmt();
});
</script>


<!--현금 선택시만 영수증나옴-->
<script type="text/javascript">

$('.billtb').hide();

$('.bill_00').click(function() {
   if($('#pT3').is(':checked')) {
  $('.billtb').show();
   }else if($('#pT1').is(':checked')){
	$('.billtb').hide();
   }else{
   $('.billtb').hide();
   }
});

$('.bill_01').click(function() {
   if($('#pT1').is(':checked')) {
 $('.billtb').hide();
   }
});
</script>