<?php
require_once("DBConn.php");
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
$username=$_POST['user_id'];
//echo "username: $username";
if (isset($_POST['submit_new_password'])) {
	//compare the two password fields to make sure they match
	//echo "password reset?";
	$userPassword1 = $_POST['user_password'];
	$userPassword2 = $_POST['user_password_2'];
	if ( $userPassword1 != $userPassword2 ) {
		header("Location: reset_my_password.php?error_msg=mismatching_passwords"); // Redirecting back to reset password
	}
	else {
		//header("Location: reset_my_password.php?error_msg=ok"); // Redirecting back to reset password
		//persist the new password to the DB
		$dbConn = new DBConn();
		// Create connection
		$connection = new mysqli($dbConn->dbservername, $dbConn->dbusername, $dbConn->dbpassword, $dbConn->dbname);
		// SQL query to fetch information of registerd users and finds user match.
		$sql = "update login set password = '$userPassword1', is_temp_psswd = 0 where username='$username'";
		//echo $sql;
		if ($connection->connect_error) {
    		die("Connection failed: " . $connection->connect_error);
    		echo "FAILED TO CONNECT";
		} 
		else {
    		//echo "CONNECT OK";
    		$result = $connection->query($sql);
			if ($result->num_rows == 0) {
				header("location: my_account.php"); // Redirecting to reset page
			}
			else {
				//echo "problem with user $username password change $userPassword1";
				header("Location: reset_my_password.php?error_msg=seek_help"); // Redirecting back to reset password
			}
			$connection->close(); // Closing Connection
		}
	}
}
if (isset($_POST['submit'])) {
	if (empty($_POST['user_id']) || empty($_POST['user_password'])) {
		$error = "invalid_credentials";
		//print "ERROR: $error";
		header("Location: login.php?error_msg=$error"); // Redirecting To Home Page
	}
	else
	{
		// Define $username and $password
		//$username=$_POST['user_id'];
		$password=$_POST['user_password'];
		$dbConn = new DBConn();
		// Create connection
		$connection = new mysqli($dbConn->dbservername, $dbConn->dbusername, $dbConn->dbpassword, $dbConn->dbname);
		$sql = "select * from login where password='$password' AND username='$username'";
		$result = $connection->query($sql);
		
		if ($result->num_rows ==1) {
			while($row = $result->fetch_assoc()) {
			$myval = $row["is_temp_psswd"];
			//echo "myval before any branching: $myval";
			//if ($rows == 1) {
				$_SESSION['login_user']=$username; // Initializing Session
				if ( $row["is_temp_psswd"] == 0 ) {
					
					//echo "myval: $myval";
					header("location: my_account.php"); // Redirecting to user account page
				}
				else {
					//echo "positive myval?: $myval";
					header("location: reset_my_password.php"); // Redirecting to reset page
				}
			}
			mysql_close($connection); // Closing Connection
		} 
		else {
			$error = "invalid_credentials";
			header("Location: login.php?error_msg=$error"); // Redirecting To Home Page
			//print "Problem: $error";
			mysql_close($connection); // Closing Connection
		}
		//mysql_close($connection); // Closing Connection
	}
}
?>