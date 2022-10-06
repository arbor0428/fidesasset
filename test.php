<?
	include "./module/class/class.DbCon.php";

	//  alter table 테이블명 modify column 순서변경할 컬럼 컬럼타입 after 순서변경할위치 앞 컬럼/ 컬럼 위치 변경하기

	if($_SERVER['REMOTE_ADDR'] = '106.246.92.237' || $_SERVER['REMOTE_ADDR'] = '219.248.183.35'){

	//alter table ext_register01 change addr02 loc02 varchar(50)

	// alter table ext_academic01 modify column major varchar(255) after sname




	$query = "select  * from ks_brochure ";
	$result = mysql_query($query);

	$num = mysql_num_rows($result);
	echo$num.'<br>';
	while( $row = mysql_fetch_array($result) ){

		for($i=0;$i<100;$i++){
			echo $row[$i].' / ';
		}

			echo '<br>';
	}

	//uid int(11) not null auto_increment primary key



} 
?>