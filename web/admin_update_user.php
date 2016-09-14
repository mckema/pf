<?php
include('session.php');
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
		//$userId = $_REQUEST["user_id"];
		$userId = $_POST["user_id"];
		$userRegId = $_POST["user_reg_id"];
		//echo "userId: $userId; userRegId: $userRegId;";
		$userEmail = $_POST["user_email"];
		$fName = $_POST["fname"];
		$lName = $_POST["lname"];
		$userCompany = $_POST["user_company"];
		$userMobile = $_POST["user_mobile"];
		$jobTitle = $_POST["job_title"];
		$publisherUser = $_POST["publisher_user"];
		$consumerUser = $_POST["consumer_user"];
		$publisherAndConsumerUser = $_POST["publisher_and_consumer_user"];
		$activeFlag = $_POST["active_flag"];
		$servername = "127.0.0.1";
		$username = "publishforce";
		$password = "publishforce";
		$dbname = "publishforce";

		// Create connection
		$connection_1 = new mysqli($servername, $username, $password, $dbname);
		$connection_2 = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($connection_1->connect_error) {
    		die("Connection failed: " . $connection_1->connect_error);
    		echo "FAILED TO CONNECT";
		} else {
    		//echo "CONNECT OK";
		}
		if ($userId != "") {
			//we're updating an existing user
			$sql = "update pf_user set user_email = '$userEmail', fname = '$fName', lname = '$lName', user_company = '$userCompany', active_flag = $activeFlag where user_id = $userId";
		
		}
		if ($userRegId != "") {
			//we're inserting a newly registered user
			$userName = strtolower($fName[0]). strtolower($lName);
			$sql = "INSERT INTO `pf_user`(`user_name`, `user_email`, `fname`, `lname`, `user_company`, `job_title`, `user_mobile`, `publisher_user`, `consumer_user`, `publisher_and_consumer_user`, `active_flag`, `creation_date`) 
			 values ('$userName', '$userEmail', '$fName', '$lName', '$userCompany', '$jobTitle', '$userMobile', $publisherUser, $consumerUser, $publisherAndConsumerUser, 1, NOW())";
			//update the pf_user_registration and set active_flag = 1
			//then insert a new record in the login table, set to first time password for user to change on first login
			$sqlUserReg = "update pf_user_registration set active_flag = 1 where user_reg_id = $userRegId";
			$sqlInsertNewLogin = "insert into login(username, password, is_temp_psswd) values('$userName', 'abc123', 1)";
		}

		if ($connection_1->query($sql) === TRUE) {
    		//echo "User record updated successfully";
		}
		else {
    		echo "Error updating record: " . $connection_1->error;
		}
		if ( $userRegId != "" ) {
			if ( $connection_2->query($sqlUserReg) === TRUE && $connection_2->query($sqlInsertNewLogin) === TRUE) {
				echo "User registration record updated successfully";
				//TODO, send an email to the user of their new account
				require 'Send_Mail.php';
				$to = $userEmail;
				$subject = "Publishforce [dev] new account notification";
				$body = "Hi, $fName, your PublishForce account name is <br/>$userName <br/>And your one-time password is <br/>abc123 <br/> go to dev.publishforce.com to login and reset your password."; // HTML  tags
				Send_Mail($to,$subject,$body);
			}
			else {
				//echo "The SQL is: " . $sqlUserReg;
    			echo "Error amending registration record: " . $connection_2->error;
			}
		}
		$connection_1->close();
		$connection_2->close();
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