<?

/*
echo 'total == > '.$total.'<br>';	//상품구매(단가*수량)가격
echo 'ship == > '.$ship.'<br>';	//배송비
echo 'tot_price ==> '.$ttp.'<br>';	 //총금액
echo 'upoint ==> '.$upoint.'<br>';	//결제시 사용한 적립금
echo 'result_price ==> '.$result_price.'<br>';	//실제결제금액
echo 'spoint ==> '.$spoint.'<br>';	//상품구매시 적립될 적립금
*/




switch($type){
	case 'order' :

		/*가상계좌*/
		$virno 		= trim($_POST["VIRTUAL_NO"]);			//가상계좌번호(가상계좌)
		$virbank	= trim($_POST["VIRTUAL_CENTERCD"]);	//은행코드(가상계좌)
		$virdepodt 	= trim($_POST["VIRTUAL_DEPODT"]);		//입금예정일(가상계좌)


		if($virbank){
			if($virbank == "39"){
				$rBank = '경남은행';
			}else if($virbank == "34"){
				$rBank = '광주은행';
			}else if($virbank == "04"){
				$rBank = '국민은행';
			}else if($virbank == "11"){
				$rBank = '농협중앙회';
			}else if($virbank == "31"){
				$rBank = '대구은행';
			}else if($virbank == "32"){
				$rBank = '부산은행';
			}else if($virbank == "02"){
				$rBank = '산업은행';
			}else if($virbank == "45"){
				$rBank = '새마을금고';
			}else if($virbank == "07"){
				$rBank = '수협중앙회';
			}else if($virbank == "48"){
				$rBank = '신용협동조합';
			}else if($virbank == "26"){
				$rBank = '(구)신한은행';
			}else if($virbank == "05"){
				$rBank = '외환은행';
			}else if($virbank == "20"){
				$rBank = '우리은행';
			}else if($virbank == "71"){
				$rBank = '우체국';
			}else if($virbank == "37"){
				$rBank = '전북은행';
			}else if($virbank == "23"){
				$rBank = '제일은행';
			}else if($virbank == "35"){
				$rBank = '제주은행';
			}else if($virbank == "21"){
				$rBank = '(구)조흥은행';
			}else if($virbank == "03"){
				$rBank = '중소기업은행';
			}else if($virbank == "81"){
				$rBank = '하나은행';
			}else if($virbank == "88"){
				$rBank = '신한은행';
			}else if($virbank == "27"){
				$rBank = '한미은행';
			}

		}


		$user_ip = $_SERVER['REMOTE_ADDR'];

		if(!$userid)	$userid = '비회원';


		if($ment){
			$ment = eregi_replace("<", "&lt;", $ment);
			$ment = eregi_replace(">", "&gt;", $ment);
			$ment = eregi_replace("\"", "&quot;", $ment);
			$ment = eregi_replace("\|", "&#124;", $ment);
			$ment = eregi_replace("\r\n\r\n", "<P>", $ment);
			$ment = eregi_replace("\r\n", "<BR>", $ment);
		}




		//주문자 정보를 저장한다.
		$sql = "insert into ks_order (userid,cart_idx,oname,ozip1,ozip2,oaddr1,oaddr2,otel1,otel2,otel3,ohp1,ohp2,ohp3,oemail,pname,pzip1,pzip2,paddr1,paddr2,ptel1,ptel2,ptel3,php1,php2,php3,ment,paymode,account,product_price,ship_price,tot_price,upoint,result_price,status,ip,virno,virbank,virdepodt,reg_date) ";
		$sql .= "values ('$userid','$cart_pid','$oname','$ozip1','$ozip2','$oaddr1','$oaddr2','$otel1','$otel2','$otel3','$ohp1','$ohp2','$ohp3','$oemail','$pname','$pzip1','$pzip2','$paddr1','$paddr2','$ptel1','$ptel2','$ptel3','$php1','$php2','$php3','$ment','$pay_mode','$ac_name','$total','$ship','$ttp','$upoint','$result_price','접수','$ip','$virno','$rBank','$virdepodt','$reg_date')";
		$result = mysql_query($sql);





		//주문내역을 저장한다.
		$id_list = explode(',',$cart_idx);	//필드ID
		$pid_list = explode(',',$cart_pid);	//주문상품ID

		$tot = count($id_list);
		for($i=0; $i<$tot; $i++){
			$pid = $pid_list[$i];
			$uid = $id_list[$i];	//필드ID
			$ea = ${'ea'.$uid};	//수량
			$price = ${'op'.$uid};	//상품가격
			$point = ${'sp'.$uid};	//상품적립금

			$sql = "insert into ks_order_list (userid,code,pid,ea,price,point) values ('$userid','$reg_date','$pid','$ea','$price','$point')";
			$result = mysql_query($sql);


			//주문한 상품은 장바구니에서 삭제한다.
			$sql = "delete from ks_cart where uid='$uid'";
			$result = mysql_query($sql);

		}










		if($userid != '비회원'){

			//적립금 사용시..
			if($upoint > 0){
				//회원 적립금을 차감한다.
				$sql = "update tb_member set point=point-$upoint where userid='$userid'";
				$result = mysql_query($sql);

				//적립내역을 저장한다.
				$sql = "insert into tb_point (userid,ptype,point,ment,reg_date) values ('$userid','S','$upoint','주문결제','$reg_date')";
				$result = mysql_query($sql);
			}


			//회원 적립금을 적립시킨다.
			$sql = "update tb_member set point=point+$spoint where userid='$userid'";
			$result = mysql_query($sql);


			//적립내역을 저장한다.
			$sql = "insert into tb_point (userid,ptype,point,ment,reg_date) values ('$userid','A','$spoint','상품구매','$reg_date')";
			$result = mysql_query($sql);

		}



		break;

}


?>
