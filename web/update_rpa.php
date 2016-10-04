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
        <h3>Edit RPA</h3>
        <p>
        << <a href="rpa_home.php">Back</a> to list of RPAs<br/>
<?php
		// Create connection
		$dbConn = new DBConn();
		$connection = new mysqli($dbConn->dbservername, $dbConn->dbusername, $dbConn->dbpassword, $dbConn->dbname);
		
		//sends an email to the sys adming that someone has submitted a registration request
		$newRecord = $_POST["new_record"];
		echo "new record: " . $newRecord;
		$rpaId = $_POST["rpa_id"];
		$rpaName = $_POST["rpa_name"];
		$assetOwnerId = $_POST["asset_owner_id"];
		$budgetCcy = $_POST["budget_ccy"];
		$budgetAmount = $_POST["budget_amount"];
		$startDate = $_POST["start_date"];
		if( $startDate == "" ) {
			$startDate = 'NULL';
		}
		else {
			$startDate = "'" . $startDate . "'";
		}
		$endDate = $_POST["end_date"];
		if( $endDate == "" ) {
			$endDate = 'NULL';
		}
		else {
			$endDate = "'" . $endDate . "'";
		}
		$activeFlag = $_POST["active_status"];
		
		// Create connection
		/*$connection_1 = new mysqli($servername, $username, $password, $dbname);
		$connection_2 = new mysqli($servername, $username, $password, $dbname);*/
		// Check connection
		if ($connection->connect_error) {
    		die("Connection failed: " . $connection->connect_error);
    		echo "FAILED TO CONNECT";
		} else {
    		//echo "CONNECT OK";
		}
		if ($newRecord != "new") {
			//we're updating an existing RPA
			$sql = "update pf_rpa_details set rpa_name = '$rpaName', asset_owner_id = $assetOwnerId, 
				budget_ccy = '$budgetCcy', budget_amount = $budgetAmount, 
				start_date = $startDate, end_date = $endDate, 
				active_flag = $activeFlag where rpa_id = $rpaId";
			//echo $sql;
		}
		else {
			//we're inserting a new record
			//INSERT INTO `pf_rpa_details`(`rpa_name`, `firm_id`, `asset_owner_id`, `budget_ccy`, `budget_amount`, `start_date`, `end_date`, `active_flag`, `creation_date`) 
			$sql = "INSERT INTO `pf_rpa_details`(`rpa_name`, `firm_id`, `asset_owner_id`, `budget_ccy`, `budget_amount`, `start_date`, `end_date`, `active_flag`, `creation_date`) 
			 values ('$rpaName', $session_user_firm_id, $assetOwnerId, '$budgetCcy', $budgetAmount, $startDate, $endDate, $activeFlag, NOW());";
			echo $sql;
		}

		if ($connection->query($sql) === TRUE) {
    		echo "RPA details for <strong>$rpaName</strong> updated successfully";
		}
		else {
    		echo "Error updating RPA details: " . $connection->error;
		}
		$connection->close();
?>
			
		</p>
		</form>
	<p>
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