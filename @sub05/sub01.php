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
}
.memo dd {
    float: right;
    width: calc(100% - 400px);
    padding: 0px;
    font-size: 18px;
    font-weight: 300;
	color:#333333;
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
@media screen and (max-width:1023px){

	.memo dt {
		float: none;
		width: 100%;
	    font-size: 20px;
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
}
</style>
<div class='content_box'>
	<dl class="memo clearfix">
		<dt>고객상담안내</dt>
		<dd data-scrollani="up">
			오스틴제약은 고객님들의 문의에<br>
			친절, 신속, 정확하게 대응할 수 있도록 최선을 다하겠습니다.

		</dd>
	</dl>
	<dl class="memo clearfix">
		<dt>문의전화</dt>
		<dd data-scrollani="up">
			<table class='aTable01'>
				<tr>
					<th>소비자 상담실</th>
					<td>080-010-5510 (수신자 요금부담)</td>
				</tr>
				<tr>
					<th>제품 및 영업문의</th>
					<td>02-866-7773</td>
				</tr>
				<tr>
					<th>생산 및 품질문의</th>
					<td>031-494-9681</td>
				</tr>
			</table>
		</dd>
	</dl>
	<dl class="memo clearfix">
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