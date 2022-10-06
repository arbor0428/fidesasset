<?
	include "/home/austin/www/module/login/head.php";
	include "/home/austin/www/module/class/class.DbCon.php";
	include "/home/austin/www/module/class/class.Msg.php";
	include "/home/austin/www/module/class/class.Util.php";
?>

<head>

<?
	include "/home/austin/www/module/metaTag.php";
?>

    <!-- Custom fonts for this template-->
    <link href="/adm/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/adm/css/style.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="/adm/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

	<!-- Bootstrap core JavaScript-->
	<script src="/adm/vendor/jquery/jquery.min.js"></script>
	<script src="/adm/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="/adm/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Page level plugins -->
	<script src="/adm/vendor/chart.js/Chart.min.js"></script>
	<script src="/js/utils.js"></script>
	<script src="/js/Chart.bundle.js"></script>

	<!-- popupoverlay -->
	<link href="/module/popupoverlay/popupoverlay.css" rel="stylesheet">
	<script src="/module/js/common.js"></script>
	<script src="/module/popupoverlay/jquery.popupoverlay.js"></script>

	<link type='text/css' rel='stylesheet' href='/module/js/placeholder.css'><!-- 웹킷브라우져용 -->
	<script src="/module/js/jquery.placeholder.js"></script><!-- placeholder 태그처리용 -->
	<link href="/adm/css/button.css?v=1" rel="stylesheet">



	<script>
	if(navigator.userAgent.indexOf('Trident') > 0){
		location.href = "microsoft-edge:" + location.href;
		alert('익스플로러는 지원하지 않습니다\n엣지 또는 크롬등의 다른 브라우저로 접속해 주시기 바랍니다');
		setTimeout(close);
	}
	document.onselectstart=function(){return false;}
	</script>

</head>
<script>

function problemSubmit(){

	var chk = document.getElementsByName('uid[]');
	var answer = document.getElementsByName('answer[]');

	sid = $("select[name=f_sid]").val()

	if(!chk.length){
		GblMsgBox('출제할 문제가 없습니다.');
		return;
	}else{	
		chkArr='';
		answerArr='';
		for(var i = 0; i < chk.length; i++){
			if(chkArr)	chkArr += '/'+chk[i].value;
			else		chkArr = chk[i].value;

			if(answerArr)	answerArr += '/'+answer[i].value;
			else		answerArr = answer[i].value;
		}
	}

	f_class = $("select[name=f_class]").val()

	if(!f_class){
		GblMsgBox('반을 선택해주세요.');
		return;
	}
	sid = $("select[name=f_sid]").val()
/*

	if(!sid){
		GblMsgBox('출제대상을 설정해주세요.');
		return;
	}
*/
	$("#multiBox").css({"width":"90%","max-width":"500px"});
	$('#multi_ttl').text('문제출제하기 확인창');
	$('#multiFrame').html("<iframe src='/adm/problemSubmit.php?student="+sid+"&class="+f_class+"&chk="+chkArr+"&answer="+answerArr+"' name='modifyFrame' style='width:100%;height:270px;' frameborder='0' scrolling='auto'></iframe>");
	$('.multiBox_open').click();
}
function classAdd(t){
	$("#multiBox").css({"width":"90%","max-width":"500px"});
	$('#multi_ttl').text('반 리스트 추가');
	$('#multiFrame').html("<iframe src='/adm/classAdd.php?tuserid="+t+"' name='modifyFrame' style='width:100%;height:470px;' frameborder='0' scrolling='auto'></iframe>");
	$('.multiBox_open').click();
}
function userModify(){
	$("#multiBox").css({"width":"90%","max-width":"500px"});
	$('#multi_ttl').text('정보변경');
	$('#multiFrame').html("<iframe src='/adm/modify.php' name='modifyFrame' style='width:100%;height:470px;' frameborder='0' scrolling='auto'></iframe>");
	$('.multiBox_open').click();
}
function teacherModify(t){
	$("#multiBox").css({"width":"90%","max-width":"500px"});
	$('#multi_ttl').text('선생님 정보수정');
	$('#multiFrame').html("<iframe src='/adm/modifyT.php?tuserid="+t+"' name='modifyFrame' style='width:100%;height:555px;' frameborder='0' scrolling='auto'></iframe>");
	$('.multiBox_open').click();
}
function studentModify(t){
	$("#multiBox").css({"width":"90%","max-width":"500px"});
	$('#multi_ttl').text('학생 정보수정');
	$('#multiFrame').html("<iframe src='/adm/modifyS.php?userid="+t+"' name='modifyFrame' style='width:100%;height:680px;' frameborder='0' scrolling='auto'></iframe>");
	$('.multiBox_open').click();
}
function teacherAdd(){
	
	$("#multiBox").css({"width":"90%","max-width":"500px"});
	$('#multi_ttl').text('선생님 추가');
	$('#multiFrame').html("<iframe src='/adm/memberAddPop.php?mtype=T' name='modifyFrame' style='width:100%;height:600px;' frameborder='0' scrolling='auto'></iframe>");
	$('.multiBox_open').click();
}
function studentAdd(){
	
	$("#multiBox").css({"width":"90%","max-width":"500px"});
	$('#multi_ttl').text('학생 추가');
	$('#multiFrame').html("<iframe src='/adm/memberAddPop.php?mtype=M' name='modifyFrame' style='width:100%;height:720px;' frameborder='0' scrolling='auto'></iframe>");
	$('.multiBox_open').click();
}
function simulStudentAdd(){
	
	$("#multiBox").css({"width":"90%","max-width":"500px"});
	$('#multi_ttl').text('학생 추가');
	$('#multiFrame').html("<iframe src='/adm/memberAddPop.php?mtype=S' name='modifyFrame' style='width:100%;height:430px;' frameborder='0' scrolling='auto'></iframe>");
	$('.multiBox_open').click();
}
function class_edit(c,u){
	
	$("#multiBox").css({"width":"90%","max-width":"500px"});
	$('#multi_ttl').text('반 설정');
	$('#multiFrame').html("<iframe src='/adm/classAdd.php?class="+c+"&uid="+u+"' name='modifyFrame' style='width:100%;height:470px;' frameborder='0' scrolling='auto'></iframe>");
	$('.multiBox_open').click();
}

</script>
<script>

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}


</script>
