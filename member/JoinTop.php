<!--
<style>
#joinTop {position:relative; width:100%; margin:30px auto; box-sizing:border-box;}
#joinTop:after {content:""; display:block; clear:both;}
#joinTop h2.tit {font-size:34px; color:#222; text-align:center; padding:47px 0 30px 0;}
#joinTop h2.tit span {display:block; font-size:15px; padding-top:14px; line-height:22px;}

div.member_box {background-color:#eee; border-top:1px solid #222; padding:35px 0;}
div.member_box h2 {font-size:15px; color:#666; line-height:24px; text-align:center; font-weight:300; padding:0 30px; word-break:keep-all;}

div.member_box div.join_step1 {padding-top:52px;height:150px;}
div.member_box div.join_step1 dl {text-align:center;margin-top:20px;}
div.member_box div.join_step1 dl dt {margin:0 auto;}

div.member_box div.join_step1 dl dt h4 {}
div.member_box div.join_step1 dl dt h4 a {display:inline-block; font-size:15px; color:#fff; width:140px; height:42px; line-height:42px; background-color:#043b73;}
div.member_box div.join_step1 dl dt p a {display:inline-block; font-size:15px; color:#fff; width:140px; height:42px; line-height:42px; background-color:#043b73;}
div.member_box div.join_step1 dl dt p a:hover {background-color:#f47c46;}
div.member_box div.join_step1 dl dd {float:left; width:6%; height:160px; line-height:160px; background:url("/images/member/step1_line.gif") repeat-y center top;}
div.member_box div.join_step1 dl dd span {display:inline-block; font-size:15px; color:#888; background-color:#eee; padding:15px 0;margin-top:50px;}

/* join_step01 */
div.member_box div.join_step1 {padding-top:20px;}
div.member_box div.join_step1 dl {height:120px;}
div.member_box div.join_step1 dl:after {clear:both; content:""; display:block;}
/*
div.member_box div.join_step1 dl dt {padding-bottom:20px;width:40%;float:left;}
div.member_box div.join_step1 dl dt:nth-child(1){margin-left:10%;}
*/

div.member_box div.join_step1 dl dt {padding-bottom:20px;width:40%;}

div.member_box div.join_step1 dl dt h3 {padding-bottom:20px}
div.member_box div.join_step1 dl dt p a {font-size:13px; width:70%; height:40px; line-height:40px;}
div.member_box div.join_step1 dl dd {height:120px; line-height:120px;}
div.member_box div.join_step1 dl dd span {font-size:11px; padding:8px 0;margin-top:40px;}
div.member_box div.btn_cont a.btn01{max-width:inherit;}


div.info_use h2 {font-size:16px; color:#222; padding-bottom:14px; line-height:21px; padding-left:22px; background:url("/images/info_icon.gif") no-repeat;}
div.info_use p {font-size:14px; color:#888; line-height:22px; font-weight:300; padding-bottom:12px; padding-left:15px; margin-left:5px;word-break:keep-all; background:url("/images/info_bullet.gif") no-repeat left 10px;}

div.info_use {padding:25px 10px;}

.stepWrap{width:100%;margin:0 auto;}
.stepBox{width:25%;height:100px;float:left;}
.stepBox li{float:left;}
.stepBox li img{width:200px;}

.stepCircleText{
	width:100%;
	height:20px;
	padding-top:5px;
	text-align:center;
}
</style>

<?
$stepImg01 = "<img src='/images/sub/join_icon_01.png' alt='step1'>";
$stepImg02 = "<img src='/images/sub/join_icon_02.png' alt='step2'>";
$stepImg03 = "<img src='/images/sub/join_icon_03.png' alt='step3'>";
$stepImg04 = "<img src='/images/sub/join_icon_04.png' alt='step4'>";

if($step == 1)			$stepImg01 = "<img src='/images/sub/join_icon_h01.png' alt='step1'>";
elseif($step == 2)		$stepImg02 = "<img src='/images/sub/join_icon_h02.png' alt='step2'>";
elseif($step == 3)		$stepImg03 = "<img src='/images/sub/join_icon_h03.png' alt='step3'>";
elseif($step == 4)		$stepImg04 = "<img src='/images/sub/join_icon_h04.png' alt='step4'>";
?>

<div id="joinTop">
	<div class='stepWrap'>
		<div class='stepBox clearfix'>
			<li><?=$stepImg01?></li>
			<li class='stepCircleText'>약관동의</li>
		</div>		

		<div class='stepBox clearfix'>
			<li><?=$stepImg02?></li>
			<li class='stepCircleText'>본인인증</li>
		</div>		

		<div class='stepBox clearfix'>
			<li><?=$stepImg03?></li>
			<li class='stepCircleText'>정보입력</li>
		</div>		

		<div class='stepBox clearfix'>
			<li><?=$stepImg04?></li>
			<li class='stepCircleText'>가입완료</li>
		</div>
	</div>
</div>
-->