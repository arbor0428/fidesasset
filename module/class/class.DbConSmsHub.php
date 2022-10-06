<?
class DbConSmsHub
{
	var	$DB_SERVER		= "115.68.17.91";
	var	$DB_LOGIN		= "smshub";
	var $DB_PASSWORD	= "iw-smsdb%";
	var $DB				= "smshub";

	function getConnectionSmsHub(){
		$dbconn = mysql_connect($this->DB_SERVER, $this->DB_LOGIN, $this->DB_PASSWORD) 
				  or die("데이타베이스 연결에 실패했습니다.");
		$status = mysql_select_db($this->DB, $dbconn);

		mysql_query('set names euckr');

		if($status)
			return $dbconn;
		else
			return $status;
	}
}

$db = new DbConSmsHub();
$dbconn = $db->getConnectionSmsHub();




//insert into SMS_SEND (SCHEDULE_TYPE, SMS_MSG, SAVE_TIME, SEND_TIME, CALLBACK, CALLEE_NO) values ('0','테스트','20120118120000','20120118120000','16612327','01052103630');

?>
