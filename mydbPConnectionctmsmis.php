<?php		
	$dbFilePath = $_SERVER['DOCUMENT_ROOT']."/Database/ConnectionN4.txt";
	$dbFile = fopen($dbFilePath, "r") or die("Unable to open DB file!");
	$myCurrDb = trim(fread($dbFile,filesize($dbFilePath)));
	fclose($dbFile);
	$con_ctmsmis=mysql_connect($myCurrDb, "sparcsn4", "sparcsn4");	
	mysql_select_db("ctmsmis");
	
?>
