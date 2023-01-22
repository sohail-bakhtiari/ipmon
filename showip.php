<?php
date_default_timezone_set("Asia/Tehran");

try {
	
	print($_SERVER['REMOTE_ADDR']);

	
	$filename = $_GET["n"] . "_ip.txt";
	$fp = fopen($filename, "w");
	fwrite($fp, $_SERVER['REMOTE_ADDR']);
	if(isset($_GET["data"]))
		fwrite($fp, " : " . $_GET["data"]);
	fclose($fp);


	$filename = $_GET["n"] . "_log.txt";

	if(filesize($filename) > 50000)
	{
		file_put_contents(substr($filename, 0, -3) . "bak", file_get_contents($filename),  FILE_APPEND);
		unlink($filename);
	}

	$fp = fopen($filename, "a");

	//$tz = 'Asia/Tehran';
	//$timestamp = time();
	//$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
	//$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
	//echo $dt->format('d.m.Y, H:i:s');	
	
	fwrite($fp, date("D Y-m-d H:i:s") . " -> " . $_SERVER['REMOTE_ADDR']);
	
	if(isset($_GET["data"]))
		fwrite($fp, " : " . $_GET["data"]);
	
	fwrite($fp, "\r\n");
	fclose($fp);
	
} catch (Exception $e) {
	print_r($e);
}
?>
