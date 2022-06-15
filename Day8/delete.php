<?php 
require 'dbConnection.php';
require 'checkLogin.php';

 $id = $_GET['id'];

 # Fetch User Data . . . 
 

# Remove User . . . 
 $sql = "delete from api where id = $id"; 
 $op = mysqli_query($con, $sql);


 if($op){
    
    $message =  "Record Deleted";
 }else{
    $message =  'Error Try Again' . mysqli_error($con);
 }


 require 'closeConnection.php';
   # Set Message Session 
    $_SESSION['message'] = $message;

    header("Location: index.php");