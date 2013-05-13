<?php

function DBConnect(){
	
	$con=mysql_connect(DBHOST,DBUSER,DBPASS);
	mysql_select_db(DBNAME);
	mysql_set_charset("utf8");	
}

function DBClose(){
	
	mysql_close();
}

function DBGetKeywords(){
	
	$result=mysql_query("Select * from keywords");
	
	if($result)	return DBGetRows($result); 
	else return false;	
}

function DBGetKeywordsByGroup($kwGroup){
		
	$result=mysql_query("Select id from keywords where kwgroup='$kwGroup'");
	
	if(mysql_num_rows($result)>0) return DBGetRows($result); 
	else return false;	
}

function DBSaveResult($keywordId,$matchTxt,$index){
	//Save if match is not recorded
	if(!DBCheckResult($keywordId,$index))
	{
		$date=date('Y-m-d');
		$query="Insert into results values(DEFAULT,$keywordId,'$matchTxt',$index,'$date')";
		mysql_query($query);
	}
}


function DBCheckResult($keywordId,$index){
	$date=date('Y-m-d');
	$check=mysql_query("Select * from results where keywordid=$keywordId and keyindex=$index and date='$date'");
	if(mysql_num_rows($check)>0)
		return true;
	else 
		return false;
}	

function DBGetPersonKeywords(){
	$query="Select * from person p";
	$result=mysql_query($query);
	$personArr=DBGetRows($result);
	$personKeywordArr=array();
	foreach($personArr as $person){
		$person['kw']=DBGetKeywordsByGroup($person['kwgroup']);
		$personKeywordArr[]=$person;
	}
	return $personKeywordArr;
}

function DBGetResultbyKw($kwId){
	$today=date('Y-m-d'); 
	$query="Select * from results where keywordid=$kwId and date='$today'";
	$qResult=mysql_query($query);
	if(mysql_num_rows($qResult)>0)
		return DBGetRows($qResult);
	else return 0;
}



function DBGetRows($result){
	$rows=array();
	while ($row=mysql_fetch_assoc($result))
		array_push($rows,$row);
	
	return $rows;
}


?>