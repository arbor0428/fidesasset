<?
for($i=1; $i<=$no; $i++){ 
	$ck = $no-$i+1;
	
	if($sdate){
		$snum = date('d',$sdate-((3600*24)*$ck));
		$sy = date('Y',$sdate);
		$sm = date('m',$sdate);
		$smk = mktime(0,0,0,$sm-1,1,$sy);
		$yy = date('Y',$smk);
		$mm = date('n',$smk);
	}

	if($edate){
		$snum=$i;
		$sy = date('Y',$edate);
		$sm = date('m',$edate);
		$smk = mktime(0,0,0,$sm,1,$sy);
		$yy = date('Y',$smk);
		$mm = date('n',$smk);
	}
?>
		<td valign='top'><div style='margin:3px 0 0 3px;' class='snum2'><?=$snum?></div></td>
<?
}
?>