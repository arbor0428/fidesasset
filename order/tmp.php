<?
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
</style>



<!-- 결제취소 시 돌아가기 위한 폼 -->
<form name='frm01' method='post' action='/order/up_index.php'>
<input type='text' style='display:none;'>
<input type='hidden' name='programID' value='<?=$programID?>'>
<?
	for($i=0; $i<count($chk); $i++){
		$cc = $chk[$i];
		echo ("<input type='hidden' name='chk[]' value='$cc'>");
	}
?>

<ul class="pc pr_list_ttltop" id='pr_info2'>
	<li>강좌명</li>
	<li>요일 / 시간</li>
	<li>수강료</li>
</ul><!--pr_list_ttltop end-->


<ul class="pr_li_con" id='pr_info0'>
<?

$programAmt = 0;		//총강좌료
$saleAmt = 0;			//할인금액
$payAmt = 0;			//최종결제금액
$ment = '';

$pArr = explode(',',$proList);
$total_record = count($pArr);

if($total_record){
	for($i=0; $i<$total_record; $i++){
		$pid = $pArr[$i];

		$sql = "select * from ks_program where uid='$pid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$title = $row["title"];						//강좌명
		$season = $row["season"];			//학기
		$cade01 = $row["cade01"];			//분류
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

		//개별프로그램 등록시 설정된 수강료
		$etcAmt = ${'etcAmt_'.$pid};
		if($etcAmt)	$amt = $etcAmt;

		//패키지신청
		$package = ${'package_'.$pid};
		if($package == 2)			$amt = 50000;
		elseif($package == 3)	$amt = 70000;

		//마감여부
		$fullChk = false;

		if($season == '상시' && $cade01 == '휘트니스센터'){
			if($fitnessType == '1day')			$yoilList = '일일권';
			elseif($fitnessType == '1month')	$yoilList = '1개월권';
			elseif($fitnessType == '3month')	$yoilList = '3개월권';
			elseif($fitnessType == '6month')	$yoilList = '6개월권';

			$eduTime = '';


		}else{
			//수강신청일을 기준으로 지난 교육을 제외한 남은 교육횟수
			$realNum = Util::classOrderChk($eTime01,$eTime02,$yoilList,$getTime);

			//남은 교육횟수 * 프로그램 회당단가
			if($realNum < $eduNum)	$amt = $realNum * $oneAmt;

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
//			$osql = "select count(*) from ks_userClass where programID='$pid' and reFund='' and (payMode='신용카드' || payMode='현금' || payMode='현금' || payAmt=0 || payOk='결제확인')";
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
		}

		//마감된 강좌는 미표시처리
		if(!$fullChk){
			if($proList)	$proList .= ',';
			$proList .= $pid;

			//할인금액
			if($rateChk == $pid)	$saleAmt = round($amt * ($rate/100));
			else						$saleAmt = 0;

			//총강좌료
			$programAmt += $amt;

			$amt -= $saleAmt;

			$amtTxt = number_format($amt).'원';

			//비고
			if($ment02){
				if($ment)		$ment .= "<br><br>";
				$ment .= "[$title]<br>$ment02";
			}
?>
	<li class="clearfix">
		<a class="pr_name prfl prtxt prw1" href="#">
		<table class="pr_name_table">
			<tr>
				<td><?=$title?></td>
			</tr>
		</table>
		</a>
		
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
					<td><?=$amtTxt?></td>
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

		<div class="pttpcon">
			<?=$programAmtTxt?>
		</div>
	</li>

	<li style="background:#fff">
		<div class="pttpttl">
			감면액
		</div>

		<div class="pttpcon">
			<?=$saleAmtTxt?>
		</div>
	</li>

	<li>
		<div class="pttpttl redbg">
			 최종결제금액
		</div>

		<div class="pttpcon redbg2 laspr" >
			<?=$payAmtTxt?>
		</div>
	</li>	
</ul>

<?
}
?>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='formTable' style='margin-top:30px;background-color:#fff'>
	<tr>
		<th width='30%'><div class='eqc'>*</div>성함</th>
		<td width='70%'><?=$name?></td>
	</tr>

	<tr>
		<th><div class='eqc'>*</div>핸드폰</th>
		<td><?=$phone01?></td>
	</tr>


	<tr>
		<th><div class='eqc'>*</div>결제수단</th>
		<td><?=$payMode?></td>
	</tr>
</table>

</form>