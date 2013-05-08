<?php
mb_internal_encoding("UTF-8");
header('Content-Type: text/html; charset=utf-8');

pdfSaveSearch();


function getResmiGazetePDF(){
	$year=date('Y');
	$month=date('m');
	$fileName = date('Ymd').".pdf";

	if(!file_exists("rg/".$fileName)){
		$link="http://www.resmigazete.gov.tr/eskiler/$year/$month/$fileName";
		shell_exec('wget '.$link.' -P rg/');
	}

	return "rg/".$fileName;
	
}

function pdfSaveSearch(){

$filePath=getResmiGazetePDF();
$content = shell_exec('pdftotext '.$filePath.' -');

//TODO get keywords
$keywords = array("bilgisayar","bilgisayar mühendisliği","bilişim","yazılım");

foreach($keywords as $keyword)
{
	$pregRes = preg_match_all("/(*UTF8)$keyword/i", $content, $result,PREG_OFFSET_CAPTURE);

	$i=1;

	foreach($result[0] as $ins){
		$matchTxt = substr($content, $ins[1]-100,200);
	
		$fIndex=strpos($matchTxt," ");
		$lIndex=strrpos($matchTxt," ");
		$length=$lIndex - $fIndex;
		$matchTxt=substr($matchTxt,$fIndex+1,$length);
	
		$matchTxt=str_replace($keyword,"<b>$keyword</b>",$matchTxt);

		echo $i."-".$matchTxt."<p>";
		//TODO:save match result

		$i++;
	}
}


}

?>
