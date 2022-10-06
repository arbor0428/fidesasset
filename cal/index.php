<style type='text/css'>
li{list-style:none;margin:0;padding:0;}
</style>

<!-- Responsive slider -->
<link href="./responsive-calendar.css" rel="stylesheet">

<div class="container" style='width:260px;height:200px;border:1px solid #ccc;border-radius:5px;'>
	<!-- Responsive calendar - START -->
	<div class="responsive-calendar">
		<div class="controls" style="height:30px;margin-top:5px;border:1px solid transparent;">
			<li style='float:left;width:25%;'><a class="pull-left" data-go="prev">Prev</a></li>
			<li style='float:left;width:50%;'><h4><span data-head-year></span> <span data-head-month></span></h4></li>
			<li style='float:right;width:25%;'><a class="pull-right" data-go="next">Next</a></li>
		</div>

		<div class="day-headers" style='margin:10px 0 5px 0;'>
			<div class="day header" style='color:#ff0000;'>Su</div>
			<div class="day header">Mo</div>
			<div class="day header">Tu</div>
			<div class="day header">We</div>
			<div class="day header">Th</div>
			<div class="day header">Fr</div>
			<div class="day header" style='color:#1095cd;'>Sa</div>
		</div>

		<div class="days" data-group="days"></div>
	</div>
	<!-- Responsive calendar - END -->
</div>



<script src="./jquery.js"></script>
<script src="./responsive-calendar.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$(".responsive-calendar").responsiveCalendar({
		events: {
			"2017-09-10": {"url": "http://w3widgets.com/responsive-slider"},
			"2017-12-13": {"url": "http://w3widgets.com"},
			"2017-12-19": {}
		}
	});
});
</script>