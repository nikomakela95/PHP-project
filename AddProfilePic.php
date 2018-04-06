<?php
session_start();
// Include config file
require_once 'connect.php';

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['userName']) || empty($_SESSION['userName'])){
  header("location: login.php");
  exit;
}

// Get the username used for this session
$userName = $_SESSION['userName'];


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 



    // Validate credentials
    if(!empty($userName)){
        // attempt insert query execution
        $sql = "INSERT INTO profilepicture (userpic, userName) VALUES ('$userpic', '$userName')";
    if(mysqli_query($conn, $sql)){
        session_start();
        header("location: profile.php");
    } else{
        echo "Error" ;
    }
}
// Close connection
mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="img/favicon.ico">

    <title>Insert information</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="insertInformation.css" rel="stylesheet">
</head>
<body>

<nav class="navbar bg-secondary text-uppercase" id="mainNav">
    <div class="container">
        <h3><img id="logo" src="img/logo2.png">Register your information</h3>
    </div>
</nav>


<div class="container" >
    <div class="wrapper" id="LogInInputs">
        <p>Please enter your information.</p>

<div id="content">
  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="size" value="1000000">
    <div>
      <input type="file" name="userpic">
    </div>
</div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p>You will be redirected to the Login page.</p>
        </form>
    </div>    
</div>

</body>
</html>