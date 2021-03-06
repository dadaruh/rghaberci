<?php

function pdfSaveSearch(){
	
$filePath=getResmiGazetePDF();
if($filePath == false) die(); //Today is sunday, no RG!

include("class.pdf2text.php");

$a = new PDF2Text();
$a->setFilename($filePath);
$a->setUnicode(true);
$a->decodePDF();

$content = $a->output(); 

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
		
			$matchTxt=str_ireplace($keyword,"<b>$keyword</b>",$matchTxt);
	
			DBSaveResult($keywordRec['id'],$matchTxt,$ins[1]);
	
			$i++;
		}
		echo $i." results saved<br>";
	}
}

function getResmiGazetePDF(){
	
	global $link, $fileName;
	if(!file_exists(RGDIR.$fileName)){
		shell_exec('wget '.$link.' -P '.RGDIR);
	}
	if(file_exists(RGDIR.$fileName))
		return RGDIR.$fileName;
	else 
		return false;
}

function sendMail(){
	
	$personKeywords=DBGetPersonKeywords();

	foreach ($personKeywords as $pKeyword) {
		$results[]='';
		reset($results);
		
		foreach ($pKeyword['kw'] as $kw) {
			$kwResult=DBGetResultbyKw($kw['id']);
			if($kwResult){				
				$results=array_merge($results,$kwResult);
			}
		}
		if(isset($results)) continue;
		
		$mailBody=formatText($results);
		$today=date('d.m.Y');
		$subject=$today.' tarihli Resmi Gazete Habercisi';
		$headers='From: '.FROM."\r\n" 
    		.'Reply-To: '.REPLYTO."\r\n"
			.'Content-type: text/html\r\n'
			."MIME-Version: 1.0\r\n";
		
		mail($pKeyword['email'],$subject,$mailBody,$headers);
	}
	echo "mail send completed<br>";
}

function formatText($results){
	

	$resultText="<ul>";
	foreach ($results as $result) {
		if(!empty($result))
			$resultText.="<li>".$result['text']."<p/></li>";
	}
	
	return getTemplate($resultText);
}

function getTemplate($resultText){
	
	global $link;
	$today=date('d.m.Y');
	$template=file_get_contents(TEMPLATE);
	$template=str_replace(array("##today##","##rglink##","##resulttext##"), array($today,$link,$resultText), $template);
	echo "we have the template<br>";
	return $template;
}

?>
