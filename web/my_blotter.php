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
        <!-- END menu nav 
        <div class="clr"></div>-->
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
        <h3>My blotter</h3>
<p>	
<!--<span class="allocation-layout">-->
<ul class="nav-list">
	
	<li class="nav-item">

<table class="allocation-table">
			<tr>
				<th colspan="2">Read & purchased</th>
				<th>100%</th>	
			</tr>
			<tr>
				<td>Fund-0001</td>
				<td>20%</td>
				<td>2,000</td>
			</tr>
			<tr>
				<td>Fund-0027</td>
				<td>5%</td>
				<td>500</td>
			</tr>
			<tr>
				<td>Fund-0245</td>
				<td>45%</td>
				<td>4,500</td>
			</tr>
			<tr>
				<td>Fund-2987</td>
				<td>30%</td>
				<td>3,000</td>
			</tr>
			<tr>
				<td>TOTAL</td>
				<td>EUR</td>
				<td>10,000</td>
			</tr>
			
		</table>
	</li>
	<li class="nav-item">
	<li class="nav-item">
		&nbsp;&nbsp;&nbsp;&nbsp;
	</li>		
	<table class="shortcuts-table">
			<tr>
				<th colspan="2">Selected and not purchased</th>
			</tr>
			<tr>
				<td>EUR</td>
				<td>10,000</td>
			</tr>
			<tr>
				<td>Payment method</td>
				<td>Cash</td>
			</tr>
			<tr>
				<td>External invoicing</td>
				<td>Ref: 223399817</td>
			</tr>
			<tr>
				<td>Internal invoicing</td>
				<td>N/A</td>
			</tr>
			<tr>
				<td>Volume retrocession</td>
				<td>N/A</td>
			</tr>
			
		</table>		
	</li>
</ul>
<!--</span>	-->

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