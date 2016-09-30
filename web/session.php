<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("127.0.0.1", "publishforce", "publishforce");
// Selecting Database
$db = mysql_select_db("publishforce", $connection);
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of ACTIVE User
$ses_sql=mysql_query("select a.user_name as user_name, a.firm_id as firm_id, a.user_id, a.sys_admin_flag as sys_admin from pf_user a, login b 
where a.user_name='$user_check' and a.user_name = b.username and a.active_flag=1 and b.is_temp_psswd = 0;", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['user_name'];
$session_user_id =$row['user_id'];
$session_user_firm_id =$row['firm_id'];
$session_sys_admin =$row['sys_admin'];

// MANAGE HOW LONG THE USER SESSION LASTS
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    header('Location: index.php?my_session=expired'); // Redirecting To Home Page
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

if(!isset($login_session)){
	mysql_close($connection); // Closing Connection
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
	header('Location: index.php?my_session=not-set'); // Redirecting To Home Page
	//echo "closing db conn";
}
else {
	mysql_close($connection); // Closing Connection just to be sure!
}
?>