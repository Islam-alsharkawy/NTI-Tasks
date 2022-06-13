<?php

$id = $_GET['id'];
$file = fopen("taskinfo.txt","r") or die('unable to open');

$finalText = '';
while (!feof($file)) {
	$line = fgets($file);
	$data = explode("||", $line);

	if ($data[0] !== $id) {
		$finalText .= $line;
	}else{
		unlink("uploads/".trim($data[5]));
	}
	
}
fclose($file);

$file = fopen("taskinfo.txt", "w") or die("unable");
fwrite($file, $finalText);
fclose($file);
header("location: task5-2.php");
?>