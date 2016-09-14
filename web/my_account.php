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
        <h3>My shortcuts</h3>
        <ul class="nav-list">
	
			<li class="nav-item">
				<ul class="ul-sidebar-title">
					<li class="li-sidebar-title"><a href="#">Research</a></li>
						<ul class="ul-sidebar">
							<li class="li-sidebar">Inbox</li>
							<li class="li-sidebar">Blotter</li>							
							<li class="li-sidebar">Programs</li>
						</ul>
					</li>
					<li class="li-sidebar-title"><a href="#">Budget</a></li>
						<ul class="ul-sidebar">
							<li class="li-sidebar">Spending</li>
							<li class="li-sidebar">Programs</li>							
							<li class="li-sidebar">Projects</li>
						</ul>
					</li>
					<li class="li-sidebar-title"><a href="#">Firm</a></li>
						<ul class="ul-sidebar">
							<li class="li-sidebar">Funds</li>
							<li class="li-sidebar">Desks</li>							
							<li class="li-sidebar">Managers</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="nav-item">
			<li class="nav-item">
				&nbsp;&nbsp;&nbsp;&nbsp;
			</li>
			<!--<li class="nav-item">-->
        <table class="shortcuts-table">
			<tr>
				<td width="101" height="102" class="shortcuts-table-td">
					<a href="my_research_inbox.php"><img src="images/interface/inbox.png" /></a>
				</td>
				<td width="101" height="102" class="shortcuts-table-td">
					<a href="my_blotter.php"><img src="images/interface/blotter.png" /></a>
				</td>
				<td width="101" height="102" class="shortcuts-table-td">
					<a href="#"><img src="images/interface/question.png" /></a>
				</td>
			</tr>
			
			<tr>
				<td width="101" height="102" class="shortcuts-table-td">
					<a href="#"><img src="images/interface/desk_inbox.png" /></a>
				</td>
				<td width="101" height="102" class="shortcuts-table-td">
					<a href="newly_published.php"><img src="images/interface/suggested.png" /></a>
				</td>
				<td width="101" height="102" class="shortcuts-table-td">
					<a href="#"><img src="images/interface/question.png" /></a>
				</td>
			</tr>
			<tr>
				<td width="101" height="102" class="shortcuts-table-td">
					<a href="#"><img src="images/interface/funds_covered.png" /></a>
				</td>
				<td width="101" height="102" class="shortcuts-table-td">
					<a href="#"><img src="images/interface/question.png" /></a>
				</td>
				<td width="101" height="102" class="shortcuts-table-td">
					<a href="#"><img src="images/interface/budget_spent.png" /></a>
				</td>
			</tr>
		</table>
			</li>
        </ul>
	
	<!--<li><a href="lifecycle.php">Research allocations</a></li>
	<li><a href="xxxx.php">Payments made</a></li>
</ul>
<p>	
	<br/>	
		If this data are not what you are looking for, please try the following options:
	
<ul>
	
	<li>Contact us for help</li>
	<li>Visit our FAQs</li>
</ul>
	</p>-->
            
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