<?
exit;
header("Content-Type:text/html;charset=utf-8");

include './class/class.DbCon.php';

//$sql = "delete from zz_classSale";
//$result = mysql_query($sql);

require_once "./PHPExcel-1.8/Classes/PHPExcel.php"; // PHPExcel.php을 불러옴.

$objPHPExcel = new PHPExcel();

require_once "./PHPExcel-1.8/Classes/PHPExcel/IOFactory.php"; // IOFactory.php을 불러옴.


$filename = './excelFile/sale.xlsx'; // 읽어들일 엑셀 파일의 경로와 파일명을 지정한다.

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
		$pDate = $objWorksheet->getCell('A' . $i)->getValue();
		$userNum = $objWorksheet->getCell('B' . $i)->getValue();
		$name = $objWorksheet->getCell('C' . $i)->getValue();
		$mobile = $objWorksheet->getCell('D' . $i)->getValue();
		$cade01 = $objWorksheet->getCell('E' . $i)->getValue();
		$cade02 = $objWorksheet->getCell('F' . $i)->getValue();
		$className = $objWorksheet->getCell('G' . $i)->getValue();
		$title = $objWorksheet->getCell('H' . $i)->getValue();
		$saleType = $objWorksheet->getCell('I' . $i)->getValue();
		$saleAmt = $objWorksheet->getCell('J' . $i)->getValue();
		$amt = $objWorksheet->getCell('K' . $i)->getValue();

		if($userNum){
			//매출일자
			if($pDate){
				if(preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $pDate)){
					$pArr = explode('-',$pDate);
					$pTime = mktime(0,0,0,$pArr[1],$pArr[2],$pArr[0]);
				}else{
					$pDate = '';
					$pTime = 0;
				}
			}else{
				$pDate = '';
				$pTime = 0;
			}

			$name = iconv('utf-8','euc-kr',$name);
			$title = iconv('utf-8','euc-kr',$title);
			$cade01 = iconv('utf-8','euc-kr',$cade01);
			$cade02 = iconv('utf-8','euc-kr',$cade02);
			$className = iconv('utf-8','euc-kr',$className);
			$saleType = iconv('utf-8','euc-kr',$saleType);
			$saleType = str_replace(' ','',$saleType);

			$sql = "insert into zz_classSale (pDate,pTime,userNum,name,mobile,cade01,cade02,className,title,saleType,saleAmt,amt) values ('$pDate','$pTime','$userNum','$name','$mobile','$cade01','$cade02','$className','$title','$saleType','$saleAmt','$amt')";
			$result = mysql_query($sql);

//			echo $pDate.' / '.$userNum.' / '.$name.' / '.$mobile.' / '.$cade01.' / '.$cade02.' / '.$className.' / '.$title.' / '.$saleType.' / '.$saleAmt.' / '.$amt.'<Br>';
			//날짜 형태의 셀을 읽을때는 toFormattedString를 사용
//			$dataF = PHPExcel_Style_NumberFormat::toFormattedString($dataF, 'YYYY-MM-DD'); 
		}
	}

}catch(exception $e){
	echo '엑셀파일을 읽는도중 오류가 발생하였습니다.<br/>';
}

echo $year.' => '.$maxRow;
?>