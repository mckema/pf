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
		<div id="banner-container">
        	<div id="banner-slider">
                <div class="item">
					
					<h2>The new face of global markets research</h2>
					
                    
        <div class="content">
					<p class="holding-page">Thanks for expressing your interest.</p>	
<?php
	require 'Send_Mail.php';
	$to = "mark.mckee@publishforce.com";
	$subject = "Publishforce pre-go-live sign-up notification";
	$body = "Hi, this user has registered their interest in publishforce's go-live: $_POST[user_email]"; // HTML  tags
	Send_Mail($to,$subject,$body);

?>
                    
                </div>
            </div>
        </div>
        <!-- CLOSE HEADING DIVS -->
    </div>
</div>
<!-- footer section -->
<?php require("footer_empty.php"); ?>
<!-- END footer section -->

</body>
</html>
