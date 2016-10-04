<?php
include('session.php');
require_once("DBConn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
<link href="css/owl.carousel.css" type="text/css" rel="stylesheet" />

<title>PublishForce | Making research transparent</title>

<meta name="keywords" content="PublishForce, PublishForce Limited, research everywhere" />
<meta name="description" content="PublishForce is coming soon." />
<meta name="robots" content="index, follow" />
<meta name="author" content="PublishForce Limited" />
<meta name="revisit-after" content="7 days" />
<meta name="copyright" content="PublishForce Limited" />

<script type="text/javascript" src="js/mobile-nav.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>

<div id="header-section">
	<div id="header-bar">
		<!-- menu nav -->
		<?php require("menu_logged-in.php"); ?>
        <!-- END menu nav -->
        <!--<div class="clr"></div>-->
    </div>
</div>
<!-- CLOSE HEADING DIVS -->
	<div style="text-align:center;">

		<!-- menu for my account -->
		<?php require("menu_admin.php"); ?>
        <!-- END menu for my account -->
    </div>

    <div class="white-section">
        <div class="container">
        <h3>Edit user</h3>
        <p>
        << <a href="admin_user_list.php">Back</a> to list of users<br/>
<?php
		$userId = $_REQUEST["user_id"];
		$dbConn = new DBConn();
		// Create connection
		$connection = new mysqli($dbConn->dbservername, $dbConn->dbusername, $dbConn->dbpassword, $dbConn->dbname);
		// Check connection
		if ($connection->connect_error) {
    		die("Connection failed: " . $connection->connect_error);
    		echo "FAILED TO CONNECT";
		} else {
    		//echo "CONNECT OK";
		}
		$sql = "select * from pf_user where user_id = $userId";
		//$sql = "select * from pf_user";
		$result = $connection->query($sql);
?>
	
	
        <form id="updateUser" action="admin_update_user.php" method="post" enctype="multipart/form-data">

	<p>
		<table class="search-table">
			<tr>
				<th>User ID</th>
				<th>Name</th>
				<th>Company</th>
				<th>Active?</th>
				<th>Action</th>
			</tr>
			
<?php


		if ($result->num_rows > 0) {  // && $searchTag!="") {
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
        		
        		//TO DO publisher / consumer info here...
        		echo "<tr><td><input type='text' class='search-text' name='user_email' id='user_email' value='" . $row["user_email"]. "'/></td>
        		<td><input type='text' class='user-text' name='fname' id='fname' value='". $row["fname"] . "'/> 
        		<input type='text' class='user-text' name='lname' id='lname' value='". $row["lname"] . "'/></td>
        		<td><input type='text' class='search-text' name='user_company' id='user_company' value='" . $row["user_company"]. "' /></td>
        		<td><input type='text' class='dbbit-text' name='active_flag' id='active_flag' value='" . $row["active_flag"]. "' />
        		<input type='hidden' name='user_id' id='user_id' value='" . $row["user_id"]. "' /></td>
        		
        		
        		<td>[ <a href='javascript:submitform();'>update</a> ] <br/>
        		
        		[ <a href='admin_delete_user.php?user_id=" . $row["user_id"]. "'>delete</a> ]
        		</td></tr>";
    		}
		} else {
    		echo "Try refining your search";
		}
		$connection->close();
?>
			
		</table>
		
</p>
		</form>
		
<!-- The function that submits the form-->
<script type="text/javascript">
function submitform()
{
 	var user_form = document.getElementById("updateUser");
 	user_form.submit();
}
</script>
<p>		
		<!--If these results were not what you are looking for, please try the following options:
	
<ul>
	
	<li>Contact us for help</li>
	<li>Put a request to publishers for the material you are looking for</li>
</ul>-->
	</p>
            
        </div>
    </div>

    </div>
    <div class="white-section">
	
    <div class="container" style="text-align:center;">
    	<div style="padding:0 150px;">
            <h4 class="large-header">Contact Us</h4>
            <p class="mbottom10">If you have any questions about our research platform, or if you have an enquiry, please contact us using the details below, or by filling out the form on our contact page.</p>
            <a href="contact.php"><span class="button3">Get in touch</span></a>
        </div>
    </div>
   
</div>

<!-- footer section -->
<?php require("footer_empty.php"); ?>
<!-- END footer section -->

</body>
</html>