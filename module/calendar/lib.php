<script language='javascript'>
function onCalendar(form,field,x,y){
	CL = document.getElementById("CalendarLayer");
	CL.style.display = 'none';


	/*클릭 위치 확인*/
	tempX = event.clientX + document.body.scrollLeft;
    tempY = event.clientY + document.body.scrollTop;


	modX = x.substring(0,1);	//x값 설정
	posX = x.substring(1,x.length);	//x값 위치

	if(modX=='+')	 var	mouseX = tempX + parseInt(posX);
	else	 var	mouseX = tempX - parseInt(posX);


	modY = y.substring(0,1);	//y값 설정
	posY = y.substring(1,y.length);	//y값 위치

	if(modY=='+')	 var	mouseY = tempY + parseInt(posY);
	else	 var	mouseY = tempY - parseInt(posY);


	CL.style.display = '';
	CL.style.left = mouseX;
	CL.style.top = mouseY;

	document.ifra_cal.location.href = '../calendar/mini_calendar.php?form='+form+'&field='+field;
}
</script>






<!------------------------------------ 미니달력 ------------------------------------>
<div id='CalendarLayer' style="position:absolute; display:none; z-index:1; background-color:#FFFFFF;">
<table cellpadding='0' cellspacing='0' border='0' style='border:2px solid #68aaf7;'>
	<tr>
		<td><iframe name='ifra_cal' src='about:blank' width='220' height='265' frameborder='0' scrolling='no'></iframe></td>
	</tr>
</table>
</div>
<!------------------------------------ /미니달력 ------------------------------------>