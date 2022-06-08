
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {

	$name =$_GET['name'];

	$email =$_GET['email'];

	$linkedin =$_GET['linkedin'];
    $url = stripos($linkedin, "linkedin");
    //$url2 = stripos($linkedin, "https://www");
    $url3 = stripos($linkedin, ".com");


	// array to store errors
	$errors=[];

	//validate name
    if (empty($name)) {
        $errors['name']="this filed is required ";
    } elseif (strlen($name) < 3 || strlen($name) > 20) {
    	$errors['name']="must be more than 3 characters and less than 20";
    } elseif (preg_match('~[0-9]+~', $name)) {
        $errors['name']="name should has no numbers";
    }
                                                                    //if (preg_match('~[0-9]+~', $string)) {
                                                                    //echo 'string with numbers';
                                                                    //}

    //validate email
    if (empty($email)) {
        $errors['email']="this filed is required ";
    }

    //validate linkedin
    if (empty($linkedin)) {
        $errors['linkedin']="this filed is required ";
    }elseif($url == 0 ||  $url3 == 0 ){
        $errors['linkedin']="wrong link ";
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
?>