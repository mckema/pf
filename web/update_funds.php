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
        <h3>Edit Funds</h3>
        <p>
        << <a href="my_funds.php">Back</a> to list of Funds<br/>
<?php
		// Create connection
		$dbConn = new DBConn();
		$connection = new mysqli($dbConn->dbservername, $dbConn->dbusername, $dbConn->dbpassword, $dbConn->dbname);
		
		//sends an email to the sys adming that someone has submitted a registration request
		$newRecord = $_POST["new_record"];
		echo "new record: " . $newRecord;
		$isinId = $_POST["isin_id"];
		$issuerName = $_POST["issuer_name"];
		$countryOfIncorporation = $_POST["country_of_incorporation"];
		$cfiCode = $_POST["cfi_code"];
		$securityType = $_POST["security_type"];
		$securityDescription = $_POST["security_description"];
		$countryOfRegister = $_POST["country_of_register"];
		$securityForm = $_POST["security_form"];
		$securityStatus = $_POST["security_status"];
		//something for an allocation method and allocation limit?
		//$activeFlag = $_POST["active_status"];
		
		// Check connection
		if ($connection->connect_error) {
    		die("Connection failed: " . $connection->connect_error);
    		echo "FAILED TO CONNECT";
		} else {
    		//echo "CONNECT OK";
		}
		if ($newRecord != "new") {
			//we're updating an existing RPA
			$sql = "update pf_funds set issuer_name = '$issuerName', country_of_incorporation = '$countryOfIncorporation', 
				cfi_code = '$cfiCode', security_type = '$securityType', 
				security_description = '$securityDescription', country_of_register = '$countryOfRegister',
				security_form = '$securityForm', security_status = '$securityStatus'
				where ISIN = '$isinId';";
			//echo $sql;
		}
		else {
			//we're inserting a new record
			/*$sql = "INSERT INTO `pf_rpa_details`(`rpa_name`, `firm_id`, `asset_owner_id`, `budget_ccy`, `budget_amount`, `start_date`, `end_date`, `active_flag`, `creation_date`) 
			 values ('$rpaName', $session_user_firm_id, $assetOwnerId, '$budgetCcy', $budgetAmount, $startDate, $endDate, $activeFlag, NOW());";
			echo $sql;*/
		}

		if ($connection->query($sql) === TRUE) {
    		echo "Fund details for <strong>$securityDescription</strong> updated successfully";
		}
		else {
    		echo "Error updating fund details: " . $connection->error;
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