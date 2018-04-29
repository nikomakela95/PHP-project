<?php

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['userName']) || empty($_SESSION['userName'])){
  header("location: login.php");
  exit;
}

// Include config file
require_once 'connect.php';

// Include sessiondata file
include 'sessiondata.php';


?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="img/favicon.ico">

    <title>My profile</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this page -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this page -->
    <link href="profilecss.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">BETFREE</a>
        <div id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php">Home</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="profile.php">My profile</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="logout.php">Logout</a>
            </li>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    
<div class="container" id="userinfo">
  <div class="row">
    <div class="col-md-3  toppad col-md-offset-3 ">
    </div>
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">
              <u><b>Name</b></u>: <?php echo $fullName; ?>
            </h3>
          </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="img/logo2.png" style="width:80px;height:80px; border-radius: 50%;" class="img-circle img-responsive"> </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Age</td>
                        <td><?php echo $age;?></td>
                      </tr>
                        <tr>
                        <td>Home Address</td>
                        <td><?php echo $homeAddress; ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><a href="#"><?php echo $emailAddress; ?></a></td>  
                      </tr>
                    </tbody>
                  </table>
                  
                  <a href="updateinfo.php" class=" btn btn-primary">Edit information</a>
                
                  <a href="delete.php" class=" btn btn-danger">Delete account</a>
                </div>
              </div>
            </div>            
          </div>
        </div>
      </div>
    </div>
   

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
            <h4 class="text-uppercase mb-4">What is Betfree?</h4>
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

    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>

  </body>

</html>
