<?php
$login_error_msg = $_REQUEST["error_msg"];
include('login_helper.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: my_account.php");
}
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
		<?php require("menu_teaser.php"); ?>
        <!-- END menu nav -->
        <div class="clr"></div>
    </div>
	<div class="container">
		<div id="title-container">
        	<h2>Login to PublishForce</h2>
        </div>
        <!-- CLOSE HEADING DIVS -->
    </div>
</div>
<!-- CLOSE HEADING DIVS -->

    <div class="white-section">
        <div class="container">
        <h3>
        <?php
        if( $login_error_msg == "invalid_credentials" )
		{
				Print("Invalid login. Please try again:");
              
		}
		else
		{
				Print("enter your secure credentials here:"); 
              
		}
        ?>
        </h3>
        <p>
        <form id="loginForm" method="POST" action="login_helper.php">
        	<!--<span class="login-form">-->
        		User name: 
        		<input type="text" class="user-text" name="user_id" id="user_id" style="width: 40;" autofocus /><br/>
        		Password: &nbsp;
        		<input type="password" class="user-password" name="user_password" id="user_password" style="width: 40;" />
        		&nbsp;
        		<!--<a href='javascript:document.getElementById("loginForm").submit();'>
        			<span class="search-button">login</span>-->
        		<input name="submit" type="submit" value=" Login ">
        		</a>
        	<span><?php echo $error; ?></span>
        </form>
									
        </p>
	<p>
		Forgot your password? Reset it <a href="admin_reset_password.php">here</a><br/>
		If you don't have a login you will need to <a href="admin_user_registration.php">register</a>
	
<ul>
	
	<li>Contact us for help</li>
	<li>Request a password reset</li>
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