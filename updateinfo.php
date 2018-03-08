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

$age_length = strlen((string)$_POST["age"]);

// Get the length of the age from the input field
$fullName_err = $emailAddress_err = $age_err = $homeAddress_err = $age_length_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate fullName, emailAddress
    if(empty(trim($_POST["fullName"]))){
        $fullName_err = "Please enter your full name.";
    } else{
        $fullName = trim($_POST["fullName"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$fullName)) {
        $fullName_err = "Only letters and white space allowed."; 
    }
}

        if(empty(trim($_POST["emailAddress"]))){
        $emailAddress_err = "Please enter your email address.";
    } else{
        $emailAddress = trim($_POST["emailAddress"]);
        // check if e-mail address is well-formed
        if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
        $emailAddress_err = "Invalid email format"; 
    }
}

    if(empty(trim($_POST["age"]))){
        $age_err = "Please enter your age (2 digits long).";
    }else if($age_length !== 2) {
        $age_length_err = "Age must be 2 digits long.";
    }
    else if($age_length == 2){
        $age = trim($_POST["age"]);
    }

        if(empty(trim($_POST["homeAddress"]))){
        $homeAddress_err = "Please enter your home address.";
    } else{
        $homeAddress = trim($_POST["homeAddress"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z0-9 ]*$/",$homeAddress)) {
        $homeAddress_err = "Invalid characters in your address."; 
    }
}


    // Validate credentials
    if(empty($fullName_err) && empty($emailAddress_err) && empty($age_err) && empty($homeAddress_err) && empty($age_length_err)){
        // attempt insert query execution
        $sql = "UPDATE userinformation SET fullName = '$fullName', emailAddress = '$emailAddress', age = '$age', homeAddress = '$homeAddress' WHERE userName = '$userName'";
    if(mysqli_query($conn, $sql)){
        $informationSuccess = "Your information has been updated!";
        session_start();
        $_SESSION['fullName'] = $fullName;
        $_SESSION['emailAddress'] = $emailAddress;
        $_SESSION['age'] = $age;
        $_SESSION['homeAddress'] = $homeAddress;
    } else{
        $informationSuccess = "Error while updating information." ;
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

    <title>Update information</title>

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
        <h3><img id="logo" src="img/logo2.png">Update your information</h3>
    </div>
</nav>


<div class="container" >
    <div class="wrapper" id="LogInInputs">
        <p>Please enter your information.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($fullName_err)) ? 'has-error' : ''; ?>">
                <label>Full name</label>
                <input type="text" name="fullName" id="fullName" class="form-control">
                <span class="help-block"><?php echo $fullName_err; ?></span>
            </div>    

            <div class="form-group <?php echo (!empty($emailAddress_err)) ? 'has-error' : ''; ?>">
                <label>Email address</label>
                <input type="text" name="emailAddress" id="emailAddress" class="form-control">
                <span class="help-block"><?php echo $emailAddress_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($age_err)) ? 'has-error' : ''; ?>">
                <label>Age</label>
                <input type="number" name="age" id="age" class="form-control">
                <span class="help-block"><?php echo $age_err; ?><?php echo $age_length_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($homeAddress_err)) ? 'has-error' : ''; ?>">
                <label>Home address</label>
                <input type="text" name="homeAddress" id="homeAddress" class="form-control">
                <span class="help-block"><?php echo $homeAddress_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <div class="form-group">
                <a href="profile.php" class="btn btn-danger" role="button">Back to profile</a>
            </div>

            <h4><?php echo $informationSuccess; ?></h4>
        </form>
    </div>    
</div>

</body>
</html>