<?php

$file = fopen("taskInfo.txt", 'r') or die("unable to open");

while (!feof($file)) {
	$data = explode("||", fgets($file));
	foreach ($data as $key => $value) {
		echo $value." "."<br>";
	}
	
	echo "<hr>";
}
fclose($file);
?>
