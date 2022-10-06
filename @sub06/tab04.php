<?
	if($data04 || $data05 || $data06 || $data07 || $data08 || $data09){
?>
<div class="c_detail_bot">
	<?
		if($data04){
	?>	
	<ul class="clearfix">
		<li>성상</li>
		<li><?=$data04?></li>
	</ul>
	<?
		}
		if($data05){
	?>	
	<ul class="clearfix">
		<li>성분/함량</li>
		<li><?=$data05?></li>
	</ul>
	<?
		}
		if($data08){
	?>	
	<ul class="clearfix">
		<li>효능/효과</li>
		
		<li><?=$data08?></li>
	</ul>
	<?
		}
		if($data06){
	?>	
	<ul class="clearfix">
		<li>용법/용량</li>
		
		<li><?=$data06?></li>
	</ul>
	<?
		}
		if($data07){
	?>	
	<ul class="clearfix">
		<li>포장단위</li>
		
		<li><?=$data07?></li>
	</ul>
	<?
		}
		if($data09){
	?>	
	<ul class="clearfix">
		<li>저장방법</li>
		
		<li><?=$data09?></li>
	</ul>
	<?
		}
	?>	
</div>
<?
	}	
?>