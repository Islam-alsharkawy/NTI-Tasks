<?php

require 'dbConnection.php';


# Clean Function to sanitize the data
function Clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}



# Server Side Code . . . 
if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $num            = Clean($_POST['num']);

    # Validate ...... 
    $errors = [];

    # validate project .... 
    if (empty($num)) {
        $errors['num'] = "Field Required";
    }



    # Check ...... 
    if (count($errors) > 0) {
        // print errors .... 

        foreach ($errors as $key => $value) {
            # code...

            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>wiki</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>api data</h2>

        <form action="create2.php" method="post" >

            <div class="form-group">
                <label for="exampleInputNumber">obj number</label>
                <input type="number" class="form-control"  id="exampleInputNumber" aria-describedby="" name="num" min="0" max="30">
            </div>

        


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</body>

</html>