<?
include './class/class.DbCon.php';

$rDate = date('Y-m-d H:i:s');
$rTime = mktime();

$sql01 = "select * from zz_program order by uid";
$result01 = mysql_query($sql01);
$num01 = mysql_num_rows($result01);

for($i=0; $i<$num01; $i++){
	$row01 = mysql_fetch_array($result01);

//	$cade01 = $row01["cade01"];
//	$title = $row01["title"];
//	$tutor = $row01["tutor"];
	$yoil = $row01["yoil"];
	$sHour = $row01["sHour"];
	$sMin = $row01["sMin"];
	$eHour = $row01["eHour"];
	$eMin = $row01["eMin"];
//	$maxNum = $row01["maxNum"];
//	$target = $row01["target"];
	$amt = $row01["amt"];


	$online = '';
	$package = '';
	$pid = 0;
	$pTitle = '';
	$year = 2019;
	$season = '겨울';
	$cade01 = $row01["cade01"];
	$period = '겨울학기프로그램';
	$mTarget = $row01["target"];
	$mTargetEtc = $row01["target"];
	$room = '공연장';
	$title = $row01["title"];
	$fitnessType = '';
	$tutorID = '';
	$tutor = $row01["tutor"];
	$maxNum = $row01["maxNum"];
	$amt = $row01["amt"];
	$oneAmt = 0;
	$eduNum = 0;

	//기간uid
	$sql = "select * from ks_programPeriod where year='$year' and season='$season' and cade01='$cade01' and title='$period'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$periodID = $row['uid'];
	$aDate01 = $row['aDate01'];	//접수기간(기존)
	$aTime01 = $row['aTime01'];
	$aDate02 = $row['aDate02'];
	$aTime02 = $row['aTime02'];
	$oDate01 = $row['oDate01'];	//접수기간(신규)
	$oTime01 = $row['oTime01'];
	$oDate02 = $row['oDate02'];
	$oTime02 = $row['oTime02'];
	$eDate01 = $row['eDate01'];	//교육기간
	$eTime01 = $row['eTime01'];
	$eDate02 = $row['eDate02'];
	$eTime02 = $row['eTime02'];
	$cDate01 = $row['cDate01'];	//환불불가일
	$cTime01 = $row['cTime01'];

	$sql = "insert into ks_program (online,package,pid,pTitle,year,season,cade01,period,mTarget,mTargetEtc,periodID,room,title,fitnessType,tutorID,tutor,maxNum,amt,oneAmt,eduNum,sEduHour,sEduMin,eEduHour,eEduMin,yoilList,ment01,ment02,aDate01,aTime01,aDate02,aTime02,oDate01,oTime01,oDate02,oTime02,eDate01,eTime01,eDate02,eTime02,cDate01,cTime01,upfile01,realfile01,rDate,rTime) values ";
	$sql .= "('$online','$package','$pid','$pTitle','$year','$season','$cade01','$period','$mTarget','$mTargetEtc','$periodID','$room','$title','$fitnessType','$tutorID','$tutor','$maxNum','$amt','$oneAmt','$eduNum','$sEduHour','$sEduMin','$eEduHour','$eEduMin','$yoilList','$ment01','$ment02','$aDate01','$aTime01','$aDate02','$aTime02','$oDate01','$oTime01','$oDate02','$oTime02','$eDate01','$eTime01','$eDate02','$eTime02','$cDate01','$cTime01','$arr_new_file[1]','$real_name[1]','$rDate','$rTime')";
		$result = mysql_query($sql);
}

require_once "./PHPExcel-1.8/Classes/PHPExcel.php"; // PHPExcel.php을 불러옴.

$objPHPExcel = new PHPExcel();

require_once "./PHPExcel-1.8/Classes/PHPExcel/IOFactory.php"; // IOFactory.php을 불러옴.


$filename = './excelFile/program.xlsx'; // 읽어들일 엑셀 파일의 경로와 파일명을 지정한다.

try{
	// 업로드 된 엑셀 형식에 맞는 Reader객체를 만든다.
	$objReader = PHPExcel_IOFactory::createReaderForFile($filename);
	
	// 읽기전용으로 설정
	$objReader->setReadDataOnly(true);
	
	// 엑셀파일을 읽는다
	$objExcel = $objReader->load($filename);
	
	// 첫번째 시트를 선택
	$objExcel->setActiveSheetIndex(0);
	$objWorksheet = $objExcel->getActiveSheet();
	$rowIterator = $objWorksheet->getRowIterator();
		
	foreach($rowIterator as $row){ // 모든 행에 대해서
		$cellIterator = $row->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(false); 
	}
	
	$maxRow = $objWorksheet->getHighestRow();

	echo $maxRow.'<br>';

	for($i=3; $i<=$maxRow; $i++){
		$cade01Row = $objWorksheet->getCell('A' . $i)->getValue();
		$cade02 = $objWorksheet->getCell('B' . $i)->getValue();
		$title = $objWorksheet->getCell('C' . $i)->getValue();
		$tutor = $objWorksheet->getCell('D' . $i)->getValue();
		$yoil = $objWorksheet->getCell('E' . $i)->getValue();
		$sTime = $objWorksheet->getCell('F' . $i)->getValue();
		$eTime = $objWorksheet->getCell('G' . $i)->getValue();
		$maxNum = $objWorksheet->getCell('H' . $i)->getValue();
		$offNum = $objWorksheet->getCell('I' . $i)->getValue();
		$onNum = $objWorksheet->getCell('J' . $i)->getValue();
		$target = $objWorksheet->getCell('K' . $i)->getValue();
		$amt = $objWorksheet->getCell('N' . $i)->getValue();

		if($title){
			if($cade01Row){
				$cade01 = $cade01Row;
				$cade01 = iconv('utf-8','euc-kr',$cade01);
			}
			$cade02 = iconv('utf-8','euc-kr',$cade02);
			$title = iconv('utf-8','euc-kr',$title);
			$tutor = iconv('utf-8','euc-kr',$tutor);
			$yoil = iconv('utf-8','euc-kr',$yoil);
			$target = iconv('utf-8','euc-kr',$target);

			if($target == '' || $target == '누구나')	$target = '전체';

			$sArr = explode(':',$sTime);
			$eArr = explode(':',$eTime);

			$sHour = $sArr[0];
			$sMin = $sArr[1];
			$eHour = $eArr[0];
			$eMin = $eArr[1];

			$sql = "insert into zz_program (cade01,cade02,title,tutor,yoil,sHour,sMin,eHour,eMin,maxNum,offNum,onNum,target,amt) values ('$cade01','$cade02','$title','$tutor','$yoil','$sHour','$sMin','$eHour','$eMin','$maxNum','$offNum','$onNum','$target','$amt')";
			$result = mysql_query($sql);

	//		echo $cade01.' / '.$cade02.' / '.$title.' / '.$mobile.' / '.$cade01.' / '.$cade02.' / '.$className.' / '.$title.' / '.$saleType.' / '.$saleAmt.' / '.$amt.'<Br>';
			//날짜 형태의 셀을 읽을때는 toFormattedString를 사용
	//			$dataF = PHPExcel_Style_NumberFormat::toFormattedString($dataF, 'YYYY-MM-DD');
		}
	}

}catch(exception $e){
	echo '엑셀파일을 읽는도중 오류가 발생하였습니다.<br/>';
}

echo $year.' => '.$maxRow;
?>