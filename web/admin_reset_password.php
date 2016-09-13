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
        	<h2>Reset your PublishForce password</h2>
        </div>
        <!-- CLOSE HEADING DIVS -->
    </div>
</div>
<!-- CLOSE HEADING DIVS -->

    <div class="white-section">
        <div class="container">
        <h3>
        <p>
        	Enter your email and we will send you a temporary password<br/>
        <form id="loginForm" method="POST" action="admin_check_password_reset.php">
        	<!--<span class="login-form">-->
        		Email: 
        		<input type="text" class="user-text" name="user_email" id="user_email" style="width: 200px;" autofocus />
        		&nbsp;
        		<input name="submit" type="submit" value=" Reset ">
        		</a>
        </form>
									
        </p>
	<p>
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