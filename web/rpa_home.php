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
        <h3>Manage my research payment accounts</h3>
        <p>
        	<a href="edit_rpa.php?action=create">Create a new research payment account</a>
			
			<table class="search-table">
			<tr>
				<th>RPA ID</th>
				<th>RPA name</th>
				<th>Asset owner</th>
				<th>Budget assigned</th>
				<th>Period covered</th>
				<th>Created on</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
<?php
		$userName = $_SESSION['login_user'];
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
		
		$sql = "select a.rpa_id, a.rpa_name, b.asset_owner_name, a.budget_ccy,
		a.budget_amount, a.start_date, a.end_date, a.creation_date, a.active_flag
		from pf_rpa_details a, pf_asset_owner_details b 
		where a.asset_owner_id = b.asset_owner_id and a.firm_id = $session_user_firm_id";
		//$sql = "select * from pf_rpa_details";
		$result = $connection->query($sql);
		if ($result->num_rows > 0) {  // && $searchTag!="") {
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
				$rpa_status = "N/A";
    			if( $row["active_flag"] == 1 ) {
    				$rpa_status = "active";
    			}
    			$startDate = "N/A";
    			$endDate = "N/A";
    			if( !is_null($row["start_date"]) ) {
    				$startDate = $row["start_date"];
    			}
    			if( !is_null($row["end_date"]) ) {
    				$endDate = $row["end_date"];
    			}
        		echo "<tr>
        		<td>" . $row["rpa_id"] . "</td>
        		<td>" . $row["rpa_name"] . "</td>
        		<td>" . $row["asset_owner_name"] . "</td>
        		<td>" . $row["budget_ccy"] . " " . $row["budget_amount"] . "</td>
        		<td>" . $startDate . " to " . $endDate . "</td>
        		<td>" . $row["creation_date"]. "</td>
        		<td>" . $rpa_status . "</td>
        		<td>[ <a href='edit_rpa.php?rpa_id=" . $row["rpa_id"] . "'>edit</a> ]</td>
        		</tr>";
    		}
		} else {
    		echo "Try refining your search";
		}
		$connection->close();
?>				
        	</table>
        </p>
	<p>
		If you don't find what you are looking for then you may want to try the following options:
	
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
    	<div style="padding:0 15px;">
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