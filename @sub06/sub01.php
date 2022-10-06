<?
	include "../header.php";

	if(!$type)	$type = 'list';

	$path = '../upfile/shop/';	//상품이미지경로
	$cade01='온라인몰';
?>

<div class="sub_visual sub_visual02 visual_wrap">
	<div class="text-box">온라인몰</div>
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