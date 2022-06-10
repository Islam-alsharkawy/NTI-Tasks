<!-- /* # TASK .
Build a Blog Module  with following data  
Title   =  [required , string]
Content =  [required,length >50 ch]
Image   =  [required, file]
Then Store data into text file , display blogs data ,  stored data can be deleted.
Deadline Saturday 3 pm . */ -->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Register</h2>

        <form  method="post"  action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

            <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control"   name="title"  id="exampleInputName" aria-describedby="" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Content</label>
                <input type="text" class="form-control" name="content"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>


           <div class="form-group">
                <label for="exampleInputEmail">img</label>
                <input type="file" class="form-control" name="image"  id="exampleInputfile" aria-describedby="fileHelp" placeholder="upload file">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<hr><hr>
</body>

</html>
<?php

function clean($input){
    $input = trim($input);
    $input = stripcslashes($input);
    $input = strip_tags($input);
    return $input;
    //return strip_tags(stripcslashes(trim($input)))
    
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$title      = clean($_POST['title']);
	$content     = clean($_POST['content']);
    

	// array to store errors
	$errors=[];

	//validate title
    if (empty($title)) {
        $errors['title']="this filed is required ";
    }

    //validate content
    if (empty($content)) {
        $errors['content']="this filed is required ";
    }elseif (strlen($content) < 50) {
        $errors['content']="content must be more than 50 char ";
    }

    //img
    if(!empty($_FILES["image"]["name"])){

    	$tempName = $_FILES["image"]["tmp_name"];
		$imageName = $_FILES["image"]["name"];
		$imageType = $_FILES["image"]["type"];
		$extentionArray = explode("/",$imageType);
		$extention = strtolower(end($extentionArray));
		$allowedExtentions = ["webp","png","jpeg","jpg"];


		if(in_array($extention, $allowedExtentions)){
			$fileMame = uniqid().time().".".$extention;

			$file2 = fopen("taskInfo.txt", "a") or die("Unable to open file"); 
			$text2 = "id:".time().rand()."||"."image:".$fileMame."||";
			fwrite($file2, $text2);
			fclose($file2);

			// $_SESSION['imagename'] =
			// [
			// 	'imagesrc'=>$fileMame
			// ];

			$disPath = "uploads/".$fileMame;
		if(move_uploaded_file($tempName,$disPath)){
			echo "successful upload";
		}else{
			$errors['image']="error uploading";
		}
	}
		else{
			$errors['image']="file type error";
		}
	}else{
		$errors['image']="please select image";
	}

    if(count($errors) > 0){
    	foreach ($errors as $key => $value) {
    		echo $key.": ".$value."<br>";
    	}
    }else{

    	$file = fopen("taskInfo.txt", "a") or die("Unable to open file"); 

		$text = "title:".$title."||"."content:".$content." \n";
		fwrite($file, $text);

		fclose($file);

    	// $_SESSION['blogData'] = [
    	// 	'title'=>$title,
    	// 	'content'=>$content
    	// ];
    }

}