<?php
include('session.php');
require_once("dbconn.php");
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
        <h3>Edit Funds</h3>
        <p>
        << <a href="my_funds.php">Back</a> to my list of Funds<br/>
<?php
		$isinId = $_REQUEST["isin"];
		// Create connection
		$dbConn = new DBConn();
		$connection = new mysqli($dbConn->dbservername, $dbConn->dbusername, $dbConn->dbpassword, $dbConn->dbname);
		// Check connection
		if ($connection->connect_error) {
    		die("Connection failed: " . $connection->connect_error);
    		echo "FAILED TO CONNECT";
		} else {
    		//echo "CONNECT OK";
		}
		//$sql = "select * from pf_rpa_details where rpa_id = $rpaId";
		$sql = "select * from pf_funds  
		where ISIN = '$isinId'";
		//echo $sql;
		$result = $connection->query($sql);
?>
	
	
        <form id="updatePublications" action="update_funds.php" method="post" enctype="multipart/form-data">

	<p>
			<table class="search-table" style="width:700px;">
			<tr>
				<th>Name</th>
				<th>Value</th>
			</tr>			
<?php

		if ($result->num_rows > 0) {
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
    			echo "<tr>
        			<td>ISIN:</td>
        			<td>
    					". $row["ISIN"] . "
        			</td>
        		</tr>
        		<tr>
        			<td>Issuer name:</td>
        			<td>
        				<input type='text' style='width:300px;' class='search-text' name='issuer_name' id='issuer_name' value='" . $row["Issuer_name"]. "' />
        				<input type='hidden' name='isin_id' id='isin_id' value='" . $row["ISIN"]. "' />
        			</td>
        		</tr>
        		<tr>
        			<td>Country of Incorporation:</td>
        			<td>
        				<input type='text' style='width:300px;' class='search-text' name='country_of_incorporation' id='country_of_incorporation' value='" . $row["Country_of_Incorporation"]. "' />
        			</td>
        		</tr>
        		<tr>
        			<td>CFI Code:</td>
        			<td>
        				<input type='text' style='width:300px;' class='search-text' name='cfi_code' id='cfi_code' value='" . $row["CFI_Code"]. "' />
        			</td>
        		</tr>
        		<tr>
        			<td>Security Type:</td>
        			<td>
        				<input type='text' style='width:300px;' class='search-text' name='security_type' id='security_type' value='" . $row["Security_Type"]. "' />
        			</td>
        		</tr>
        		<tr>
        			<td>Security Description:</td>
        			<td>
        				<input type='text' style='width:300px;' class='search-text' name='security_description' id='security_description' value='" . $row["Security_Description"]. "' />
        			</td>
        		</tr>
        		<tr>
        			<td>Country of Register:</td>
        			<td>
        				<input type='text' style='width:300px;' class='search-text' name='country_of_register' id='country_of_register' value='" . $row["Country_of_Register"]. "' />
        			</td>
        		</tr>
        		<tr>
        			<td>Security Form:</td>
        			<td>
        				<input type='text' style='width:300px;' class='search-text' name='security_form' id='security_form' value='" . $row["Security_Form"]. "' />
        			</td>
        		</tr>
        		<tr>
        			<td>Security Status:</td>
        			<td>
        				<input type='text' style='width:300px;' class='search-text' name='security_status' id='security_status' value='" . $row["Security_Status"]. "' />
        			</td>
        		</tr>
        		<tr>
        			<td><strong>Action?</strong></td><td>[ <a href='javascript:submitform();'>save changes</a> ]  
        			&nbsp;&nbsp;&nbsp;&nbsp;
        			</td>
        		</tr>";
    		}
		} 
		else {
    		//new record to be created by user
    		echo "<tr>
        		<td width='100'>RPA name: </td><td width='600'><input type='text' class='search-text' name='rpa_name' id='rpa_name' value=''/></td></tr>
        		<tr><td>Asset owner: </td>
        		<td width='600'><select name='asset_owner_id'>
        			<option value=''>choose...</option>";
        	
    		if ($resultAssetOwner->num_rows > 0) {
    			// output data of each row
    			while($rowAO = $resultAssetOwner->fetch_assoc()) {
    				echo "<option value='". $rowAO["asset_owner_id"] . "'>". $rowAO["asset_owner_name"] . "</option>";
    			}
    		}
        	echo "</select></td></tr>
        		<tr><td>Budget:</td><td>
        			<input type='text' style='width:40px;' class='search-text' name='budget_ccy' id='budget_ccy' value='' placeholder='GBP'/>
        			<input type='text' style='width:100px;' class='search-text' name='budget_amount' id='budget_amount' value='' />
        			</td>
        		</tr>
        		<tr>
        			<td>Dates (start-end): </td><td><input type='text' class='search-text' name='start_date' id='start_date' value=''/> to 
        			<input type='text' class='search-text' name='end_date' id='end_date' value=''/> (yyyy-mm-dd)
        		</td>
        		</tr>
        		<tr>
        			<td>Active?</td>
        			<td>
        				<select name='active_status'>
        					<option value='0'>Not active</option>
        					<option value='1'>Active</option>
        				</select>
        			</td></tr>
        		<tr><td><strong>Action?</strong></td><td>[ <a href='javascript:submitform();'>save changes</a> ]  
        		<input type='text' name='new_record' value='new' />
        		</td></tr>";
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
 	var user_form = document.getElementById("updatePublications");
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
	
    <!--<div class="container" style="text-align:center;">
    	<div style="padding:0 150px;">
            <h4 class="large-header">Contact Us</h4>
            <p class="mbottom10">If you have any questions about our research platform, or if you have an enquiry, please contact us using the details below, or by filling out the form on our contact page.</p>
            <a href="contact.php"><span class="button3">Get in touch</span></a>
        </div>
    </div>-->
   
</div>

<!-- footer section -->
<?php require("footer_empty.php"); ?>
<!-- END footer section -->

</body>
</html>