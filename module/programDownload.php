<?
include './class/class.DbCon.php';

$sql = "select * from ks_program where uid='$uid'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$downfile = $row['upfile01'];
$filename = $row['realfile01'];

$filename = str_replace(',','_',$filename);

if($UserOS == 'mobile'){
	$filename =  iconv('euc-kr','utf-8',$filename);			//다운받는 파일명
}

ob_start();

// 파일이 있는 디렉토리
$downfiledir = '../upfile/program/';




// 파일 존재 유/무 체크

if( file_exists($downfiledir.$downfile)){
	header("Content-Type: application/octet-stream");

	Header("Content-Disposition: attachment;; filename=$filename ");

	header("Content-Transfer-Encoding: binary"); 

	Header("Content-Length: ".(string)(filesize($downfiledir.$downfile ))); 

	Header("Cache-Control: cache, must-revalidate"); 

	header("Pragma: no-cache"); 

	header("Expires: 0");
	
	$fp = fopen($downfiledir.$downfile , "rb"); //rb 읽기전용 바이러니 타입
	
	while(!feof($fp)){
		echo fread($fp, 100*1024); //echo는 전송을 뜻함.
	}
	
	fclose ($fp);
	flush(); //출력 버퍼비우기 함수.. 

}else{
?>

<script>alert("존재하지 않는 파일입니다.");history.back()</script>

<?
}
?>