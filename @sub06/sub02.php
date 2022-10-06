<?
	include "../header.php";

	if(!$type)	$type = 'list';

	$path = '../upfile/shop/';	//상품이미지경로

	if($GBL_USERTYPE!='약사' && $GBL_MTYPE!='A'){
		Msg::goMsg('약사회원만 이용하실 수 있습니다.','/');
	}
	$cade01='전문가몰';

?>

<div class="sub_visual sub_visual02 visual_wrap">
	<div class="text-box">전문가몰</div>
</div>

<div class='content_box' style='width:1100px;'>

		<?
			if($type == 'list')			include 'plist.php';
			elseif($type == 'view')	include 'pview.php';
		?>

</div>


<?
	include "../footer.php";
?>