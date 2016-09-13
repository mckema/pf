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
        	<h2>Register for PublishForce</h2>
        </div>
        <!-- CLOSE HEADING DIVS -->
    </div>
</div>
<!-- CLOSE HEADING DIVS -->
	<div style="text-align:center;">

		<!-- menu for my account -->
		<!-- not listed for user registration process -->
        <!-- END menu for my account -->
    </div>

    <div class="white-section">
        <div class="container">
        <h3>Register as a PublishForce user</h3>
        <p>
        	Please enter your details below to request a login
	
	
        <form id="createUser" action="admin_request_user_registration.php?reg_action=submitted" method="post" enctype="multipart/form-data">

	<p>
		<table class="search-table" style="width:750px;">
			<tr>
				<th>Name</th>
				<th>Value</th>
			</tr>
			<tr>
        		<td width="150">First name: </td>
        		<td width="600"><input type="text" class="search-text" name="fname" id="fname" value="" autofocus /></td>
        	</tr>
        	<tr>
        		<td>Last name: </td>
        		<td><input type="text" class="search-text" name="lname" id="lname" value="" /></td>
        	</tr>
        	<tr>
        		<td>Company name: </td>
        		<td><input type="text" class="search-text" name="user_company" id="user_company" value="" /></td>
        	</tr>
        	<tr>
        		<td>Job title: </td>
        		<td><input type="text" class="search-text" name="job_title" id="job_title" value="" /></td>
        	</tr>
        	<tr>
        		<td>Email: </td>
        		<td><input type="text" class="search-text" name="user_email" id="user_email" value="" /></td>
        	</tr>
        	<tr>
        		<td>Mobile: </td>
        		<td><input type="text" class="search-text" name="user_mobile" id="user_mobile" value="" /> (so we can validate your login)</td>
        	</tr>
        		<td>About your usage: </td>
        		<td>Publisher of research? <input type="checkbox" name="publisher_user" id="publisher_user" value=""><br/>
        			Consumer of research? <input type="checkbox" name="consumer_user" id="consumer_user" value=""><br/>
        			Both a consumer and a publisher of research? 
        			<input type="checkbox" name="publisher_and_consumer_user" id="publisher_and_consumer_user" value="">
        		</td>
        	<tr>
        		<td>&nbsp; </td>
        		<td>[ <a href='javascript:submitform();'>request login</a> ] </td>
        	</tr>			
		</table>
		
</p>
		</form>
		
<!-- The function that submits the form-->
<script type="text/javascript">
function submitform()
{
 	var user_form = document.getElementById("createUser");
 	user_form.submit();
}
</script>
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