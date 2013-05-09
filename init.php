<?php
include("config.php");
include("db.php");
include("functions.php");
mb_internal_encoding("UTF-8");

$year=date('Y');
$month=date('m');
$fileName = date('Ymd').".pdf";

$link=RGURL."/$year/$month/$fileName";

DBConnect();
//header('Content-Type: text/html; charset=utf-8');

?>