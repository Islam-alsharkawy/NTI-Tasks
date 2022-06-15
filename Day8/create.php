<?php

require 'dbConnection.php';
$link = "https://wikimedia.org/api/rest_v1/metrics/pageviews/per-article/en.wikipedia/all-access/all-agents/Tiger_King/daily/20210901/20210930";
    $jsonOBJ = file_get_contents($link);
    $data = json_decode($jsonOBJ,true);
    //print_r($dat);

# Clean Function to sanitize the data
function Clean($input)
{
    return stripslashes(strip_tags(trim($input)));
}



# Server Side Code . . . 
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $project        = Clean($_POST['project']);
    $article        = Clean($_POST['article']);
    $granularity    = Clean($_POST['granularity']);
    $timestamp      = Clean($_POST['timestamp']);
    $access         = Clean($_POST['access']);
    $agent          = Clean($_POST['agent']);
    $views          = Clean($_POST['views']);
    $num            = Clean($_POST['num']);

    # Validate ...... 
    $errors = [];

    # validate project .... 
    if (empty($project)) {
        $errors['project'] = "Field Required";
    }

    //validate article
    if (empty($article)) {
        $errors['article'] = "Field Required";
    }

    //validate granularity
    if (empty($granularity)) {
        $errors['granularity'] = "Field Required";
    }

    //validate timestamp
    if (empty($timestamp)) {
        $errors['timestamp'] = "Field Required";
    }elseif(!is_numeric($timestamp)){
        $errors['timestamp'] = "should be a number";
    }

    //validate access
    if (empty($access)) {
        $errors['access'] = "Field Required";
    }

    //validate agent
    if (empty($agent)) {
        $errors['agent'] = "Field Required";
    }


    //validate views
    if (empty($views)) {
        $errors['views'] = "Field Required";
    }elseif(!is_numeric($views)){
        $errors['views'] = "should be a number";
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

    $password = md5($password);
            //   sha1()
            $sql = "insert into api (project,article,granularity,timestamp,access,agent,views) values
                                    ('$project','$article','$granularity','$timestamp','$access','$agent','$views')";
                                    
            $op =  mysqli_query($con, $sql);

            if ($op) {
                echo "Successful record adding";

            } else {
                echo "Failed , " . mysqli_error($con);
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

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >

            <div class="form-group">
                <label for="exampleInputNumber">obj number</label>
                <input type="number" class="form-control"  id="exampleInputNumber" aria-describedby="" name="num" min="0" max="30">
            </div>

            <div class="form-group">
                <label for="exampleInputName">Project</label>
                <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="project" placeholder="Project" value="<?php echo $data['items'][$num]['project']; ?>">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">Article</label>
                <input type="text" class="form-control"  id="exampleInputEmail1" aria-describedby="emailHelp" name="article" placeholder="Article" value="<?php echo $data['items'][$num]['article']; ?>">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Granularity</label>
                <input type="text" class="form-control"  id="exampleInputPassword1" name="granularity" placeholder="Granularity" value="<?php echo $data['items'][$num]['granularity']; ?>">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Timestamp</label>
                <input type="text" class="form-control"  id="exampleInputPassword1" name="timestamp" placeholder="Timestamp" value="<?php echo $data['items'][$num]['timestamp']; ?>">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Access</label>
                <input type="text" class="form-control"  id="exampleInputPassword1" name="access" placeholder="Access" value="<?php echo $data['items'][$num]['access']; ?>">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Agent</label>
                <input type="text" class="form-control"  id="exampleInputPassword1" name="agent" placeholder="Agent" value="<?php echo $data['items'][$num]['agent']; ?>">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Views</label>
                <input type="text" class="form-control"  id="exampleInputPassword1" name="views" placeholder="Views" value="<?php echo $data['items'][$num]['views']; ?>">
            </div>



            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


</body>

</html>
