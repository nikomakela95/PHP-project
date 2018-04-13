<?php
session_start();

$servername = "127.0.0.1:49657";
$dbName = "azure";
$dbPass = "6#vWHD_$";
$dbname = "localdb";


// Create connection
$conn = mysqli_connect($servername, $dbName, $dbPass, $dbname);
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
} 
?>