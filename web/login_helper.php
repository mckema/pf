<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['user_id']) || empty($_POST['user_password'])) {
$error = "invalid_credentials";
//print "ERROR: $error";
header("Location: login.php?error_msg=$error"); // Redirecting To Home Page
}
else
{
// Define $username and $password
$username=$_POST['user_id'];
$password=$_POST['user_password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("127.0.0.1", "publishforce", "publishforce");
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
// Selecting Database
$db = mysql_select_db("publishforce", $connection);
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from login where password='$password' AND username='$username'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
//print "ok you are: $username";
header("location: my_account.php"); // Redirecting To Other Page
} else {
$error = "invalid_credentials";
header("Location: login.php?error_msg=$error"); // Redirecting To Home Page
//print "Problem: $error";
}
mysql_close($connection); // Closing Connection
}
}
?>