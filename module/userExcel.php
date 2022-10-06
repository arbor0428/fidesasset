<?
exit;
header("Content-Type:text/html;charset=utf-8");

include './class/class.DbCon.php';

require_once "./PHPExcel-1.8/Classes/PHPExcel.php"; // PHPExcel.php을 불러옴.

$objPHPExcel = new PHPExcel();

require_once "./PHPExcel-1.8/Classes/PHPExcel/IOFactory.php"; // IOFactory.php을 불러옴.

$year = '2019';

$filename = './excelFile/member_'.$year.'.xlsx'; // 읽어들일 엑셀 파일의 경로와 파일명을 지정한다.

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
	
	for($i=3; $i<=$maxRow; $i++){
		$no = $objWorksheet->getCell('A' . $i)->getValue();
		$userNum = $objWorksheet->getCell('C' . $i)->getValue();
		$name = $objWorksheet->getCell('D' . $i)->getValue();
		$mobile = $objWorksheet->getCell('I' . $i)->getValue();
		$email = $objWorksheet->getCell('J' . $i)->getValue();
		$bDate = $objWorksheet->getCell('K' . $i)->getValue();
		$zipcode = $objWorksheet->getCell('N' . $i)->getValue();
		$addr01 = $objWorksheet->getCell('O' . $i)->getValue();

		if($email){
			$eArr = explode('@',$email);
			$email01 = $eArr[0];
			$email02 = $eArr[1];
		}else{
			$email01 = '';
			$email02 = '';
		}

		if($bDate){
//			$bDate = PHPExcel_Style_NumberFormat::toFormattedString($bDate, 'YYYY-MM-DD');
			if(preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $bDate)){
				$bArr = explode('-',$bDate);
				$bTime = mktime(0,0,0,$bArr[1],$bArr[2],$bArr[0]);
			}else{
				$bDate = '';
				$bTime = 0;
			}
		}else{
			$bDate = '';
			$bTime = 0;
		}

		$name = iconv('utf-8','euc-kr',$name);
		$addr01 = iconv('utf-8','euc-kr',$addr01);

		$sql = "insert into zz_member (year,userNum,name,mobile,email01,email02,bDate,bTime,zipcode,addr01) values ('$year','$userNum','$name','$mobile','$email01','$email02','$bDate','$bTime','$zipcode','$addr01')";
		$result = mysql_query($sql);

//		echo $userNum.' / '.$name.' / '.$mobile.' / '.$email01.'@'.$email02.' / '.$bDate.'('.date('Y-m-d',$bTime).') / '.$bTime.' / '.$zipcode.' / '.$addr01.'<br>';

		//날짜 형태의 셀을 읽을때는 toFormattedString를 사용
//		$dataF = PHPExcel_Style_NumberFormat::toFormattedString($dataF, 'YYYY-MM-DD'); 
	}

}catch(exception $e){
	echo '엑셀파일을 읽는도중 오류가 발생하였습니다.<br/>';
}

echo $year.' => '.$maxRow;
?>