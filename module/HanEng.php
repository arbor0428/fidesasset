<?php

function hanCho($gg){
	include "HanArray.php";
	
	$c_count = 0;
	for($i=0; $i<strlen($gg); $i++){
		if( ord($gg[$i]) == 0xa4 && ( ord($gg[$i+1]) >= 0xa1 && ord($gg[$i+1]) <= 0xd3 ) ){
			$j = ord($gg[++$i]) - 0xa1;
			$code[$c_count] = $h_n_table[$j];
		}else if( (ord($gg[$i]) >= 0xb0) && (ord($gg[$i]) <= 0xc8) && (ord($gg[$i+1]) >= 0xa1) && (ord($gg[$i+1]) <= 0xfe) ){
			$j = (int)(ord($gg[$i]) - 0xb0) * 0x5e + (int)(ord($gg[$i+1]) - 0xa1);
			$code[$c_count] = $h_table[$j];
			$i++;
		}else{
			$code[$c_count] = ord($gg[$i]);
		}
		$c_count++;
	}

	for($i = 0; $i < $c_count; $i++){
		if( $code[$i] > 0xFF ){
			$cho = ( $code[$i] & 0x7c00 ) >> 10;
			$jung = ( $code[$i] & 0x03e0 ) >> 5;
			$jong = ( $code[$i] & 0x001f );
			if($i > 0)		$str .= '/';
			$str .= $font['cho'][$jo['cho'][$cho]];
//			$str .= $font['cho'][$jo['cho'][$cho]] . $font['jung'][$jo['jung'][$jung]] . $font['jong'][ $jo['jong'][$jong] ] . " ";

		}else{
			if( $code[$i] == 32 )	$str .= '　';
			else							$str .= chr($code[$i]);

		}
	}
	return $str;
}

function initial($str){
	$engArr01 = Array('ㄱ'=>'k', 'ㄲ'=>'k', 'ㄴ'=>'n', 'ㄷ'=>'d', 'ㄸ'=>'d','ㄹ'=>'r', 'ㅁ'=>'m', 'ㅂ'=>'p', 'ㅃ'=>'b', 'ㅅ'=>'s', 'ㅆ'=>'s','ㅇ'=>'l', 'ㅈ'=>'j', 'ㅉ'=>'j', 'ㅊ'=>'c', 'ㅋ'=>'k', 'ㅌ'=>'t', 'ㅍ'=>'p', 'ㅎ'=>'h');
	$engArr02 = Array('ㄱ'=>'k', 'ㄲ'=>'k', 'ㄴ'=>'n', 'ㄷ'=>'d', 'ㄸ'=>'d','ㄹ'=>'r', 'ㅁ'=>'m', 'ㅂ'=>'b', 'ㅃ'=>'b', 'ㅅ'=>'s', 'ㅆ'=>'s','ㅇ'=>'y', 'ㅈ'=>'j', 'ㅉ'=>'j', 'ㅊ'=>'c', 'ㅋ'=>'k', 'ㅌ'=>'t', 'ㅍ'=>'p', 'ㅎ'=>'h');

	$eng = '';
	$han = explode('/',$str);
	for($i=0; $i<count($han); $i++){
		if($i == 0)	$eArr = $engArr01;	//초성(성)
		else			$eArr = $engArr02;	//중성, 종성(이름)

		$txt = $han[$i];
		if($txt)	$eng .= $eArr[$txt];
	}

	return $eng;
}
?>