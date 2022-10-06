<?
exit;
header("Content-Type:text/html;charset=utf-8");

include './class/class.DbCon.php';

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