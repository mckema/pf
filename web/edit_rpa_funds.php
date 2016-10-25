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
		$rpaId = $_REQUEST["rpa_id"];
?>
    <div class="white-section">
        <div class="container">
        <h3>Edit RPA</h3>
        <p>
        << <a href="edit_rpa.php?rpa_id=<?php echo $rpaId;?>">Back</a> to my RPA details<br/>
<?php
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
		$sql = "select a.rpa_id, a.rpa_name, a.asset_owner_id, b.asset_owner_name, a.budget_ccy,
		a.budget_amount, a.start_date, a.end_date, a.creation_date, a.active_flag
		from pf_rpa_details a, pf_asset_owner_details b 
		where a.asset_owner_id = b.asset_owner_id and a.rpa_id = $rpaId";
		//echo $sql;
		$result = $connection->query($sql);
		//populate the santa
		$newSQL = "select * from pf_asset_owner_details;";
    	$resultAssetOwner = $connection->query($newSQL);
?>
	
	
        <form id="updatePublications" action="update_rpa.php" method="post" enctype="multipart/form-data">

	<p>
			<table class="search-table" style="width:700px;">
			<tr>
				<th>Name</th>
				<th>Value</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>
			
<?php


		if ($result->num_rows > 0) {
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
        		$publishFlag = "publish";
        		$publicationStatus = "Not active";
        		$selectedAssetOwnerId = $row["asset_owner_id"];
        		//echo "AO ID: " . $selectedAssetOwnerId;
        		if( $row["active_flag"] == 1 ) {
        			$publishFlag = "unpublish";
        			$publicationStatus = "Activated on " . $row["start_date"];
        		}
        		
        		echo "<tr>
        		<td width='100'>RPA name: </td><td width='600'><input type='text' class='search-text' name='rpa_name' id='rpa_name' value='" . $row["rpa_name"]. "'/></td></tr>
        		<tr>
        			<td>Asset owner: </td>
        			<td>
        				<input type='hidden' name='asset_owner_hidden' id='asset_owner_hidden' value='". $row["asset_owner_id"] . "'/>
        				<select name='asset_owner_id'>";
        				
        				if ($resultAssetOwner->num_rows > 0) {
        					
        					
    						while($rowAO = $resultAssetOwner->fetch_assoc()) {
    							$selectedElem = "";
    							if ($selectedAssetOwnerId == $rowAO["asset_owner_id"]) {
    								$selectedElem = "selected";
    							}
    							echo "<option value='". $rowAO["asset_owner_id"] . "' " . $selectedElem . ">". $rowAO["asset_owner_name"] . "</option>";
    						}
    					}
    				echo "</select>
        			<input type='hidden' name='rpa_id' id='rpa_id' value='". $row["rpa_id"] . "'/>
        			</td>
        			<td></td>
        			<td></td>
        		</tr>";
        ?>
    					
        		<tr>
        			<td>Choose funds:</td>
        			<td>
        <?php
        $sqlFunds = "select * from pf_funds where Security_Status = 'Tradeable'";
		$resultFunds = $connection->query($sqlFunds);
		echo "<strong>Funds I manage:</strong><br/>";
		if ($resultFunds->num_rows > 0) {
        	echo "<select id='myselect' name='myselect' multiple style='height:220px;width:500px;overflow-y: auto;'>";
        	while($rowFunds = $resultFunds->fetch_assoc()) {
        		
          		echo" <option value='" . $rowFunds["ISIN"]. "'>" . $rowFunds["Issuer_name"]. ": " . $rowFunds["ISIN"]. ": "  . $rowFunds["Security_Description"]. "</option>";
        		//echo "<strong>ISIN</strong>: " . $rowFunds["ISIN"]. " &nbsp;&nbsp;<strong>Name</strong>: "  . $rowFunds["Security_Description"]. " [ <a href='#'>add this fund</a> ]<br/>";
        	}
        	echo "</select>";
        }
        
        ?>			
        			
        			</td>
        			<td>
        				<a id="myLink" href="#" onclick="grab_data(myselect, userselectedfunds, hiddenselectedfunds);return false;">add&nbsp;&gt;&gt;</a><br/><br/>
						<a id="clearData" href="#" onclick="clear_data(userselectedfunds, userselectedfunds2, hiddenselectedfunds);return false;">&lt;&lt;&nbsp;remove</a>
						&nbsp;
        			<!--persist them to pf_funds_linked_to_rpa table-->
        			</td>
        			<td>
        				<br/><input type="hidden" name="hiddenselectedfunds" id="hiddenselectedfunds" value="" />
        				<select name="userselectedfunds2[]" id="userselectedfunds2" multiple style="height:220px;width:500px;overflow-y: auto;">
						</select>
						<!--<a id="nextPage" href="#" onclick="submitform();return false;">next steps</a>-->
        			</td>
        		</tr>
        <?php
        		echo "<tr>
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