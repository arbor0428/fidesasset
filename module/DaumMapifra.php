<style type='text/css'>
body{margin:0px;}
</style>

<script type="text/javascript">
var obj = {
	apikey: "17a0d28828220e0a78201af4d0d3a530b27416b6",

	// 검색을 요청하는 함수 
 	pingSearch : function(pos){
		obj.s = document.createElement('script');
		obj.s.type ='text/javascript';
		obj.s.charset ='utf-8';		  
		obj.s.src = 'http://apis.daum.net/local/geo/addr2coord?apikey=' + obj.apikey + '&output=json&callback=obj.pongSearch&q=' + encodeURI(pos);
//		obj.s.src = 'http://apis.daum.net/maps/addr2coord?apikey=' + obj.apikey + '&output=json&callback=obj.pongSearch&q=' + encodeURI(pos);
		document.getElementsByTagName('head')[0].appendChild(obj.s);
 	},

 	// 검색 결과를 뿌리는 함수 
	pongSearch : function(z){
		if(!z.channel || z.channel.item.length <= 0){
			nofra.innerHTML = "검색 결과가 없습니다.";
			return;
		}else{
			mapx = z.channel.item[0].point_y;
			mapy = z.channel.item[0].point_x;
			contents = encodeURI('<?=$API_TITLE?>');
			document.DaumMapAPI.location = "http://dna.daum.net/examples/maps/MissA/map_view.php?width=<?=$API_WIDTH?>&height=<?=$API_HEIGHT?>&latitude="+mapx+"&longitude="+mapy+"&contents="+contents+"&zoom=3";
		}
	}
};


window.onload = function(){
	obj.pingSearch('<?=$API_ADDR?>');
};
</script>


<table cellpadding='0' cellspacing='0' border='0'>
	<tr>
		<td><div id='nofra'></div><iframe name='DaumMapAPI' src='about:blank' width='<?=$API_WIDTH?>' height='<?=$API_HEIGHT?>' scrolling='no' frameborder='0'></iframe></td>
	</tr>
</table>