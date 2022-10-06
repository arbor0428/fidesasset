<style type='text/css'>
input[type="checkbox"]{width:15px;height:15px;cursor:pointer;}
</style>

<ul class="pc pr_list_ttltop" id='pr_info2'>
	<li>강좌명</li>
	<li>요일 / 시간</li>
	<li>수강료</li>
</ul><!--pr_list_ttltop end-->


<ul class="pr_li_con" id='pr_info0'>
<?
$proList = '';	//신청강좌 uid

$programAmt = 0;		//총강좌료
$saleAmt = 0;			//할인금액
$payAmt = 0;			//최종결제금액


if($total_record){
	for($i=0; $i<$total_record; $i++){
		$pid = $pArr[$i];
		if($proList)	$proList .= ',';
		$proList .= $pid;

		$sql = "select * from ks_program where uid='$pid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$title = $row["title"];						//강좌명
		$season = $row["season"];			//학기
		$cade01 = $row["cade01"];			//분류
		$mTarget = $row["mTarget"];			//대상
		$fitnessType = $row["fitnessType"];	//휘트니스 이용권구분
		$yoilList = $row["yoilList"];				//강좌요일
		$sEduHour = $row["sEduHour"];		//강의시작시간
		$sEduMin = $row["sEduMin"];
		$eEduHour = $row["eEduHour"];		//강의종료시간
		$eEduMin = $row["eEduMin"];
		$eTime01 = $row["eTime01"];		//교육기간
		$eTime02 = $row["eTime02"];
		$eduNum = $row["eduNum"];			//교육횟수
		$amt = $row["amt"];						//금액
		$upfile01 = $row["upfile01"];			//강의계획서

		if($season == '상시' && $cade01 == '휘트니스센터'){
			if($fitnessType == '1day')			$yoilList = '일일권';
			elseif($fitnessType == '1month')	$yoilList = '1개월권';
			elseif($fitnessType == '3month')	$yoilList = '3개월권';
			elseif($fitnessType == '6month')	$yoilList = '6개월권';

			$eduTime = '';
			$eduDate = '';
			$eduNumTxt = '';

		}else{
			$yoilList = str_replace('0','일',$yoilList);
			$yoilList = str_replace('1','월',$yoilList);
			$yoilList = str_replace('2','화',$yoilList);
			$yoilList = str_replace('3','수',$yoilList);
			$yoilList = str_replace('4','목',$yoilList);
			$yoilList = str_replace('5','금',$yoilList);
			$yoilList = str_replace('6','토',$yoilList);

			$eduTime = $sEduHour.':'.$sEduMin.' ~ '.$eEduHour.':'.$eEduMin;
			$eduDate = '<br>'.date('Y-m-d',$eTime01).' ~ '.date('Y-m-d',$eTime02);
			$eduNumTxt = number_format($eduNum).'회<br>';
		}

		$amtTxt = number_format($amt).'원';

		//총강좌료
		$programAmt += $amt;

		//할인금액
		if($rate){
			$saleAmt += round($amt * ($rate/100));
		}
?>
	<li class="clearfix">
		<a class="pr_name prfl prtxt prw1" href="#">
		<table class="pr_name_table">
			<tr>
				<td>[<?=$mTarget?>] <?=$title?></td>
			</tr>
		</table>
		</a>
		
		<div class="pr_time prfl prtxt prw3">
			<table class="pr_name_table">
				<tr>
					<td><?=$yoilList?> <?=$eduTime?> <?=$eduDate?></td>
				</tr>
			</table>
		</div>
		<div class="pr_ok prfl prtxt prw4">
			<table class="pr_name_table">
				<tr>
					<td><?=$eduNumTxt?><?=$amtTxt?></td>
				</tr>
			</table>
		</div>
	</li>
<?
	}

	//최종결제금액
	$payAmt = $programAmt - $saleAmt;
}else{
?>
	<li style="padding:100px 0 80px 0;text-align:center;">강좌가 없습니다.</li>
<?
}
?>

</ul>


<?
if($total_record){
	$programAmtTxt = number_format($programAmt).'원';
	$saleAmtTxt = number_format($saleAmt).'원';
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
			할인금액
		</div>

		<div class="pttpcon">
			- <?=$saleAmtTxt?>
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




<table cellpadding='0' cellspacing='0' border='0' width='100%' class='formTable' style='margin-top:30px;background-color:#fff'>
	<tr>
		<th width='17%'><div class='eqc'>*</div>결제수단</th>
		<td width='33%'>
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
							<input type="checkbox" value="현금" id="pT2" name="payMode" onclick='setChkBox(this.name,1);'>
							<label for="pT2"></label>
						</div>
						<p style='margin:3px 0 0 25px;'><span class='ico03'>현금</span></p>
					</td>
				</tr>
			</table>
		</td>

		</tr>
		 </table>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='formTable billtb' style='margin-top:30px;background-color:#fff;display:none'>
	<tr>
		<th width='17%'><span id='payColumn'></span></th>
		<td width='33%'>
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


<!--현금 선택시만 영수증나옴-->
<script type="text/javascript">
$('.billtb').hide();

$('.bill_00').click(function() {
   if($('#pT2').is(':checked')) {
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