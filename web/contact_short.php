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
        	<h2>Contact PublishForce</h2>
        </div>
        <!-- CLOSE HEADING DIVS -->
    </div>
</div>
<!-- CLOSE HEADING DIVS -->

<div class="white-section">
	<div class="container">
    	<h3>Why not stay in touch with our go-live?</h3>

		<p>
									<script language="JavaScript">
									function checkVals()
									{
										var email = document.getElementById("user_email");
										if( email.value.length == 0 || email == 'enter your email' )
										{
											alert("Don't be shy! Fill in your email...");
											return false;
										}
										else
										{
											sendForm();
											return true;
										}	
									}
									
									function sendForm()
									{
										document.loginForm.submit();
									}
							</script>
	
        <form id="loginForm" name="loginForm" method="POST" action="mail_sent.php">
        	<input type="text" placeholder="enter your email" class="user-text" name="user_email" id="user_email" style="width: 180px;" />&nbsp;&nbsp;
        	<input type="hidden" name="send">
        	<input type="button" class="search-button" name="Submit" value="notify me!" onClick="javascript:checkVals();"> 
        	<!--<a href="javascript:checkVals();">
        		<span class="search-button">notify me!</span>
        	</a>-->
        </form>
		</p>
    </div>   
</div>

<!-- footer section -->
<?php require("footer_empty.php"); ?>
<!-- END footer section -->

</body>
</html>