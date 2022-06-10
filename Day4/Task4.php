<!-- Create a form with the following inputs 
	(name, email, password, address, gender, linkedin url,CV) 

Validate inputs then return message to user . 
 validation rules ... 
name  = [required , string]
email = [required,email]
password = [required,min = 6]
address = [required,length = 10 chars]
gender = [required]  {male||female}
linkedin url = [reuired | url]
CV    = [required| PDF] -->
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
        	<!-- htmlspecialchar to avoid html tags injection in url-->
            
            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control"   name="name"  id="exampleInputName" aria-describedby="" placeholder="Enter Name">
            </div>

            <div class="form-group">
                <label for="exampleInputName">email</label>
                <input type="text" class="form-control"   name="email"  id="exampleInputName" aria-describedby="" placeholder="E-mail">
            </div>

            <div class="form-group">
                <label for="exampleInputName">password</label>
                <input type="password" class="form-control"   name="password"  id="exampleInputName" aria-describedby="" placeholder="Select password">
            </div>

            <div class="form-group">
                <label for="exampleInputName">address</label>
                <input type="text" class="form-control"   name="address"  id="exampleInputName" aria-describedby="" placeholder="Address">
            </div>

            <div class="form-group">
                <input type="radio" id="male" name="gender" value="Male">
                <label for="male">Male</label><br>
                <input type="radio" id="female" name="gender" value="Female">
                <label for="female">Male</label><br>
            </div>

            <div class="form-group">
                <label for="exampleInputName">linkedin</label>
                <input type="text" class="form-control"   name="linkedin"  id="exampleInputName" aria-describedby="" placeholder="linkedin url">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail">pdf</label>
                <input type="file" class="form-control" name="pdf"  id="exampleInputfile" aria-describedby="fileHelp" placeholder="upload file">
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

	$name      = clean($_POST['name']);
	$email     = clean($_POST['email']);
    $password  = clean($_POST['password']);
    $address  = clean($_POST['address']);
    $gender  = clean($_POST['gender']);
    $linkedin  = clean($_POST['linkedin']);

	//print_r($_FILES);
	//Array ( [pdf] => Array ( [name] => [type] => [tmp_name] => [error] => 4 [size] => 0 ) ) error upload

	//validate name
    if (empty($name)) {
        $errors['name']="this filed is required ";
    }elseif(!ctype_alpha(str_replace("","" ,$name))){
        $errors['name']="Must be only letters";

    }
     

    //validate email
    if (empty($email)) {

        $errors['email']="email is required ";

    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){

            $errors['email']="The entered email is wrong ";
        }
    

    //validate password
    if (empty($password)) {
        $errors['password']="this filed is required ";
    }elseif (strlen($password) < 6) {
        $errors['password']="Password must be more than 6 char ";
    }

    //validate address
    if (empty($address)) {
        $errors['address']="this filed is required ";
    }elseif (strlen($address) != 10) {
        $errors['address']="address must be  10 char ";
    }

    //gender validation
    if(empty($gender)){
    	$errors['gender']="You must select gender";
    }

    //url validaation
    if (empty($linkedin)) {
    	$errors['link'] = "this field is required";
    }elseif(substr_compare($linkedin,'https://www.linkedin.com/',0,25) != false){
    	$errors['link'] = "Not linkedin url";
    }

    // validate file
	if(!empty($_FILES["pdf"]["name"])){
		$tempName = $_FILES["pdf"]["tmp_name"];
		$pdfName = $_FILES["pdf"]["name"];
		$pdfType = $_FILES["pdf"]["type"];
		$extentionArray = explode("/",$pdfType);
		$extention = strtolower(end($extentionArray));
		$allowedExtentions = ["pdf"];


		if(in_array($extention, $allowedExtentions)){
			$fileMame = uniqid().time().".".$extention;

			$disPath = "uploads/".$fileMame;
			if(move_uploaded_file($tempName,$disPath)){
				echo "successful file upload";
			}else{
				$errors['file']="Error uploading file";
			}
		}else{
			$errors['file']="File type error";
		}
		}else{
			$errors['file']="Please select file";
		}

    //check errors
    if(count($errors)>0){
    	foreach ($errors as $key => $value) {
    		echo $key.": ".$value."<br>";
    	}
    }else{
    	echo "succeded";
    }

    
}
