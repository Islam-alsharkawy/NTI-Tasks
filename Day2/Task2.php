<?php
//1- function to print the next character of a specific character
function theNextLetterOf($letter){
	$newLetter = ++$letter;
		if (strlen($newLetter) > 1) {
 			$newLetter = $newLetter[0];
 			echo $newLetter;
		}else{
			echo $newLetter;
		}
}
theNextLetterOf("z");
echo "<hr>";

//2- function to get the characters after the last / in an url
function afterLastSlashe(){
	$url = 'http://www.facebook.com/456798345';
	$str = substr(strrchr($url, '/'), 1);
	echo $str;
}
afterLastSlashe();
echo "<hr>";

//function to take an HTML tag as string and returns it's id if existed, if not return false
function getElementId(){
	$element ="<div id='new id'></div>";
	$find = strpos($element, "id");
	if ($find > 0 ) {
		$id = explode("'",$element );
		echo $id[1];
	}else{
		echo "false";
	}
	
}
getElementId();
?>