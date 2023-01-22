<?php

if(isset($_GET["tz"]))
	date_default_timezone_set($_GET["tz"]);
else
	date_default_timezone_set("Europe/Berlin");
	//date_default_timezone_set("Asia/Tehran");

$files = glob("*_ip.txt");

foreach($files as $filename)
{
	print( "<b>" . substr($filename, 0, -7) . "</b> <font size=-2>(" .  date("D m/d H:i", filemtime($filename)) . ")</font><br><font color=blue><a href='" . substr($filename, 0, -6) . "log.txt' target='_blank'>");
	print(file_get_contents($filename) . "</a></font><br><br>");
}
