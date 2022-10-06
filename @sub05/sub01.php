<?
	include "../header.php";
?>

<div class="sub_visual sub_visual03 visual_wrap">
	<div class="text-box">�����ȳ�</div>
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
		<dt>�����ȳ�</dt>
		<dd data-scrollani="up">
			����ƾ������ ���Ե��� ���ǿ�<br>
			ģ��, �ż�, ��Ȯ�ϰ� ������ �� �ֵ��� �ּ��� ���ϰڽ��ϴ�.

		</dd>
	</dl>
	<dl class="memo clearfix">
		<dt>������ȭ</dt>
		<dd data-scrollani="up">
			<table class='aTable01'>
				<tr>
					<th>�Һ��� ����</th>
					<td>080-010-5510 (������ ��ݺδ�)</td>
				</tr>
				<tr>
					<th>��ǰ �� ��������</th>
					<td>02-866-7773</td>
				</tr>
				<tr>
					<th>���� �� ǰ������</th>
					<td>031-494-9681</td>
				</tr>
			</table>
		</dd>
	</dl>
	<dl class="memo clearfix">
		<dt>��ð�</dt>
		<dd data-scrollani="up">
			���� 09:00 ~ 17:00  / ���ɽð� 12:00 ~ 13:30<br>
			��,�Ͽ��� �� ���� ������ �޹�
		</dd>
	</dl>
</div>

<?
	include "../footer.php";
?>