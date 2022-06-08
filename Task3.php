<?php
/* task 1
	Write a function that takes a two-dimensional array and returns a one-dimensional array containing the unique values of each array (Without using the array_merge  function on PHP). 

 	I.e. input will be:
 	[  
 		0 => [0=>’a’ , 1=>’b’ ,  2=>’c’ ] ,
    	1 => [0=>’x’ , 1=>’b’ , 2=>’a’],
    	2 => [0=>’z’ , 1=>’z’ , 2=>’v’]
  	]

 Output should be:
 [a,b,c,x,z,v]
*/

	$array = 
	[
	  	0 => [0=>"a" , 1=>"b" , 2=>"c"],
   		1 => [0=>"x" , 1=>"b" , 2=>"a"],
   		2 => [0=>"z" , 1=>"z" , 2=>"v"]
 	];
 	
 	for ($i=0; $i < 3; $i++) { 
 		$newArr = array_column($array, $i);
 		// array_unique($newArr);
 		 print_r($newArr);
 	}
 	
 	//var_dump($newArr);
 	echo "<hr>";

/* task 2
	Create a form with the following inputs (name, email, linkedin url) Validate inputs then return message to user . 
  	validation rules ... 
 	name  = [required , string (Accept only letters) , min length 3 , max length 20]
 	email = [required]
 	linkedin url = [required | linked Url]
 	Notes … 
 	Don’t use html || js || php filters || regx  To validate inputs. 
*/
?>
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

        <form  method="get"  action="task3-2.php">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control"   name="name"  id="exampleInputName" aria-describedby="" placeholder="Enter Name">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <input type="email" class="form-control" name="email"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>

           <div class="form-group">
                <label for="exampleInputEmail">linked in url</label>
                <input type="text" class="form-control" name="linkedin"  id="exampleInputLinkedin" aria-describedby="linkedinHelp" placeholder="Linkedin account url">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>
