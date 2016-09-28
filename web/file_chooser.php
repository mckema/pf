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
		<?php require("menu_my_account.php"); ?>
        <!-- END menu for my account -->
    </div>

    <div class="white-section">
        <div class="container">
        <form action="file_upload.php" method="post" enctype="multipart/form-data">
        <h3>Add your research content here:</h3>
        <p>
        	<!-- put this in a table -->
        	<table class="search-table" style="width:700px;">
			<tr>
				<th>Name</th>
				<th>Value</th>
			</tr>
			<tr>
				<td width="200">Title:</td>
				<td width="400"><input type="text" class="search-text" name="file-title" id="file-title" style="width: 300px;" /></td>
			</tr>
			<tr>
				<td>Sector:</td>
				<td><input type="text" class="search-text" name="file-sector" id="file-sector" style="width: 100px;" /> </td>
			</tr>
			<tr>
				<td>Keywords:</td>
				<td><input type="text" class="search-text" name="file-keywords" id="file-keywords" style="width: 300px;" /> (e.g. equities, mid-cap) </td>
			</tr>
			<tr>
				<td>Abstract:</td>
				<td><input type="text" class="search-text" name="file-abstract" id="file-abstract" style="width: 500px;" /> (e.g. The outlook for the year ahead is ...) </td>
			</tr> 
			<tr>
				<td>Publisher:</td>
        		<td><input type="text" class="search-text" name="file-publisher" id="file-publisher" style="width: 200px;" /> (e.g. ABC Macro Research) </td>
        	</tr> 
			<tr>
				<td>Author name:</td>
        		<td><input type="text" class="search-text" name="file-author" id="file-author" style="width: 200px;" /> (e.g. John Smith)
        	</tr>
        	<tr>
        		<td>Author email:</td>
        		<td><input type="text" class="search-text" name="file-author-email" id="file-author-email" style="width: 200px;" /> (e.g. jmith@example.com) </td>
        	</tr>
			<tr>
				<td>Currency &amp; standard price:</td>
        		<td><input type="text" class="search-text" name="file-ccy" id="file-ccy" style="width: 40px;" /> (e.g. GBP)
        	&nbsp;&nbsp;&nbsp;<input type="text" class="search-text" name="file-face-value" id="file-face-value" style="width: 60px;" /> (e.g. 1000.00)</td>
        	</tr>
        	<tr>
				<td>Frequency:</td>
        		<td>
        			<select name="file-frequency">
        				<option>choose...</option>
        				<option>weekly</option>
        				<option>fortnightly</option>
        				<option>monthly</option>
        				<option>quarterly</option>
        				<option>semi-annually</option>
        				<option>annually</option>
        			</select>
        		</td>
        	</tr>
        </table>
        <p>
    		Select file to upload:
    		<input type="file" name="fileToUpload" id="fileToUpload">
    		<input type="submit" value="Upload file" name="submit">
    	</p>
		</form>
<br/><br/>
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
