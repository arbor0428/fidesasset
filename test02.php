
<link rel="stylesheet" href="/css/button.css" type="text/css">

	<table class='gTable'>
<?

	include "./module/class/class.DbCon.php";
	include "./module/class/class.Util.php";
	require_once "./PHPExcel.php"; // PHPExcel.php을 불러와야 하며, 경로는 사용자의 설정에 맞게 수정해야 한다.

	$objPHPExcel = new PHPExcel();

	require_once "./PHPExcel/IOFactory.php"; // IOFactory.php을 불러와야 하며, 경로는 사용자의 설정에 맞게 수정해야 한다.

	$filename = './upfile/austin.xlsx'; // 읽어들일 엑셀 파일의 경로와 파일명을 지정한다.

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

    foreach ($rowIterator as $row) { // 모든 행에 대해서

               $cellIterator = $row->getCellIterator();

               $cellIterator->setIterateOnlyExistingCells(false); 

    }

    $maxRow = $objWorksheet->getHighestRow();

    for ($i = 2 ; $i <= $maxRow ; $i++) {
		$data02='';
		$title = $objWorksheet->getCell('B' . $i)->getValue(); // B열
		$cade01 = $objWorksheet->getCell('C' . $i)->getValue(); // C열
		$memo = $objWorksheet->getCell('D' . $i)->getValue(); // D열
		$cade02 = $objWorksheet->getCell('F' . $i)->getValue(); // F열
		$data01 = $objWorksheet->getCell('G' . $i)->getValue(); // E열
		$data02 = $objWorksheet->getCell('H' . $i)->getValue(); // H열
		$data03 = $objWorksheet->getCell('I' . $i)->getValue(); // H열
		$data04 = $objWorksheet->getCell('K' . $i)->getValue(); // H열
		$data05 = $objWorksheet->getCell('L' . $i)->getValue(); // H열
		$data08 = $objWorksheet->getCell('M' . $i)->getValue(); // H열
		$data06 = $objWorksheet->getCell('N' . $i)->getValue(); // H열
		$data07 = $objWorksheet->getCell('O' . $i)->getValue(); // H열
		$data09 = $objWorksheet->getCell('P' . $i)->getValue(); // H열
		
		
		if($title){
		$sql = "update ks_medicine set memo='$memo' where title='$title'";
		//$result = mysql_query($sql);


		echo$sql.'<br>';
		}
?>
		<tr style='display:none;'>
			<td><?=$userid?></td>
			<td><?=$data02?></td>
			<td><?=$data03?></td>
			<td><?=$data04?></td>
			<td><?=$data05?></td>
			<td><?=$data06?></td>
			<td><?=$data07?></td>
		</tr>
<?
      }
?>

	</table>