<?


	$sql = "select * from ks_order_tmp where reg_date='$reg_date'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$userid = $row['userid'];
	$cart_idx = $row['cart_idx'];
	$oname = $row['oname'];
	$ozip1 = $row['ozip1'];
	$ozip2 = $row['ozip2'];
	$oaddr1 = $row['oaddr1'];
	$oaddr2 = $row['oaddr2'];
	$otel1 = $row['otel1'];
	$otel2 = $row['otel2'];
	$otel3 = $row['otel3'];
	$ohp1 = $row['ohp1'];
	$ohp2 = $row['ohp2'];
	$ohp3 = $row['ohp3'];
	$oemail = $row['oemail'];

	$pname = $row['pname'];
	$pzip1 = $row['pzip1'];
	$pzip2 = $row['pzip2'];
	$paddr1 = $row['paddr1'];
	$paddr2 = $row['paddr2'];
	$ptel1 = $row['ptel1'];
	$ptel2 = $row['ptel2'];
	$ptel3 = $row['ptel3'];
	$php1 = $row['php1'];
	$php2 = $row['php2'];
	$php3 = $row['php3'];

	$ment = $row['ment'];
	$paymode = $row['paymode'];
	$product_price = $row['product_price'];
	$ship_price = $row['ship_price'];
	$tot_price = $row['tot_price'];
	$upoint = $row['upoint'];
	$result_price = $row['result_price'];
	$status = $row['status'];
	$ip = $row['ip'];




	//주문자 정보를 저장한다.
	$sql = "insert into ks_order (userid,cart_idx,oname,ozip1,ozip2,oaddr1,oaddr2,otel1,otel2,otel3,ohp1,ohp2,ohp3,oemail,pname,pzip1,pzip2,paddr1,paddr2,ptel1,ptel2,ptel3,php1,php2,php3,ment,paymode,product_price,ship_price,tot_price,upoint,result_price,status,ip,reg_date) ";
	$sql .= "values ('$userid','$cart_idx','$oname','$ozip1','$ozip2','$oaddr1','$oaddr2','$otel1','$otel2','$otel3','$ohp1','$ohp2','$ohp3','$oemail','$pname','$pzip1','$pzip2','$paddr1','$paddr2','$ptel1','$ptel2','$ptel3','$php1','$php2','$php3','$ment','$paymode','$product_price','$ship_price','$tot_price','$upoint','$result_price','결제완료','$ip','$reg_date')";


	$result = mysql_query($sql);





	//주문내역을 저장한다.
	$sql01 = "select * from ks_order_list_tmp where userid='$userid' and code='$reg_date' order by uid";
	$result01 = mysql_query($sql01);
	$num01 = mysql_num_rows($result01);

	for($i=0; $i<$num01; $i++){
		$row01 = mysql_fetch_array($result01);
		$pid = $row01['pid'];
		$ea = $row01['ea'];
		$price = $row01['price'];
		$point = $row01['point'];


		$sql02 = "insert into ks_order_list (userid,code,pid,ea,price,point) values ('$userid','$reg_date','$pid','$ea','$price','$point')";
		$result02 = mysql_query($sql02);
	}


	//임시저장 테이블을 삭제한다
	$sql = "delete from ks_order_tmp where userid='$userid' and reg_date='$reg_date'";
	$result = mysql_query($sql);

	$sql = "delete from ks_order_list_tmp where userid='$userid' and code='$reg_date'";
	$result = mysql_query($sql);


?>