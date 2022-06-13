<?php

$file = fopen("taskInfo.txt", 'r') or die("unable to open");
echo "<table class='table'> 
<tr>
<td>id</td>
<td>title</td>
<td>content</td>
<td>image</td>
</tr>
";
while (!feof($file)) {
	$data = explode("||", fgets($file));
	if (count($data) > 0 && !empty($data[0])) {
		
	
		foreach ($data as $key => $value) {
			if ($key == 4) {
				echo "<td><img src='./uploads/'".$value."' height='60px' width='60px' ></td>";
			}else{
				echo "<td>".$value."</td>";
			}
		}
		echo "<td><a href='remove.php?id='".$data[0].">remove</a></td>";
	}
	
}
fclose($file);
?>
