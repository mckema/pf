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
		<?php require("menu_teaser.php"); ?>
        <!-- END menu nav -->
        <!--<div class="clr"></div>-->
    </div>
</div>
<!-- CLOSE HEADING DIVS -->
	<div style="text-align:center;">

		<!-- menu for my account -->
        <!-- END menu for my account -->
    </div>

    <div class="white-section">
        <div class="container">
        <h3>User registration</h3>
        <p>
        << <a href="index.php">Back</a> to home page<br/>
<?php
		
		// fname, lname, user_company, job_title, user_email, user_mobile, publisher_user, 
		// consumer_user, publisher_and_consumer_user
		$regStatus = $_REQUEST["reg_action"];
		$userEmail = $_POST["user_email"];
		$fName = $_POST["fname"];
		$lName = $_POST["lname"];
		$userCompany = $_POST["user_company"];
		$jobTitle = $_POST["job_title"];
		$userMobile = $_POST["user_mobile"];
		$publisherUser = 0;
		$consumerUser = 0;
		$publisherAndConsumerUser = 0;
		if (isset($_POST['publisher_user'])) {
			$publisherUser = 1;
		}
		if (isset($_POST['consumer_user'])) {
			$consumerUser = 1;
		}
		if (isset($_POST['publisher_and_consumer_user'])) {
			$publisherAndConsumerUser = 1;
		}
		$servername = "127.0.0.1";
		$username = "publishforce";
		$password = "publishforce";
		$dbname = "publishforce";
		// Create connection
		$connection = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($connection->connect_error) {
    		die("Connection failed: " . $connection->connect_error);
    		echo "FAILED TO CONNECT";
		} else {
    		//echo "CONNECT OK";
		}
		$sql = "INSERT INTO `pf_user_registration`(`user_email`, `fname`, `lname`, `user_company`, `job_title`, `user_mobile`, `publisher_user`, `consumer_user`, `publisher_and_consumer_user`, `active_flag`, `creation_date`) 
		VALUES ('$userEmail', '$fName', '$lName', '$userCompany', '$jobTitle', '$userMobile', $publisherUser, $consumerUser, $publisherAndConsumerUser, 0, NOW())"; 
		
		if ($connection->query($sql) === TRUE) {
    		echo "<br/>Thanks. Your user registration request was successfully submitted";
    		//TO DO... fire off an email to tell administrator of a new user registration request to review!
    		// email sent off with details...    		
		} else {
    		echo "Error inserting record: " . $conn->error;
		}
		$connection->close();
?>
			
		</p>
		<!--</form>-->
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