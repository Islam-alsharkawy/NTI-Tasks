<?php 
require 'dbConnection.php';

 $id = $_GET['id'];
$sql = "select image from articles where id = ".$id;
$resultobj = mysqli_query($con,$sql);
$userimage = mysqli_fetch_assoc($resultobj);

 $sql = "delete from articles where id = ".$id; 
 $op = mysqli_query($con, $sql);

 if($op){

   unlink("uploads/".$userimage["image"]);
    $message =  "Record Deleted";
 }else{
    $message =  'Error Try Again' . mysqli_error($con);
 }


   # Set Message Session 
    $_SESSION['message'] = $message;

    header("Location: index.php");


    
?>