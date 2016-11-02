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
        <!--<div class="clr"></div>-->
    </div>
</div>
<!-- CLOSE HEADING DIVS -->
	<div style="text-align:center;">

		<!-- menu for my account -->
		<?php require("menu_my_account.php"); ?>
        <!-- END menu for my account -->
    </div>
<?php
	$fileId = $_REQUEST["file_id"];
?>
    <div class="white-section">
        <div class="container">
        <h3>Step 2: Choose the RPA for this purchase</h3>
        <p>
        << <a href="purchase_research.php?file_id=<?php echo $fileId;?>">Back</a> to step 1<br/>
<?php
		$rpaId = $_REQUEST["rpa_id"];
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
		/*$sql = "select a.rpa_id, a.rpa_name, a.asset_owner_id, b.asset_owner_name, a.budget_ccy,
		a.budget_amount, a.start_date, a.end_date, a.creation_date, a.active_flag
		from pf_rpa_details a, pf_asset_owner_details b 
		where a.asset_owner_id = b.asset_owner_id and a.rpa_id = $rpaId";*/
		$sql = "select * from pf_rpa_details";
		$result = $connection->query($sql);
		
		//which funds are linked to this RPA
        /*$chosenFundsSQL = "select * from pf_funds_linked_to_rpa where rpa_id = $rpaId;";
    	$resultChosenFunds = $connection->query($chosenFundsSQL);
		*/
		//what has been spent so far on the RPA
		/*$sqlSpent = "SELECT allocation_ccy, FORMAT(SUM(allocation_amount),2) total
			FROM `pf_allocation_history`
			where ISIN in ('GB0005533228','GB00B82FK756','JE00B4RG7R45')
			GROUP BY allocation_ccy";
		$resultSpent = $connection->query($sqlSpent);
		*/
		//who owns the assets
		/*$newSQL = "select * from pf_asset_owner_details;";
    	$resultAssetOwner = $connection->query($newSQL);*/
?>
	
	
        <form id="chooseRPA" action="allocate_purchase.php" method="post" enctype="multipart/form-data">

	<p>
			<table class="search-table" style="width:700px;">
			<tr>
				<th>Name</th>
				<th>Value</th>
			</tr>
			
<?php
		echo "<tr>
        		<td>RPA: </td>
        		<td width='600'><select name='rpa_id'>
        			<option value=''>choose...</option>";
        	
    		if ($result->num_rows > 0) {
    			// output data of each row
    			while($row = $result->fetch_assoc()) {
    				echo "<option value='". $row["rpa_id"] . "'>". $row["rpa_name"] . "</option>";
    			}
    		}
        	echo "</select>
        		<input type='hidden' name='file_id' value='". $fileId . "' />
        		<input type='text' name='budget_ccy' value='". $row["budget_ccy"] . "' />
        		</td>
        	</tr>
        	<tr>
        		<td>Action: </td>
        		<td> [ <a href='javascript:submitform();'>Allocate</a> ]  this research to my funds
        		
        		</td>
        	</tr>
        	";
 
		$connection->close();
?>
			
		</table>
		
</p>
		</form>
		
<!-- The function that submits the form-->
<script type="text/javascript">
function submitform()
{
 	var user_form = document.getElementById("chooseRPA");
 	user_form.submit();
}
</script>
	<p>
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