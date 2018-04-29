<?php
// Include config file
require_once 'connect.php';
 

// Define variables and initialize with empty values
$userName = $userPass = "";
$userName_err = $userPass_err = ""; 

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if userName is empty
    if(empty(trim($_POST["userName"]))){
        $userName_err = 'Please enter username.';
    } else{
        $userName = trim($_POST["userName"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['userPass']))){
        $userPass_err = 'Please enter your password.';
    } else{
        $userPass = trim($_POST['userPass']);
    }
    
    // Validate credentials
    if(empty($userName_err) && empty($userPass_err)){
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE userName = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){

            // Set parameters
            $param_userName = $userName;
            $param_userId = $userId;

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_userName);
            

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if userName exists, if yes then verify userPass
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $userId, $userName, $hashed_userPass);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($userPass, $hashed_userPass)){
                            /* Password is correct, so start a new session and
                            save the userName to the session */
                            session_start();
                            $_SESSION['userName'] = $userName;
                            $_SESSION['userId'] = $userId;

                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $userPass_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $userName_err = 'No account found with that username.';
                }
            } else{
                // Display an error message if there is a server error
                echo '<script language="javascript">';
                echo 'alert("Something went wrong. Please try again later.")';
                echo '</script>';
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
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

    <title>Log in</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this page -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this page -->
    <link href="login.css" rel="stylesheet">
</head>

<body>


<nav class="navbar bg-secondary text-uppercase" id="mainNav">
    <div class="container">
        <h1><img id="logo" src="img/logo2.png">Log in</h1>
    </div>
</nav>


<div class="container" >
    <div class="wrapper" id="LogInInputs">
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($userName_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="userName" class="form-control" value="<?php echo $userName; ?>">
                <span class="help-block" id="help-block"><?php echo $userName_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($userPass_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="userPass" class="form-control">
                <span class="help-block" id="help-block"><?php echo $userPass_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register_uusi.php">Sign up now</a>.</p>
        </form>
    </div>    
</div>
</body>
</html>