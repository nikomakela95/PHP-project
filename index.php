<?php

// Include config file
require 'connect.php';

// Initialize the session
session_start();



// If session variable is not set it will redirect to login page
if(!isset($_SESSION['userName']) || empty($_SESSION['userName'])){
  header("location: login.php");
  exit;
}

// Get the username and userid used for this session
$userName = $_SESSION['userName'];
$userId = $_SESSION['userId'];

// Get information from the userinformation table where userName is the same as in the session
$sql  = "SELECT * FROM userinformation WHERE userName = '" . $userName . "'";

// Get the result and parse the information
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

// Declare the session data
$_SESSION['fullName'] = $fullName;
$_SESSION['emailAddress'] = $emailAddress ;
$_SESSION['age'] = $age;
$_SESSION['homeAddress'] = $homeAddress;


?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="icon" href="img/favicon.ico">

    <title>Betfree</title>



    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom style for this page -->
    <link href="index.css" rel="stylesheet">

    <!-- Custom fonts for this page -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

<style>
select {
  margin: 50px;
  border: 1px solid #111;
  background: transparent;
  width: 150px;
  padding: 5px 35px 5px 5px;
  font-size: 16px;
  border: 1px solid #ccc;
  height: 34px;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background: #eee;
}

select::-ms-expand { 
    display: none; /* remove default arrow on ie10 and ie11 */
}

/* target Internet Explorer 9 to undo the custom arrow */
@media screen and (min-width:0\0) {
    select {
        background:none\9;
        padding: 5px\9;
    } 
}
</style>

  </head>

  <body id="page-top" class="bg-primary">

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
  <h1>Matches</h1>      

<div class="row">
  <div id="weatherdata">

  </div>
</div>
<div class="form-group" id="placebet">
  <button class="btn btn-secondary">Place bet</button>
</div>


</div>

    <!-- About Section -->
    <section class="bg-secondary text-white mb-0" id="about">
      <div class="container">
        <h2 class="text-center text-uppercase text-white">Results</h2>
        <div class="row">
          <div class="col-lg-2 mr-auto">
          </div>
          <div class="col-lg-4 ml-auto">
            <div id="table2">
            </div>
          </div>
          <div class="col-lg-2 mr-auto">
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

    <script>

      
      var username = "maxi95";
      var password = "php123";
 var query = $('#query').valueOf();
      $.ajax({
  type: "GET",
  url: 'https://api.mysportsfeeds.com/v1.2/pull/nhl/2018-playoff/full_game_schedule.json?date=since-today',
  dataType: 'json',
  async: false,
  headers: { "Authorization": "Basic " + btoa("maxi95" + ":" + "php123")},
  data: 'query',
  success: function (data){
    renderHTML(data);

  }
});
      //for(var i = 0; i < 3; i++){


      var urlPart1 = "https://api.mysportsfeeds.com/v1.2/pull/nhl/2018-playoff/scoreboard.json?fordate=";
      var d = new Date();
      var datestring = d.getFullYear() + "" + "0" +(d.getMonth()+1)  + "" + (d.getDate() -3);
        


      var query = $('#query').valueOf();
      $.ajax({
  type: "GET",
  url: urlPart1 + datestring,
  dataType: 'json',
  async: false,
  headers: { "Authorization": "Basic " + btoa("maxi95" + ":" + "php123")},
  data: 'query',
  success: function (data){
    console.log(urlPart1 + datestring);
    renderHTML2(data);

   // urlDate++
    
  }
});
    //}
     

      function renderHTML(data) {

         for(var x = 0; x <3; x++){

          var homeTeam = data.fullgameschedule.gameentry[x].homeTeam.Name;
          var awayTeam = data.fullgameschedule.gameentry[x].awayTeam.Name;

          var list = "<dl>";
          list += '<dt>' + homeTeam + " - " + awayTeam + '</dt>';
          list += '<dd>' + homeTeam + '<dd>';
          list += '<dd>' + " Draw " + '<dd>';
          list += '<dd>' + awayTeam + '<dd>';
          // list += '<dl>'
          var random = document.getElementById("weatherdata")
          random.innerHTML += list;
        }

      }



       document.getElementById("weatherdata").addEventListener("click",function(e) {
        // e.target is our targetted element.
                    // try doing console.log(e.target.nodeName), it will result LI
        if(e.target && e.target.nodeName == "DD") {
            console.log(e.target.id + " was clicked");
            e.target.className = 'select';
        }
    });

        /*
         for(var x = 0; x <3; x++){

          
          
          var homeTeam = data.fullgameschedule.gameentry[x].homeTeam.Name;
          var awayTeam = data.fullgameschedule.gameentry[x].awayTeam.Name;

        var div = document.createElement('div');
        div.className = 'col-sm-4';  
        document.getElementsByClassName('row3')[0].appendChild(div);
        var element = document.createElement('dl');
        var element2 = document.createElement('dt');
        element.innerHTML = homeTeam + " - " + awayTeam;
        element2.innerHTML = homeTeam + " Draw " + awayTeam;
          
          document.getElementById("list").appendChild(element);
          document.getElementById("list").appendChild(element2);
        
      }
    }
    */
/*

         var teamOne = "";
         var teamTwo = "";
         var teamThree = "";
         var teamFour = "";
         var teamFive = "";
         var teamSix = "";

        for(var x = 0; x <1; x++){

        //var homeTeam = data.fullgameschedule.gameentry[x].homeTeam.Name;
        //  var awayTeam = data.fullgameschedule.gameentry[x].awayTeam.Name;

        teamOne += data.fullgameschedule.gameentry[0].homeTeam.Name ;
        teamTwo += data.fullgameschedule.gameentry[0].awayTeam.Name ;
        teamThree += data.fullgameschedule.gameentry[1].homeTeam.Name ;
        teamFour += data.fullgameschedule.gameentry[1].awayTeam.Name ;
        teamFive += data.fullgameschedule.gameentry[2].homeTeam.Name ;
        teamSix += data.fullgameschedule.gameentry[2].awayTeam.Name ;
        


        }
        
        document.getElementsByClassName("team1")[0].innerHTML = teamOne;
        document.getElementsByClassName("team2").innerHTML = teamTwo;
        document.getElementsByClassName("team3").innerHTML = teamThree;
        document.getElementsByClassName("team4").innerHTML = teamFour;
        document.getElementsByClassName("team5").innerHTML = teamFive;
        document.getElementsByClassName("team6").innerHTML = teamSix;
*/
      /*
      var table = "<table>";
      

        for(var x = 0; x <3; x++){
          table += '<div class="col-sm-4">';
          var homeTeam = data.fullgameschedule.gameentry[x].homeTeam.Name;
          var awayTeam = data.fullgameschedule.gameentry[x].awayTeam.Name;
          //table += '<tr class="koko">';
          table += '<tr class="float1">';
          table += '<th>' + homeTeam + " - " + awayTeam + '</th>';
            table += '</tr>';

        
        table += '<td>' + homeTeam + '</td>';
        table += '<td>' + "Draw" + '</td>';
        table += '<td>' + awayTeam + '</td>';
        table += '</tr>';


       // table += '</tr>';

        }
        
        document.getElementById("table").innerHTML = table;
      }
*/

      function renderHTML2(data) {

      
      var table = "<table>";
      var games = data.scoreboard.gameScore.length;

        for(var x = 0; x <games; x++){

          var homeTeam = '<b>' + data.scoreboard.gameScore[x].homeScore + '</b>' + " " + data.scoreboard.gameScore[x].game.homeTeam.Name + " <b>VS</b> ";
          var awayTeam = data.scoreboard.gameScore[x].game.awayTeam.Name + " " + '<b>' + data.scoreboard.gameScore[x].awayScore + '</b>' + " ";
          
        table += '<td>' + homeTeam  + '</td>';
        table += '<td>' + awayTeam + '</td>';
        
        table += '</tr>';
        table += "</table>";
       }
        
        document.getElementById("table2").innerHTML = table;
      }
      
      $(document).ready(function(){
    $("button").click(function(){
        alert("Your bet has been placed!");
    });
    });

    </script>

  </body>

</html>
