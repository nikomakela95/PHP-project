<?php

require 'connect.php';

// Initialize the session
session_start();



// If session variable is not set it will redirect to login page
if(!isset($_SESSION['userName']) || empty($_SESSION['userName'])){
  header("location: login.php");
  exit;
}

// Get the username used for this session
$userName = $_SESSION['userName'];
$userId = $_SESSION['userId'];

$sql  = "SELECT * FROM userinformation WHERE userName = '" . $userName . "'";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_array($result)) {
$fullName = $row['fullName'];
$emailAddress = $row['emailAddress'];
$age = $row['age'];
$homeAddress = $row['homeAddress'];
  }
}

$_SESSION['fullName'] = $fullName;
$_SESSION['emailAddress'] = $emailAddress ;
$_SESSION['age'] = $age;
$_SESSION['homeAddress'] = $homeAddress;
var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="img/favicon.ico">

    <title>Betfree</title>



    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="firstpage.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">


  </head>

  <body id="page-top" class="bg-primary">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">BETFREE</a>
        <div id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="firstpage.php">Home</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="profile.php">My profile</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
      <div class="container">
        <p>Hi, <b><?php echo htmlspecialchars($_SESSION['userName']); ?></b>.</p>
        <img class="img-fluid mb-5 d-block mx-auto" src="img/logo.png" alt="logo" style="width:30%">
        <h1 class="text-uppercase mb-0">BETFREE</h1>
        <p>
        	That one free betting site.
        </p>
      </div>
    </header>

    <!-- Betting section -->
    <div class="container bg-primary text-center" id="betting">
      <h3>Select a winner</h3>
      <form action="">

        <input type="radio" name="gender" value="team1"> Vegas Golden Knights
      </br>
        <input type="radio" name="gender" value="team1"> Draw
      </br>
        <input type="radio" name="gender" value="team2"> Ottawa Senators
      </br>
      </form>

      <div class="form-group">
          <input type="placeBet" class="btn btn-alert" value="Place bet">
      </div>

    </div>

    <!-- About Section -->
    <section class="bg-secondary text-white mb-0" id="about">
      <div class="container">
        <h2 class="text-center text-uppercase text-white">About</h2>
        <div class="row">
          <div class="col-lg-4 ml-auto">
            <p class="lead">Here you will see the upcoming NHL games, as well as the most recent results for them.</p>
          </div>
          <div class="col-lg-4 mr-auto">
            <p class="lead">/////////////////////</p>
          </div>
        </div>
      </div>
    </section>
   

    <!-- Footer -->
    <footer class=" bg-primary footer text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h4 class="text-uppercase mb-4">Made for</h4>
            <p class="lead mb-0">R0315/CCA1721 PHP/SQL
              <br>Laurea Leppävaara</p>
          </div>

          <div class="col-md-2"></div>

          <div class="col-md-6">
            <h4 class="text-uppercase mb-4">About Betfree</h4>
            <p class="lead mb-0">Betfree is a betting site that is completely free for its users, offering prizes in the end of every month!
          </div>
        </div>
      </div>
    </footer>

    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; Erik Vänttinen, Niko Mäkelä 2018</small>
      </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>

  </body>

</html>
