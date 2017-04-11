<?php
include('session.php');
require_once("DBConn.php");
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
        <h3>Manage my funds</h3>
        <p>
        <form id="searchForm" method="POST">
        	<!--<div class="styled-select">-->
        	<select name="filterData">
        		<option>choose...</option>
        		<option>Blackrock</option>
        		<option>UBS</option>
        	</select>
        	<a href='javascript:document.getElementById("searchForm").submit();'><span class="button1">filter by issuer</span></a>
        	<!--</div>-->
        	
        </form>     
<?php
		$fileId = $_REQUEST["file_id"];
		$dbConn = new DBConn();
		// Create connection
		$connection = new mysqli($dbConn->dbservername, $dbConn->dbusername, $dbConn->dbpassword, $dbConn->dbname);
		// Check connection
		if ($connection->connect_error) {
    		die("Connection failed: " . $connection->connect_error);
    		echo "FAILED TO CONNECT";
		} else {
    		//echo "CONNECT OK";
		}
?>
	
	
        <form id="purchasePublications" action="confirm_purchase.php" method="post" enctype="multipart/form-data">

	<p>
			<table class="search-table" style="width:850px;">
			<tr>
				<th>Issuer</th>
				<th>ISIN / Fund name</th>
				<th>Action?</th>
			</tr>
			
<?php
		//TBD, display the firm ID of the session user!
        /*$sqlFunds = "select fd.firm_name as firm_name, f.fund_name as fund_name, f.fund_amount as fund_amount, 
        	f.fund_ccy as fund_ccy from pf_firm_details fd, pf_funds f
			where fd.firm_id = f.firm_id
			and fd.firm_id = 1";*/
		$sqlFunds = "select * from pf_funds where Security_Status = 'Tradeable' order by Issuer_name";
		$resultFunds = $connection->query($sqlFunds);
		if ($resultFunds->num_rows > 0) {
    		// output data of each row
    		while($row = $resultFunds->fetch_assoc()) {
    			echo "<tr>
        		<td width='300'>" . $row["Issuer_name"]. "</td>
        		<td width='500'>". $row["ISIN"] . " / ". $row["Security_Description"] . "</td>
        		<td width='50'><a href='edit_funds.php?isin=". $row["ISIN"] . "'> [ edit ]</a></td>
        		</tr>";
    		}
    	}
    	else{
    		echo "<tr><td width='100'>nada</td><td>nada</td></tr>";
    	}
		$connection->close();
?>
			
		</table>
</p>
		</form>
		
<!-- The function that submits the form-->
<script type="text/javascript">
function submitform()
{
 	var user_form = document.getElementById("purchasePublications");
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