<?php

//path to directory to scan
$directory = "uploads/data/";
 
//get all csv files with a .csv extension.
$files = glob($directory . "*.csv");
 
//print each file name

$strRet = "";
foreach($files as $file)
{
	$strRet .= str_replace(".csv", "", str_replace("uploads/data/", "", $file)) . ",";
}

echo substr($strRet, 0, -1);
?>