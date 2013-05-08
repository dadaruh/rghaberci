<?php

function DBConnect()
{
	$con=mysql_connect(DBHOST,DBUSER,DBPASS);
	mysql_select_db(DBNAME);
	mysql_set_charset("utf8");	
}

function DBClose()
{
	mysql_close();
}

function DBGetKeywords()
{
	$result=mysql_query("Select * from keywords");
	
	if($result)	return DBGetRows($result); 
	else return false;	
}

function DBSaveResult($keywordId,$matchTxt,$index)
{
	//Save if match is not recorded
	if(!DBCheckResult($keywordId,$index))
	{
		$date=date('Y-m-d');
		$query="Insert into results values(DEFAULT,$keywordId,'$matchTxt',$index,'$date')";
		mysql_query($query);
	}
}

function DBSendResult()
{


//TODO+Log Email	
}

function DBGetRows($result){
	$rows=array();
	while ($row=mysql_fetch_assoc($result))
		array_push($rows,$row);
	
	return $rows;
}

function DBCheckResult($keywordId,$index){
	$date=date('Y-m-d');
	$check=mysql_query("Select * from results where keywordid=$keywordId and keyindex=$index and date='$date'");
	if(mysql_num_rows($check)>0)
		return true;
	else 
		return false;
}	


?>