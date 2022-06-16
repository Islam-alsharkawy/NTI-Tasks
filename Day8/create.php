<?php

require 'dbConnection.php';



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
        <h2>API data</h2>

        <form action="create2.php" method="post" >

            <div class="form-group">
                <label for="exampleInputNumber">Select hte number of the object number</label>
                <input type="number" class="form-control"  id="exampleInputNumber" aria-describedby="" name="num" min="0" max="29" required>
            </div>

        


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</body>

</html>