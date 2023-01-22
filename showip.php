<?php

if (isset($_GET["tz"]))
	date_default_timezone_set($_GET["tz"]);
else
	date_default_timezone_set("Europe/Berlin");
//date_default_timezone_set("Asia/Tehran");

$dt = date("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

if (isset($_GET["ret"])) {
	switch ($_GET["ret"]) {
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
			print("{\"date\":\"$d\", \"ip\":\"$ip\"}");
			break;
	}
} else {
	print($ip);
}

$name = $_GET["n"];
$data = "";
if (isset($_GET["data"]))
	$data = ", " . $_GET["data"];

try {
	$fp = fopen($name . "_ip.txt", "w");
	fwrite($fp, $ip);
	if (isset($_GET["data"]))
		fwrite($fp, " : " . $_GET["data"]);
	fclose($fp);

	$logfile = $name . "_log.txt";
	if (file_exists($logfile) && filesize($logfile) > 50000) {
		file_put_contents(substr($logfile, 0, -3) . "bak", file_get_contents($logfile),  FILE_APPEND);
		unlink($logfile);
	}

	$fp = fopen($logfile, "a");
	fwrite($fp, "$dt, $ip$data\r\n");
	fclose($fp);
	
} catch (Exception $e) {
	print_r($e);
}
