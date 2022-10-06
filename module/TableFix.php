<script language='javascript'>
$(function () {
	$('table.fix>thead').each(function() {
		$(this).after( $(this).clone().hide().css('top',0).css('position','fixed') );
	});
	
//	$(window).scroll(function() {
	$(window).on("scroll resize", function() {
		$('table.fix').each(function(i) {
			var table = $(this),
			thead = table.find('thead:first'),
			clone = table.find('thead:last'),
			top = table.offset().top,
			bottom = top + table.height() - thead.height(),
			left = table.position().left,
			border = 2;
//			border = parseInt(thead.find('th:first').css('border-width')),
			scroll = $(window).scrollTop();
			
			if( scroll < top || scroll > bottom ) {
				clone.hide();
				return true;
			}
			
			if( clone.is('visible') ) return true;
			
			clone.css('left',left).show().find('th').each(function(i) {
				$(this).width( thead.find('th').eq(i).width() + border - 1 );
			});     
		});
	});
});
</script>