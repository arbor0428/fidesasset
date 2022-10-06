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

		$pArr = explode('-',$pdate);
		$pdateTime = mktime(0,0,0,$pArr[1],$pArr[2],$pArr[0]);

		$msgTxt = "등이 굽은 편이며 팔이 좀 긴편입니다.";

		//여성한복(대여)
		if($gdata09){
			$gdata09 = eregi_replace($msgTxt, "", $gdata09);
			$gdata09 = eregi_replace("<", "&lt;", $gdata09);
			$gdata09 = eregi_replace(">", "&gt;", $gdata09);
			$gdata09 = eregi_replace("\"", "&quot;", $gdata09);
			$gdata09 = eregi_replace("\|", "&#124;", $gdata09);
			$gdata09 = eregi_replace("\r\n\r\n", "<P>", $gdata09);
			$gdata09 = eregi_replace("\r\n", "<BR>", $gdata09);
		}

		//남성한복(대여)
		if($mdata05){
			$mdata05 = eregi_replace($msgTxt, "", $mdata05);
			$mdata05 = eregi_replace("<", "&lt;", $mdata05);
			$mdata05 = eregi_replace(">", "&gt;", $mdata05);
			$mdata05 = eregi_replace("\"", "&quot;", $mdata05);
			$mdata05 = eregi_replace("\|", "&#124;", $mdata05);
			$mdata05 = eregi_replace("\r\n\r\n", "<P>", $mdata05);
			$mdata05 = eregi_replace("\r\n", "<BR>", $mdata05);
		}


		//남아한복(대여&판매)
		if($bdata07){
			$bdata07 = eregi_replace($msgTxt, "", $bdata07);
			$bdata07 = eregi_replace("<", "&lt;", $bdata07);
			$bdata07 = eregi_replace(">", "&gt;", $bdata07);
			$bdata07 = eregi_replace("\"", "&quot;", $bdata07);
			$bdata07 = eregi_replace("\|", "&#124;", $bdata07);
			$bdata07 = eregi_replace("\r\n\r\n", "<P>", $bdata07);
			$bdata07 = eregi_replace("\r\n", "<BR>", $bdata07);
		}


		//여아한복(대여&판매)
		if($cdata07){
			$cdata07 = eregi_replace($msgTxt, "", $cdata07);
			$cdata07 = eregi_replace("<", "&lt;", $cdata07);
			$cdata07 = eregi_replace(">", "&gt;", $cdata07);
			$cdata07 = eregi_replace("\"", "&quot;", $cdata07);
			$cdata07 = eregi_replace("\|", "&#124;", $cdata07);
			$cdata07 = eregi_replace("\r\n\r\n", "<P>", $cdata07);
			$cdata07 = eregi_replace("\r\n", "<BR>", $cdata07);
		}

		//장바구니등록
		$sql = "insert into ks_cart (userid,ip,pid,pdate,pea,gdata01,gdata02,gdata03,gdata04,gdata05,gdata06,gdata07,gdata08,gdata09,mdata01,mdata02,mdata03,mdata04,mdata05,bdata01,bdata02,bdata03,bdata04,bdata05,bdata06,bdata07,cdata01,cdata02,cdata03,cdata04,cdata05,cdata06,cdata07,reg_date,etc01,etc02,etc03,etc04) values ";
		$sql .= "('$userid','$user_ip','$pid','$pdateTime','$pea','$gdata01','$gdata02','$gdata03','$gdata04','$gdata05','$gdata06','$gdata07','$gdata08','$gdata09','$mdata01','$mdata02','$mdata03','$mdata04','$mdata05','$bdata01','$bdata02','$bdata03','$bdata04','$bdata05','$bdata06','$bdata07','$cdata01','$cdata02','$cdata03','$cdata04','$cdata05','$cdata06','$cdata07','$reg_date','$etc01','$etc02','$etc03','$etc04')";
		$result = mysql_query($sql);



		if($direct_order)	$url = '/order/up_index.php';	//바로구매
		else	$url = '/cart/up_index.php';					//장바구니담기

		Msg::goMagParent($url);

		break;








	case 'del' :


		$sql = "delete from ks_cart where uid=$uid";
		$result = mysql_query($sql);

		Msg::goMagParent('/cart/up_index.php');

		break;






	case 'order' :

		$cart_num = explode(',',$cart_idx);
		$clen = count($cart_num);

		$errMsg = "";

		//재고확인
		for($i=0; $i<$clen; $i++){
			$cid = $cart_num[$i];
			$cea = ${'ea'.$cid};

			$sql = "select p.*,c.gdata01,c.bdata02,c.cdata02 from ks_cart as c left join ks_product as p on c.pid=p.uid where c.uid='$cid'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);

			$cade01 = $row['cade01'];
			$title = $row['title'];
			$gdata01 = $row['gdata01'];			//여성한복사이즈
			$bdata02 = $row['bdata02'];			//돌한복(남아)
			$cdata02 = $row['cdata02'];			//돌한복(여아)
			$inven_44 = $row["inven_44"];		//재고(44사이즈)
			$inven_55 = $row["inven_55"];		//재고(55사이즈)
			$inven_66 = $row["inven_66"];		//재고(66사이즈)
			$inven_77 = $row["inven_77"];		//재고(77사이즈)
			$inven_88 = $row["inven_88"];		//재고(88사이즈)
			$inven_b1 = $row["inven_b1"];		//재고(1호)
			$inven_b2 = $row["inven_b2"];		//재고(2호)

			$inven = 0;

			if($cade01 == '여성한복' || $cade01 == '커플한복'){
				if($gdata01 == '44')					$inven = $inven_44;
				elseif($gdata01 == '55')			$inven = $inven_55;
				elseif($gdata01 == '66')			$inven = $inven_66;
				elseif($gdata01 == '77')			$inven = $inven_77;
				elseif($gdata01 == '88')			$inven = $inven_88;
				elseif($gdata01 == 'free size')		$inven = 9999;

				if($cea > $inven){
					if($errMsg)	$errMsg .= "\\n";
					$errMsg .= $title;
				}

			}elseif($cade01 == '남아한복'){
				if($cdata02 == '백일, 첫돌 1호')			$inven = $inven_b1;
				elseif($cdata02 == '첫돌, 2세 2호')		$inven = $inven_b2;

				if($cea > $inven){
					if($errMsg)	$errMsg .= "\\n";
					$errMsg .= $title;
				}

			}elseif($cade01 == '여아한복'){
				if($cdata02 == '백일, 첫돌 1호')			$inven = $inven_b1;
				elseif($cdata02 == '첫돌, 2세 2호')		$inven = $inven_b2;

				if($cea > $inven){
					if($errMsg)	$errMsg .= "\\n";
					$errMsg .= $title;
				}
			}
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
