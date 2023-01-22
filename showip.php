<?php

if(isset($_GET["tz"]))
	date_default_timezone_set($_GET["tz"]);
else
	date_default_timezone_set("Europe/Berlin");
	//date_default_timezone_set("Asia/Tehran");


$dt = date("D Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

if(isset($_GET["ret"]))
{
	switch($_GET["ret"])
	{
		case "ip":
			print($ip);
			break;
		
		case "time":
			print($dt);
			break;

		case "time-ip":
			print("$dt - $ip");
			break;
		case "json":
			$dshort = date("Y-m-d");
			$tshort = date("H:i:s");
			print("{\"date\":\"$dshort\", \"time\":\"$tshort\", \"ip\":\"$ip\"}");
			break;
	}
} 
else 
{
	print($ip);
}

try 
{
	$filename = $_GET["n"] . "_ip.txt";
	$fp = fopen($filename, "w");
	fwrite($fp, $ip);
	if(isset($_GET["data"]))
		fwrite($fp, " : " . $_GET["data"]);
	fclose($fp);

	$filename = $_GET["n"] . "_log.txt";

	if(file_exists($filename) && filesize($filename) > 50000)
	{
		file_put_contents(substr($filename, 0, -3) . "bak", file_get_contents($filename),  FILE_APPEND);
		unlink($filename);
	}

	$fp = fopen($filename, "a");
	fwrite($fp, "$dt -> $ip");
	
	if(isset($_GET["data"]))
		fwrite($fp, " : " . $_GET["data"]);
	
	fwrite($fp, "\r\n");
	fclose($fp);
	
} catch (Exception $e) {
	print_r($e);
}
