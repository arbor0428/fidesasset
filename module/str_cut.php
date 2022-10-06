<?
function Shorten_String($String, $MaxLen, $ShortenStr){
		$StringLen = strlen($String);
		$EffectLen = $MaxLen - strlen($ShortenStr);

		if ( $StringLen < $MaxLen )return $String; 

		for ($i = 0; $i <= $EffectLen; $i++) { 
			$LastStr = substr($String, $i, 1); 
			if ( ord($LastStr) > 127 ) $i++; 
		} 

		$RetStr = substr($String, 0, $i); 

		return $RetStr .= $ShortenStr; 
}
?>