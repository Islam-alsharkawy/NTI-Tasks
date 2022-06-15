<?php

require 'dbConnection.php';

# Clean Function to sanitize the data
function Clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}



# Server Side Code . . . 
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email     = Clean($_POST['email']);
    $password    = Clean($_POST['password']);


    # Validate ...... 
    $errors = [];

    # validate title .... 
    if (empty($password)) {
        $errors['password'] = "Field Required";
    }elseif(strlen($password) < 6){
        $errors['password'] = "must be more than 6";
    }



    # validate content 
    if (empty($email)) {
        $errors['email'] = "Field Required";
    } elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "not valid mail";
    }


    
    # Check ...... 
    if (count($errors) > 0) {
        // print errors .... 

        foreach ($errors as $key => $value) {
            # code...

            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    }else{

        $password = md5($password);
        $sql = "select * from users where email = '$email' and password = '$password'";

        $op = mysqli_query($con,$sql);

        if (mysqli_num_rows($op) == 1) {
            
            $row = mysqli_fetch_assoc($op);

            $_SESSION['userdata'] = $row;
            header("location: index.php");
        }else{
            echo "this email or password is not existed";
        }

    } 
        
    
}
require("closeconnection.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>signIn</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>login</h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">email</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="email" placeholder="type a title">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">password</label>
                <input type="password" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" name="password" placeholder="set content">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</body>

</html>