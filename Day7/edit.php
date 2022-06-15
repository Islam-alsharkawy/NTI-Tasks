<?php

require 'dbConnection.php';


##################################################################################################################
 
$id = $_GET['id'];
$sql = "select id,title,content,image from articles where id =".$id;
$resultObj = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($resultObj);

##################################################################################################################







# Clean Function to sanitize the data
function Clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}



# Server Side Code . . . 
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title     = Clean($_POST['title']);
    $content    = Clean($_POST['content']);


    # Validate ...... 
    $errors = [];

    # validate title .... 
    if (empty($title)) {
        $errors['title'] = "Field Required";
    }


    # validate content 
    if (empty($content)) {
        $errors['content'] = "Field Required";
    } elseif (strlen($content) < 30) {
        $errors['content'] = "Length Must be >= 30 chars";
    }

    // image
    if (!empty($_FILES['image']['name'])) {
       

        # Validate Extension . . . 
        $imageType = $_FILES['image']['type'];
        $extensionArray = explode('/', $imageType);
        $extension =  strtolower(end($extensionArray));

        $allowedExtensions = ['png', 'jpg', 'jpeg', 'webp'];    // PNG 

        if (!in_array($extension, $allowedExtensions)) {

            $errors['image'] = "File Type Not Allowed";
        }
    }

    # Check ...... 
    if (count($errors) > 0) {
        // print errors .... 

        foreach ($errors as $key => $value) {
            # code...

            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {


        // DB cODE . . . 
        if (!empty($_FILES['image']['name'])){

        $filename = uniqid().time().".".$extension;
        $dispath = "uploads/".$filename;
        $tempname = $_FILES['image']['tmp_name'];
        if (move_uploaded_file($tempname,$dispath)) {
                unlink('uploads/',$data['image']);
        }
    }else{
        $filename = $data['image'];
    }

        $sql = "UPDATE `articles` SET `title` = '$title', `content` = '$content' , `image` = '$filename' WHERE `articles`.`id` = $id";

        $op =  mysqli_query($con, $sql);

        if ($op) {
            $message =  "Success , Your articles Updated";

            $_SESSION['message'] = $message;
            
            header('Location: index.php');
            exit(); 

        } else {
            echo "Failed , " . mysqli_error($con);
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Update Info : </h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$data['id']; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Current title</label>
                <input type="text" class="form-control" required id="exampleInputName" aria-describedby="" name="title" placeholder="Enter title"  value = "<?php echo $data['title'];?>">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Current Content</label>
                <input type="text" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" name="content" placeholder="Enter content" value = "<?php echo $data['content'];?>">
            </div>


            <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">
            </div>

            <p>
                <img src="./uploads/<?php echo $data['image'];?>" width="50px" height="50px">
            </p>


            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


</body>

</html>