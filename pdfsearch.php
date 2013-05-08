<?php
include("init.php");

pdfSaveSearch();


function pdfSaveSearch(){

$filePath=getResmiGazetePDF();
$content = shell_exec('pdftotext '.$filePath.' -');

$keywordArr = DBGetKeywords();

foreach($keywordArr as $keywordRec)
{
	$keyword=$keywordRec["keyword"];
	
	$pregRes = preg_match_all("/(*UTF8)$keyword/i", $content, $result,PREG_OFFSET_CAPTURE);

	$i=1;

	//$ins : instance, structure :ins[0]->keyword, ins[1]=index 
	foreach($result[0] as $ins){
		$matchTxt = substr($content, $ins[1]-100,200);
	
		$fIndex=strpos($matchTxt," ");
		$lIndex=strrpos($matchTxt," ");
		$length=$lIndex - $fIndex;
		$matchTxt=substr($matchTxt,$fIndex+1,$length);
	
		$matchTxt=str_replace($keyword,"<b>$keyword</b>",$matchTxt);

		DBSaveResult($keywordRec['id'],$matchTxt,$ins[1]);

		$i++;
	}
}

}

function getResmiGazetePDF(){

	$year=date('Y');
	$month=date('m');
	$fileName = date('Ymd').".pdf";

	if(!file_exists(RGDIR.$fileName)){
		$link=RGURL."/$year/$month/$fileName";
		shell_exec('wget '.$link.' -P '.RGDIR);
	}

	return RGDIR.$fileName;
	
}


include("finish.php");

?>
