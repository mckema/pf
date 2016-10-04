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
		<?php require("menu_my_account.php"); ?>
        <!-- END menu for my account -->
    </div>

    <div class="white-section">
        <div class="container">
        <h3>Edit my account</h3>
        <p>
<?php
		$userId = $_POST['search_text'];
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
		
		$sql = "select * from pf_user where user_name = '$login_session'";
		$result = $connection->query($sql);
		/*if ( $searchTag!="" ) {
			$result = $connection->query($sql);
			if ($result->num_rows == 1) {
				echo $result->num_rows . " result for " . $searchTag;
			}
			if ($result->num_rows > 1) {
				echo $result->num_rows . " results for " . $searchTag;
			}
		}*/
?>
	<p>
		<table class="search-table" style="width:650px;">
			<tr>
				<th>Name</th>
				<th>Value</th>
			</tr>
			
<?php
		//strings for the 'checked' status of the checkboxes
		$publisherUserChecked = "";
		$consumerUserChecked = "";
		$publisherAndConsumerUserChecked = "";
		if ($result->num_rows > 0) {  // && $searchTag!="") {
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
        		//set up the 'checked' status of the checkboxes
        		if( $row["publisher_user"] == 1 ) {
        			$publisherUserChecked = "checked";
        		}
        		if( $row["consumer_user"] == 1 ) {
        			$consumerUserChecked = "checked";
        		}
        		if( $row["publisher_and_consumer_user"] == 1 ) {
        			$publisherAndConsumerUserChecked = "checked";
        		}
        		echo "<tr>
        		<td width='200'>Email: </td><td width='450'><input type='text' class='search-text' name='user_email' id='user_email' value='" . $row["user_email"]. "'/></td></tr>
        		<tr><td>Username: </td><td>" . $row["user_name"]. "</td></tr>
        		<tr><td>First name: </td><td><input type='text' class='search-text' name='fname' id='fname' value='". $row["fname"] . "'/></td></tr>
        		<tr><td>Last name: </td><td><input type='text' class='search-text' name='file_name' id='lname' value='". $row["lname"] . "'/></td></tr>
        		<tr><td>Company: </td><td><input type='text' class='search-text' name='user_company' id='user_company' value='". $row["user_company"] . "'/></td></tr>
        		<tr><td>Publisher? </td><td><input type='checkbox' name='publisher_user' id='publisher_user' " . $publisherUserChecked . " /></td></tr>
        		<tr><td>Consumer? </td><td><input type='checkbox' name='consumer_user' id='consumer_user' " . $consumerUserChecked . " /></td></tr>
        		<tr><td>Both publisher/consumer? </td><td><input type='checkbox' name='publisher_and_consumer_user' id='publisher_and_consumer_user' " . $publisherAndConsumerUserChecked . " /></td></tr>
        		<tr><td>Creation date: </td><td>" . $row["creation_date"]. "  </td></tr>
        		<tr><td><strong>Action?</strong></td><td>[ <a href='javascript:submitform();'>update</a> ] </td></tr>";
    		}
		} else {
    		echo "Try refining your search";
		}
		$connection->close();
?>
			
		</table>
		
</p>
<p>		
		If these results were not what you are looking for, please try the following options:
	
<ul>
	
	<li>Contact us for help</li>
	<li>Put a request to publishers for the material you are looking for</li>
</ul>
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