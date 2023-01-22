<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Device List</title>
	<style>
		/* https://divtable.com/table-styler/ */
		table.comicGreen {
			font-family: "Comic Sans MS", cursive, sans-serif;
			border: 2px solid #4F7849;
			background-color: #EEEEEE;
			width: 80%;
			text-align: center;
			border-collapse: collapse;
		}

		table.comicGreen td,
		table.comicGreen th {
			border: 2px solid #4F7849;
			padding: 3px 2px;
		}

		table.comicGreen tbody td {
			font-size: 19px;
			font-weight: bold;
			color: #4F7849;
		}

		table.comicGreen tr:nth-child(even) {
			background: #CEE0CC;
		}

		table.comicGreen tfoot {
			font-size: 21px;
			font-weight: bold;
			color: #FFFFFF;
			background: #4F7849;
			background: -moz-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%);
			background: -webkit-linear-gradient(top, #7b9a76 0%, #60855b 66%, #4F7849 100%);
			background: linear-gradient(to bottom, #7b9a76 0%, #60855b 66%, #4F7849 100%);
			border-top: 1px solid #444444;
		}

		table.comicGreen tfoot td {
			font-size: 21px;
		}
	</style>
</head>

<body>
	<?php
	if (isset($_GET["tz"]))
		date_default_timezone_set($_GET["tz"]);
	else
		date_default_timezone_set("Europe/Berlin");
	//date_default_timezone_set("Asia/Tehran");
	$files = glob("*_ip.txt");
	?>

	<table class="comicGreen">
		<thead>
			<th>Device</th>
			<th>Last Update</th>
			<th>IP</th>
			<th>Data</th>
		</thead>
		<?php
		foreach ($files as $filename) {
			$name = substr($filename, 0, -7);
			$last = date("D m/d H:i", filemtime($filename));
			list($ip, $data) = explode(":", file_get_contents($filename), 2);
			echo "<tr>";
			echo "<td><font color=blue><a href='$name" . "_log.txt' target='_blank'>$name</a></td>";
			echo "<td>$last</td>";
			echo "<td>$ip</td>";
			echo "<td>$data</td>";
			echo "</tr>";
		}
		?>
	</table>
</body>

</html>