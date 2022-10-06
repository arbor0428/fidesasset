<?
	include '../../module/class/class.DbCon.php';

	$sql = "select * from ks_ticket where uid='$uid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$userid = $row['userid'];
	$name = $row['name'];
	$guest = $row['guest'];
	$carNum = $row['carNum'];
	$code = $row['code'];
	$ment = $row['ment'];
	$rDate = $row["rDate"];
?>

<style type="text/css">

html,body{
height:389px !important;
max-height:389px !important;
overflow:hidden;
}
 
*{margin:0;padding:0;}
#rcwrap{font-family:'malgun gothic';font-size:11pt;}
.clearfix{*zoom:1}
.clearfix:after{clear:both;display:block;content:''}
li{list-style:none;}


.receipt{
width:230px;
padding:15px 15px;
border-top:1px solid #000;
border-bottom:1px solid #000;

}
.dashed_line_rc{
width:100%;
border-bottom:1px dashed #888;
margin:10px 0;
}

.rcttl{
font-size:18px;
font-weight:600;
text-align:center;
}
.rcttls{
font-size:13px;
text-align:center;
margin-top:8px;
}

.rc_info li{
line-height:20px;
font-size:12px;
color:#000;
font-weight:600;
}

.pkttl{
font-size:15px;
font-weight:600;
text-align:center;
}
.pkttl2{
font-size:17px;
text-align:center;
margin-top:6px;
}


.rc_date{
text-align:center;
font-size:12px;
margin-bottom:8px;

}

.rc_logo img{
width:120px;
margin:5px auto;
display:block;
}

.rc_w_info{
text-align:center;
font-size:10px;
color:#000;
}
</style>

<script language='javascript'>
function printPage(){
	window.print();
}
</script>

<body onload='printPage();'>

<div id="rcwrap">
	<div class="receipt">
		<div class="rcttl">면제권</div>

		<div class="dashed_line_rc"></div>
		
		<ul class="rc_info">
			<li>일련번호 : <?=$code?></li>
			<li>방문자 : <?=$guest?></li>
			<li>사유 : <?=$ment?></li>
		</ul>

		<div class="dashed_line_rc"></div>

		<div class="pkttl">차량번호</div>
		<div class="pkttl2"><?=$carNum?></div>

		<div class="dashed_line_rc"></div>

		<div class="rc_date"><?=$rDate?></div>

		<div class="rc_logo"><img src="/images/logo3_foot.jpg" alt="" /></div>

		<div class="rc_w_info">
			서울 은평구 녹번로 16<br>
            T. 02-351-3736
		</div>
	</div>	
</div>