<?
	include "../header.php";
?>

<div class="sub_visual sub_visual03 visual_wrap">
	<div class="text-box">고객상담안내</div>
</div>
<style>
.memo {
    padding: 90px 0;
    border-top: 1px solid #ddd;
}
.memo:last-child {
    border-bottom: 1px solid #ddd;
}
.memo dt {
    float: left;
    width: 400px;
    line-height: 1.2;
    font-size: 30px;
    font-weight: 500;
	padding-left:50px;
	box-sizing:border-box;
	position:relative;
}
.memo dd {
    float: right;
    width: calc(100% - 400px);
    padding: 0px;
    font-size: 18px;
    font-weight: 300;
	color:#333333;
	position:relative;
}
.businessDNA {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
}
.businessDNA li {
    position: relative;
    padding-top: 136px;
    width: 126px;
    text-align: center;
}
.businessDNA li:after {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 126px;
    height: 126px;
    background-position: left top;
    background-repeat: no-repeat;
}
.businessDNA_1:after {background-image: url("../images/sub04_icon01.png");}
.businessDNA_2:after {background-image: url("../images/sub04_icon02.png");}
.businessDNA_3:after {background-image: url("../images/sub04_icon03.png");}
.businessDNA_4:after {background-image: url("../images/sub04_icon04.png");}
.businessDNA_5:after {background-image: url("../images/sub04_icon05.png");}

.memoImg{background:url(/images/sub0501.jpg);background-size:cover;overflow:hidden;}
.memoImg,.memoImg dd{color:#ffffff;}
.sub0401{display:none;;}
@media screen and (max-width:1023px){

	.memo dt {
		float: none;
		width: 100%;
	    font-size: 20px;
		padding-left:0;
	}
	.memo dd {
		float: none;
		width: 100%;
		padding-top: 26px;
		font-size: 14px;
	}
	.memo {
		padding: 0px;
		margin-top:40px;
		border-top: none;
		border-bottom: none;
	}
	.businessDNA li {
		margin-top: 18px;
		padding-top: 78px;
		width: 33.3333%;
	}
	.businessDNA li:after {
		left: 50%;
		width: 70px;
		height: 70px;
		background-size: cover;
		-webkit-transform: translate(-50%, 0);
		transform: translate(-50%, 0);
	}
	.businessDNA {
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
		-webkit-box-pack: start;
		-ms-flex-pack: start;
		justify-content: start;
	}	
	.memo:last-child {
		border-bottom:none;
	}
	.memoImg,.memoImg dd{color:initial;}
	.memoImg{background:initial}
	.sub0401{display:block;}
}
.memoImg:before {content: '';display: block;width: 120%;height: 100%;position: absolute;left: 0;top: 0;-webkit-transform-origin: right top;-ms-transform-origin: right top;transform-origin: right top;-webkit-transform: translateX(-101%) skewX(-17.62deg);-ms-transform: translateX(-101%) skewX(-17.62deg);transform: translateX(-101%) skewX(-17.62deg);-webkit-transition: -webkit-transform .55s cubic-bezier(.52,.08,.18,1);transition: -webkit-transform .55s cubic-bezier(.52,.08,.18,1);transition: transform .55s cubic-bezier(.52,.08,.18,1);transition: transform .55s cubic-bezier(.52,.08,.18,1), -webkit-transform .55s cubic-bezier(.52,.08,.18,1);-webkit-backface-visibility: hidden;backface-visibility: hidden;}
.memoImg:before{background:rgba(0,0,0,0.3)}
.memoImg:hover:before {-webkit-transform: translateX(0) skewX(-17.62deg);-ms-transform: translateX(0) skewX(-17.62deg);transform: translateX(0) skewX(-17.62deg);-webkit-transform-origin: left top;-ms-transform-origin: left top;transform-origin: left top;}

</style>
<div class='content_box'>
	<img src='/images/sub0501.jpg' style='width:100%;' class='sub0401'>
	<dl class="memo clearfix memoImg" <?=$aosFadeUp?>>
		<dt>고객상담안내</dt>
		<dd data-scrollani="up">
			오스틴제약은 고객님들의 문의에<br>
			친절, 신속, 정확하게 대응할 수 있도록 최선을 다하겠습니다.

		</dd>
	</dl>
	<dl class="memo clearfix" <?=$aosFadeUp?>>
		<dt>문의전화</dt>
		<dd data-scrollani="up">
			<div><b>소비자 상담실</b> : 080-010-5510 <span style='font-size:14px;'>(수신자 요금부담)</span></div>
			<div style='margin-top:15px;'><b>제품 및 영업문의</b> : 02-866-7773</div>
			<div style='margin-top:15px;'><b>생산 및 품질문의</b> : 031-494-9681</div>
			
		</dd>
	</dl>
	<dl class="memo clearfix" <?=$aosFadeUp?>>
		<dt>운영시간</dt>
		<dd data-scrollani="up">
			평일 09:00 ~ 17:00  / 점심시간 12:00 ~ 13:30<br>
			토,일요일 및 법정 공휴일 휴무
		</dd>
	</dl>
</div>

<?
	include "../footer.php";
?>