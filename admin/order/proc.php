<?
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";



switch($type){
	case 'edit' :
			if($set_status == '주문취소'){
				$cArr = explode('-',$cDate);
				$cTime = mktime(0,0,0,$cArr[1],$cArr[2],$cArr[0]);
			}else{
				$cDate = '';
				$cTime = '';
			}


			$sql = "update ks_order set status='$set_status', ship_num='$ship_num', cDate='$cDate', cTime='$cTime' where uid=$uid";
			$result = mysql_query($sql);






			//송장번호 문자발송
			if($ship_num && $sms){
				mysql_close($dbconn);
				unset($db);
				unset($dbconn);

				$SMS_ADMIN = 'leehyunjoo';
				$SMS_TYPE = 'ship';

				//sms 데이터베이스 접속
				include '../../module/class/class.DbConSmsHub.php';
				include '../../module/SmsHub.php';
			}









			$msg = '수정되었습니다';

		
			break;




	case 'del' :

		$sql = "select * from ks_order where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$userid = $row['userid'];
		$reg_date = $row['reg_date'];


		$sql = "delete from ks_order_list where userid='$userid' and code='$reg_date'";
		$result = mysql_query($sql);


		$sql = "delete from ks_order where uid=$uid";
		$result = mysql_query($sql);

		$msg = '삭제되었습니다';

		$type = 'list';
		$uid = '';

		break;



	case 'all_del' :

		for($k=0; $k<count($chk); $k++){
			$sql = "select * from ks_order where uid='$chk[$k]'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$userid = $row['userid'];
			$reg_date = $row['reg_date'];


			$sql = "delete from ks_order_list where userid='$userid' and code='$reg_date'";
			$result = mysql_query($sql);


			$sql = "delete from ks_order where uid=$chk[$k]";
			$result = mysql_query($sql);


		}

		$msg = '삭제되었습니다';

		$type = 'list';
		$uid = '';

		break;

}


unset($dbconn);

?>


<form name='frm' method='post' action='up_index.php'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>

<input type='hidden' name='f_reg' value='<?=$f_reg?>'>
<input type='hidden' name='f_oname' value='<?=$f_oname?>'>
<input type='hidden' name='f_userid' value='<?=$f_userid?>'>
<input type='hidden' name='f_paymode' value='<?=$f_paymode?>'>
<input type='hidden' name='f_status' value='<?=$f_status?>'>
<input type='hidden' name='f_sy' value='<?=$f_sy?>'>
<input type='hidden' name='f_sm' value='<?=$f_sm?>'>
<input type='hidden' name='f_sd' value='<?=$f_sd?>'>
<input type='hidden' name='f_ey' value='<?=$f_ey?>'>
<input type='hidden' name='f_em' value='<?=$f_em?>'>
<input type='hidden' name='f_ed' value='<?=$f_ed?>'>
<input type='hidden' name='f_manager' value='<?=$f_manager?>'>
</form>

<script language='javascript'>
	if('<?=$msg?>'){
		alert('<?=$msg?>');
	}

	document.frm.submit();
</script>