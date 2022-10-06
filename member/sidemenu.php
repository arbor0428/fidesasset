<?
	$active_tab[$side_menu]="active-tab";
	$active[$side_menu]="active";
	$box_L_s_a[$side_menu2]="box_L_s_a";
?>


<style>
#nav<?=$side_menu?>+ul{
	display:block;
}
</style>




<ul class="menu-list">

	<?
		if($GBL_USERID){
	?>	
	<li id="nav1" class="toggle accordion-toggle no_menu <?=$active_tab[1]?>"> 
		<a href='./join.php' class='menu-link <?=$active[1]?>'>정보수정</a>
	</li>
	<?
		}else{
	?>
	<li id="nav1" class="toggle accordion-toggle no_menu <?=$active_tab[1]?>"> 
		<a href='./join.php' class='menu-link <?=$active[1]?>'>회원가입</a>
	</li>
	<li id="nav1" class="toggle accordion-toggle no_menu <?=$active_tab[2]?>"> 
		<a href='./login.php' class='menu-link <?=$active[2]?>'>로그인</a>
	</li>
	<li id="nav1" class="toggle accordion-toggle no_menu <?=$active_tab[3]?>"> 
		<a href='./search01.php' class='menu-link <?=$active[3]?>'>아이디찾기</a>
	</li>
	<li id="nav1" class="toggle accordion-toggle no_menu <?=$active_tab[4]?>"> 
		<a href='./search02.php' class='menu-link <?=$active[4]?>'>비밀번호찾기</a>
	</li>
	<?
		}	
	?>
</ul>
