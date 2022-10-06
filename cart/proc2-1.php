<?
include "../module/login/head.php";
include "../module/class/class.DbCon.php";
include "../module/class/class.Msg.php";


$userid = $GBL_USERID;



switch($type){

	//개별 장바구니담기
	case 'write' :

		$reg_date = mktime();
		$user_ip = $_SERVER['REMOTE_ADDR'];
		if(!$userid)	$userid = '비회원';




		//장바구니등록
		$sql = "insert into ks_cart (userid,ip,pid,puserid,pdate,pea,gdata01,gdata02,gdata03,gdata04,gdata05,gdata06,gdata07,gdata08,gdata09,mdata01,mdata02,mdata03,mdata04,mdata05,bdata01,bdata02,bdata03,bdata04,bdata05,bdata06,bdata07,cdata01,cdata02,cdata03,cdata04,cdata05,cdata06,cdata07,reg_date,etc01,etc02,etc03,etc04) values ";
		$sql .= "('$userid','$user_ip','$pid','$puserid','$pdateTime','$pea','$gdata01','$gdata02','$gdata03','$gdata04','$gdata05','$gdata06','$gdata07','$gdata08','$gdata09','$mdata01','$mdata02','$mdata03','$mdata04','$mdata05','$bdata01','$bdata02','$bdata03','$bdata04','$bdata05','$bdata06','$bdata07','$cdata01','$cdata02','$cdata03','$cdata04','$cdata05','$cdata06','$cdata07','$reg_date','$etc01','$etc02','$etc03','$etc04')";
		$result = mysql_query($sql);



		if($direct_order)	$url = '/orderToss/up_index.php';	//바로구매
		else	$url = '/cart/up_index.php';					//장바구니담기

		Msg::goKorea($url);

		break;








	case 'del' :


		$sql = "delete from ks_cart where uid=$uid";
		$result = mysql_query($sql);

		Msg::goKorea('/cart/up_index.php');

		break;






	case 'order' :

		$cart_num = explode(',',$cart_idx);
		$clen = count($cart_num);

		$errMsg = "";

		//중복상품 재고수 처리용
		$invenArr = Array();
		$invenArrEA = Array();

		//재고확인
		for($i=0; $i<$clen; $i++){
			$cid = $cart_num[$i];
			$cea = ${'ea'.$cid};

			$sql = "select * from ks_cart where uid='$cid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$pid = $row['pid'];
			$pdateTime = $row['pdate'];
			$gdata01 = $row['gdata01'];			//여성한복사이즈
			$bdata02 = $row['bdata02'];			//돌한복(남아)
			$cdata02 = $row['cdata02'];			//돌한복(여아)

			//재고확인(행사일기준)
			$invenID = $pid;					//상품UID
			$invenTime = $pdateTime;		//행사일
			$invenEA = $cea;					//주문수량

			include '../module/invenChk.php';
		}

		if($errMsg){
			$errMsg .= "\\n재고가 부족합니다";
			Msg::backMsg($errMsg);
			exit;
		}

		//주문수량 업데이트
		for($i=0; $i<$clen; $i++){
			$cid = $cart_num[$i];
			$cea = ${'ea'.$cid};

			$sql = "update ks_cart set pea='$cea' where uid='$cid'";
			$result = mysql_query($sql);
		}

		Msg::goNext('/order/up_index.php');

		break;




}


unset($dbconn);
?>
