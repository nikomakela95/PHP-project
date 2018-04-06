<?php
// Include config file
require_once 'connect.php';
 
// Get the username used for this session
$userName = $_SESSION['userName'];
$userId = $_SESSION['userId'];

$sql = "DELETE FROM users WHERE userName = '" . $userName . "'";

if (!mysqli_query($conn,$sql))
{
die('Error: ' . mysqli_error($conn));
}
echo "Account succesfully deleted.";
header("Refresh:3; url=login.php");

mysqli_close($conn)


?>
 