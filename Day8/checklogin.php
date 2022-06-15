<?php
if(!isset($_SESSION['userdata'])){
	header("location: login.php");
	exit();
}
?>