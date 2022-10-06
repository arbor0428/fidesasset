<?
    /* ============================================================================== */
    /* =   PAGE : 결제 요청 PAGE                                                    = */
    /* = -------------------------------------------------------------------------- = */
    /* =   이 페이지는 표준웹을 통해서 결제자가 결제 요청을 하는 페이지             = */
    /* =   입니다. 아래의 ※ 필수, ※ 옵션 부분과 매뉴얼을 참조하셔서 연동을        = */
    /* =   진행하여 주시기 바랍니다.                                                = */
    /* = -------------------------------------------------------------------------- = */
    /* =   연동시 오류가 발생하는 경우 아래의 주소로 접속하셔서 확인하시기 바랍니다.= */
    /* =   접속 주소 : http://kcp.co.kr/technique.requestcode.do                    = */
    /* = -------------------------------------------------------------------------- = */
    /* =   Copyright (c)  2016   NHN KCP Inc.   All Rights Reserverd.               = */
    /* ============================================================================== */
?>
<?
    /* ============================================================================== */
    /* =   환경 설정 파일 Include                                                   = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ※ 필수                                                                  = */
    /* =   테스트 및 실결제 연동시 site_conf_inc.php파일을 수정하시기 바랍니다.     = */
    /* = -------------------------------------------------------------------------- = */

    include "../cfg/site_conf_inc.php";

    /* = -------------------------------------------------------------------------- = */
    /* =   환경 설정 파일 Include END                                               = */
    /* ============================================================================== */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>*** NHN KCP [AX-HUB Version] ***</title>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
	<meta http-equiv="Pragma" content="no-cache"> 
	<meta http-equiv="Expires" content="-1">
<link href="css/style.css" rel="stylesheet" type="text/css" id="cssLink"/>

<script type="text/javascript">
		/****************************************************************/
        /* m_Completepayment  설명                                      */
        /****************************************************************/
        /* 인증완료시 재귀 함수                                         */
        /* 해당 함수명은 절대 변경하면 안됩니다.                        */
        /* 해당 함수의 위치는 payplus.js 보다먼저 선언되어여 합니다.    */
        /* Web 방식의 경우 리턴 값이 form 으로 넘어옴                   */
        /****************************************************************/
		function m_Completepayment( FormOrJson, closeEvent ) 
        {
            var frm = document.order_info; 
         
            /********************************************************************/
            /* FormOrJson은 가맹점 임의 활용 금지                               */
            /* frm 값에 FormOrJson 값이 설정 됨 frm 값으로 활용 하셔야 됩니다.  */
            /* FormOrJson 값을 활용 하시려면 기술지원팀으로 문의바랍니다.       */
            /********************************************************************/
            GetField( frm, FormOrJson ); 

            
            if( frm.res_cd.value == "0000" )
            {
//			    alert("결제 승인 요청 전,\n\n반드시 결제창에서 고객님이 결제 인증 완료 후\n\n리턴 받은 ordr_chk 와 업체 측 주문정보를\n\n다시 한번 검증 후 결제 승인 요청하시기 바랍니다."); //업체 연동 시 필수 확인 사항.
                /*
                    가맹점 리턴값 처리 영역
                */
             
                frm.submit(); 
            }
            else
            {
                alert( "[" + frm.res_cd.value + "] " + frm.res_msg.value );
                
                closeEvent();
				parent.$(".pgBox_close").click();		//결제창 닫기
            }
        }
</script>

<?
    /* ============================================================================== */
    /* =   Javascript source Include                                                = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ※ 필수                                                                  = */
    /* =   테스트 및 실결제 연동시 site_conf_inc.php파일을 수정하시기 바랍니다.     = */
    /* = -------------------------------------------------------------------------- = */
?>
    <script type="text/javascript" src='<?=$g_conf_js_url?>'></script>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   Javascript source Include END                                            = */
    /* ============================================================================== */
?>
    <script type="text/javascript">
        /* 표준웹 실행 */
        function jsf__pay( form )
        {
			try
			{
	            KCP_Pay_Execute( form ); 
			}
			catch (e)
			{
				/* IE 에서 결제 정상종료시 throw로 스크립트 종료 */ 
			}
        }             

        /* 주문번호 생성 예제 */
        function init_orderid()
        {
            var today = new Date();
            var year  = today.getFullYear();
            var month = today.getMonth() + 1;
            var date  = today.getDate();
            var time  = today.getTime();

            if(parseInt(month) < 10) {
                month = "0" + month;
            }

            if(parseInt(date) < 10) {
                date = "0" + date;
            }

            var order_idxx = "TEST" + year + "" + month + "" + date + "" + time;

            document.order_info.ordr_idxx.value = order_idxx;            
        }

        /*에스크로 결제시 필요한 장바구니 샘플예제 입니다.*/
        function create_goodInfo()
        {
            var chr30 = String.fromCharCode(30);	// ASCII 코드값 30
            var chr31 = String.fromCharCode(31);	// ASCII 코드값 31

            var good_info = "seq=1" + chr31 + "ordr_numb=20060310_0001" + chr31 + "good_name=양말" + chr31 + "good_cntx=2" + chr31 + "good_amtx=1000" + chr30 +
                            "seq=2" + chr31 + "ordr_numb=20060310_0002" + chr31 + "good_name=신발" + chr31 + "good_cntx=1" + chr31 + "good_amtx=1500" + chr30 +
                            "seq=3" + chr31 + "ordr_numb=20060310_0003" + chr31 + "good_name=바지" + chr31 + "good_cntx=1" + chr31 + "good_amtx=1000";

          document.order_info.good_info.value = good_info;
        }

        /* onLoad 이벤트 시 Payplus Plug-in이 실행되도록 구성하시려면 다음의 구문을 onLoad 이벤트에 넣어주시기 바랍니다. */
        function onload_pay()
        {
             if( jsf__pay(document.order_info) )
                document.order_info.submit();
        }
    </script>
</head>


<?
	include "../../class/class.DbCon.php";
	include "../../class/class.Util.php";
	include "../../class/class.Msg.php";



	if($pay_mode == '신용카드'){	
		$pay_method = '100000000000';	//신용카드

	}elseif($pay_mode == '계좌이체'){
		$pay_method = '010000000000';	//계좌이체

	}elseif($pay_mode == '가상계좌'){
		$pay_method = '001000000000';	//가상계좌

	}

	$rDate = date('Y-m-d H:i:s');
	$rTime = mktime();



	$good_name = '오스틴제약(주)';
	$good_mny = $amt;
	$buyr_name = $oname;
	$buyr_mail = $oemail;
	$buyr_tel1 = $otel1.$otel2.$otel3;


	//결제정보 임시저장
	include 'insert.php';
?>






<?
if($errorChk == ''){
?>
<body onload="setTimeout('onload_pay();',300);">
<?
}
?>



<div id="sample_wrap" style='display:none;'>

<!-- 주문정보 입력 form : order_info -->
<form name="order_info" method="post" action="./pp_cli_hub.php" >

<input type="text" name="pay_method" value="<?=$pay_method?>"><!-- 지불방법 -->
<input type="text" name="ordr_idxx" value="<?=$rTime?>"><!-- 주문번호 -->
<input type="text" name="good_name" value="<?=$good_name?>"><!-- 상품명 -->
<input type="text" name="good_mny" value="<?=$good_mny?>"><!-- 결제금액 -->
<input type="text" name="buyr_name" value="<?=$buyr_name?>"><!-- 주문자명 -->
<input type="text" name="buyr_mail" value="<?=$buyr_mail?>"><!-- 주문자이메일 -->
<input type="text" name="buyr_tel1" value="<?=$buyr_tel1?>"><!-- 주문자연락처1 -->
<input type="text" name="buyr_tel2" value=""><!-- 휴대폰번호 -->

<?
    /* ============================================================================== */
    /* =   1-2. 에스크로 정보                                                       = */
    /* = -------------------------------------------------------------------------- = */
    /* =   에스크로 사용업체에 적용되는 정보입니다.                                 = */
    /* = -------------------------------------------------------------------------- = */

	$rcvr_name = $buyr_name;
	$rcvr_tel1 = $buyr_tel1;
	$rcvr_tel2 = '';
	$rcvr_mail = $buyr_mail;
	$rcvr_zipx = '';
	$rcvr_add1 = '';
	$rcvr_add2 = '';
?>

<input type="text" name="rcvr_name" value="<?=$rcvr_name?>"><!-- 수취인명 -->
<input type="text" name="rcvr_tel1" value="<?=$rcvr_tel1?>"><!-- 수취인 전화번호 -->
<input type="text" name="rcvr_tel2" value="<?=$rcvr_tel2?>"><!-- 수취인 휴대폰번호 -->
<input type="text" name="rcvr_mail" value="<?=$rcvr_mail?>"><!-- 수취인 E-mail -->
<input type="text" name="rcvr_zipx" value="<?=$rcvr_zipx?>"><!-- 수취인 우편번호 -->
<input type="text" name="rcvr_add1" value="<?=$rcvr_add1?>"><!-- 수취인 주소 -->
<input type="text" name="rcvr_add2" value="<?=$rcvr_add2?>"><!-- 수취인 주소 -->

<?
    /* = -------------------------------------------------------------------------- = */
    /* =   1-2. 에스크로 정보  END					                                = */
    /* ============================================================================== */
?>
                    <!-- 결제 요청/처음으로 이미지 -->
                    <div class="btnset" id="display_pay_button" style="display:block">
                      <input name="" type="button" class="submit" value="결제요청" onclick="jsf__pay(this.form);"/>
                      <a href="../index.html" class="home">처음으로</a>
                    </div>
                    

<?
    /* = -------------------------------------------------------------------------- = */
    /* =   1. 주문 정보 입력 END                                                    = */
    /* ============================================================================== */
?>

<?
    /* ============================================================================== */
    /* =   2. 가맹점 필수 정보 설정                                                 = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ※ 필수 - 결제에 반드시 필요한 정보입니다.                               = */
    /* =   site_conf_inc.php 파일을 참고하셔서 수정하시기 바랍니다.                 = */
    /* = -------------------------------------------------------------------------- = */
    // 요청종류 : 승인(pay)/취소,매입(mod) 요청시 사용
?>
    <input type="hidden" name="req_tx"          value="pay" />
    <input type="hidden" name="site_cd"         value="<?=$g_conf_site_cd	?>" />
    <input type="hidden" name="site_name"       value="<?=$g_conf_site_name ?>" />

<?
    /*
    할부옵션 : 표준웹에서 카드결제시 최대로 표시할 할부개월 수를 설정합니다.(0 ~ 18 까지 설정 가능)
    ※ 주의  - 할부 선택은 결제금액이 50,000원 이상일 경우에만 가능, 50000원 미만의 금액은 일시불로만 표기됩니다
               예) value 값을 "5" 로 설정했을 경우 => 카드결제시 결제창에 일시불부터 5개월까지 선택가능
    */
?>
    <input type="hidden" name="quotaopt"        value="12"/>
    <!-- 필수 항목 : 결제 금액/화폐단위 -->
    <input type="hidden" name="currency"        value="WON"/>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   2. 가맹점 필수 정보 설정 END                                             = */
    /* ============================================================================== */
?>

<?
    /* ============================================================================== */
    /* =   3. 표준웹 필수 정보(변경 불가)                                   = */
    /* = -------------------------------------------------------------------------- = */
    /* =   결제에 필요한 주문 정보를 입력 및 설정합니다.                            = */
    /* = -------------------------------------------------------------------------- = */
?>
    <!-- 표준웹 설정 정보입니다(변경 불가) -->
    <input type="hidden" name="module_type"     value="<%= module_type %>"/>
    <!-- 복합 포인트 결제시 넘어오는 포인트사 코드 : OK캐쉬백(SCSK), 베네피아 복지포인트(SCWB) -->
    <input type="hidden" name="epnt_issu"       value="" />
<?
    /* ============================================================================== */
    /* =   3-1. 표준웹 에스크로결제 사용시 필수 정보                        = */
    /* = -------------------------------------------------------------------------- = */
    /* =   결제에 필요한 주문 정보를 입력 및 설정합니다.                            = */
    /* = -------------------------------------------------------------------------- = */
?>
	<!-- 에스크로 사용 여부 : 반드시 Y 로 설정 -->
    <input type="hidden" name="escw_used"       value="Y"/>
	<!-- 에스크로 결제처리 모드 : 에스크로: Y, 일반: N, KCP 설정 조건: O  -->
    <input type="hidden" name="pay_mod"         value="Y"/>
	<!-- 배송 소요일 : 예상 배송 소요일을 입력 -->
	<input type="hidden"  name="deli_term" value="03"/>
	<!-- 장바구니 상품 개수 : 장바구니에 담겨있는 상품의 개수를 입력(good_info의 seq값 참조) -->
	<input type="hidden"  name="bask_cntx" value=""/>
	<!-- 장바구니 상품 상세 정보 (자바 스크립트 샘플 create_goodInfo()가 온로드 이벤트시 설정되는 부분입니다.) -->
	<input type="hidden" name="good_info"       value=""/>
<?
    /* = -------------------------------------------------------------------------- = */
    /* =   3-1. 표준웹 에스크로결제 사용시 필수 정보  END                   = */
    /* ============================================================================== */
?>
<!--
      ※ 필 수
          필수 항목 : 표준웹에서 값을 설정하는 부분으로 반드시 포함되어야 합니다
          값을 설정하지 마십시오
-->
    <input type="hidden" name="res_cd"          value=""/>
    <input type="hidden" name="res_msg"         value=""/>
    <input type="hidden" name="enc_info"        value=""/>
    <input type="hidden" name="enc_data"        value=""/>
    <input type="hidden" name="ret_pay_method"  value=""/>
    <input type="hidden" name="tran_cd"         value=""/>
    <input type="hidden" name="use_pay_method"  value=""/>
	
	<!-- 주문정보 검증 관련 정보 : 표준웹 에서 설정하는 정보입니다 -->
	<input type="hidden" name="ordr_chk"        value=""/>

    <!--  현금영수증 관련 정보 : 표준웹 에서 설정하는 정보입니다 -->
    <input type="hidden" name="cash_yn"         value=""/>
    <input type="hidden" name="cash_tr_code"    value=""/>
    <input type="hidden" name="cash_id_info"    value=""/>

	<!-- 2012년 8월 18일 정자상거래법 개정 관련 설정 부분 -->
	<!-- 제공 기간 설정 0:일회성 1:기간설정(ex 1:2012010120120131)  -->
	<input type="hidden" name="good_expr" value="0">

<?
    /* = -------------------------------------------------------------------------- = */
    /* =   3. 표준웹 필수 정보 END                                          = */
    /* ============================================================================== */
?>

<?
    /* ============================================================================== */
    /* =   4. 옵션 정보                                                             = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ※ 옵션 - 결제에 필요한 추가 옵션 정보를 입력 및 설정합니다.             = */
    /* = -------------------------------------------------------------------------- = */

	/* 사용카드 설정 여부 파라미터 입니다.(통합결제창 노출 유무)
	<input type="hidden" name="used_card_YN"        value="Y"/> */
	/* 사용카드 설정 파라미터 입니다. (해당 카드만 결제창에 보이게 설정하는 파라미터입니다. used_card_YN 값이 Y일때 적용됩니다.
	/<input type="hidden" name="used_card"        value="CCBC:CCKM:CCSS"/> */

    /* 신용카드 결제시 OK캐쉬백 적립 여부를 묻는 창을 설정하는 파라미터 입니다
         포인트 가맹점의 경우에만 창이 보여집니다
        <input type="hidden" name="save_ocb"        value="Y"/> */

	/* 고정 할부 개월 수 선택
	       value값을 "7" 로 설정했을 경우 => 카드결제시 결제창에 할부 7개월만 선택가능
    <input type="hidden" name="fix_inst"        value="07"/> */

    /*  무이자 옵션
            ※ 설정할부    (가맹점 관리자 페이지에 설정 된 무이자 설정을 따른다)                             - "" 로 설정
            ※ 일반할부    (KCP 이벤트 이외에 설정 된 모든 무이자 설정을 무시한다)                           - "N" 로 설정
            ※ 무이자 할부 (가맹점 관리자 페이지에 설정 된 무이자 이벤트 중 원하는 무이자 설정을 세팅한다)   - "Y" 로 설정
    <input type="hidden" name="kcp_noint"       value=""/> */

    /*  무이자 설정
            ※ 주의 1 : 할부는 결제금액이 50,000 원 이상일 경우에만 가능
            ※ 주의 2 : 무이자 설정값은 무이자 옵션이 Y일 경우에만 결제 창에 적용
            예) 전 카드 2,3,6개월 무이자(국민,비씨,엘지,삼성,신한,현대,롯데,외환) : ALL-02:03:04
            BC 2,3,6개월, 국민 3,6개월, 삼성 6,9개월 무이자 : CCBC-02:03:06,CCKM-03:06,CCSS-03:06:04
    <input type="hidden" name="kcp_noint_quota" value="CCBC-02:03:06,CCKM-03:06,CCSS-03:06:09"/> */


	/* 해외카드 구분하는 파라미터 입니다.(해외비자, 해외마스터, 해외JCB로 구분하여 표시)
	<input type="hidden" name="used_card_CCXX"        value="Y"/> */

    /*  가상계좌 은행 선택 파라미터
         ※ 해당 은행을 결제창에서 보이게 합니다.(은행코드는 매뉴얼을 참조)
    <input type="hidden" name="wish_vbank_list" value="05:03:04:07:11:23:26:32:34:81:71"/> */

    /*  가상계좌 입금 기한 설정하는 파라미터 - 발급일 + 3일
    <input type="hidden" name="vcnt_expire_term" value="3"/> */

    /*  가상계좌 입금 시간 설정하는 파라미터
         HHMMSS형식으로 입력하시기 바랍니다
         설정을 안하시는경우 기본적으로 23시59분59초가 세팅이 됩니다
         <input type="hidden" name="vcnt_expire_term_time" value="120000"/> */

    /* 포인트 결제시 복합 결제(신용카드+포인트) 여부를 결정할 수 있습니다.- N 일경우 복합결제 사용안함
        <input type="hidden" name="complex_pnt_yn" value="N"/>    */

    /* 현금영수증 등록 창을 출력 여부를 설정하는 파라미터 입니다
         ※ Y : 현금영수증 등록 창 출력
         ※ N : 현금영수증 등록 창 출력 안함 
	※ 주의 : 현금영수증 사용 시 KCP 상점관리자 페이지에서 현금영수증 사용 동의를 하셔야 합니다
        <input type="hidden" name="disp_tax_yn"     value="Y"/> */

    /* 결제창에 가맹점 사이트의 로고를 결제창 좌측 상단에 출력하는 파라미터 입니다
       업체의 로고가 있는 URL을 정확히 입력하셔야 하며, 최대 150 X 50  미만 크기 지원

	※ 주의 : 로고 용량이 150 X 50 이상일 경우 site_name 값이 표시됩니다.
        <input type="hidden" name="site_logo"       value="" /> */

	/* 결제창 영문 표시 파라미터 입니다. 영문을 기본으로 사용하시려면 Y로 세팅하시기 바랍니다
		2010-06월 현재 신용카드와 가상계좌만 지원됩니다
	    <input type='hidden' name='eng_flag'      value='Y'> */

	/* KCP는 과세상품과 비과세상품을 동시에 판매하는 업체들의 결제관리에 대한 편의성을 제공해드리고자, 
	   복합과세 전용 사이트코드를 지원해 드리며 총 금액에 대해 복합과세 처리가 가능하도록 제공하고 있습니다
	   복합과세 전용 사이트 코드로 계약하신 가맹점에만 해당이 됩니다
       상품별이 아니라 금액으로 구분하여 요청하셔야 합니다
	   총결제 금액은 과세금액 + 부과세 + 비과세금액의 합과 같아야 합니다. 
	   (good_mny = comm_tax_mny + comm_vat_mny + comm_free_mny)
	
	    <input type="hidden" name="tax_flag"       value="TG03">  <!-- 변경불가	   -->
	    <input type="hidden" name="comm_tax_mny"   value=""    >  <!-- 과세금액	   --> 
        <input type="hidden" name="comm_vat_mny"   value=""    >  <!-- 부가세	   -->
	    <input type="hidden" name="comm_free_mny"  value=""    >  <!-- 비과세 금액 --> */

	/* skin_indx 값은 스킨을 변경할 수 있는 파라미터이며 총 7가지가 지원됩니다. 
	   변경을 원하시면 1부터 7까지 값을 넣어주시기 바랍니다. 

		<input type='hidden' name='skin_indx'      value='1'> */

	/* 상품코드 설정 파라미터 입니다.(상품권을 따로 구분하여 처리할 수 있는 옵션기능입니다.)
	    <input type='hidden' name='good_cd'      value=''> */
		
	/* 가맹점에서 관리하는 고객 아이디 설정을 해야 합니다. 상품권 결제 시 반드시 입력하시기 바랍니다.
        <input type="hidden" name="shop_user_id"    value=""/> */

    /* 복지포인트 결제시 가맹점에 할당되어진 코드 값을 입력해야합니다.
        <input type="hidden" name="pt_memcorp_cd"   value=""/> */

    /* = -------------------------------------------------------------------------- = */
    /* =   4. 옵션 정보 END                                                         = */
    /* ============================================================================== */
?>
</form>
</div>
</body>
</html>